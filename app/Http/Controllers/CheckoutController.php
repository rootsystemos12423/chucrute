<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Checkout;
use Illuminate\Support\Facades\Cookie;
use App\Models\OrderBump;
use App\Models\Domain;
use App\Models\Store;
use App\Models\AppsUtmify;
use App\Models\CheckoutsPaymentDiscount;
use Illuminate\Support\Facades\Http;
use App\Models\CheckoutCustomizationSetting;
use Illuminate\Support\Facades\Log;
use App\Models\CheckoutOrder;
use App\Models\Gateway;
use Carbon\Carbon;
use App\Models\GoogleAdsPixel;
use App\Mail\OrderGeneratedMail;
use App\Mail\OrderPaidMail;
use Illuminate\Support\Facades\Mail;


class CheckoutController extends Controller
{
    public function indexDescontos(){

        $storeId = session('store_id');


        $discountCard = CheckoutsPaymentDiscount::where('store_id', $storeId)
        ->where('payment_method', 'credit_card')
        ->value('discount_percentage') ?? 0;

        $discountPix = CheckoutsPaymentDiscount::where('store_id', $storeId)
            ->where('payment_method', 'pix')
            ->value('discount_percentage') ?? 0;

        $discountBankSlip = CheckoutsPaymentDiscount::where('store_id', $storeId)
            ->where('payment_method', 'bank_slip')
            ->value('discount_percentage') ?? 0;

        return view('checkout.descontos', compact('discountCard', 'discountPix', 'discountBankSlip'));
    }

    public function indexProvas(){

        return view('checkout.provas');
    }
    
    public function indexPagamentos(){
        
        $gateway = Gateway::where('store_id', session('store_id'))->first();

        if(!$gateway){
            $gateway = null;
        }

        return view('checkout.pagamento', compact('gateway'));
    }

    public function indexGatewayConfig($name){

        $gateway = Gateway::where('store_id', session('store_id'))->where('name', $name)->first();

        return view('checkout.gatewayconfig', compact('gateway'));
    }

    public function show(Request $request)
{
    $cart_token = $request->cookie('checkout_token');

    $checkout = Checkout::where('token', $cart_token)->first();

    if(!$checkout){

        return 'Checkout Não Encontrado';

    }

    $gPixels = GoogleAdsPixel::where('store_id', $checkout->store_id)->get() ?? null;

    $ordersBump = OrderBump::where('store_id', $checkout->store_id)->first();

    $payment_discount_pix = CheckoutsPaymentDiscount::where('store_id', $checkout->store_id)->where('payment_method', 'pix')->first();
    $payment_discount_credit_card = CheckoutsPaymentDiscount::where('store_id', $checkout->store_id)->where('payment_method', 'credit_card')->first();
     // Inicializando a variável para armazenar o valor total
     $totalValue = 0;

     $freteTotalValue = 0;

     $customizations = 0;

     if($checkout){
        // Verificando se o checkout e os itens do carrinho existem
        if ($checkout && $checkout->cart && $checkout->cart->items) {
            foreach ($checkout->cart->items as $item) {
                // Somando o valor total considerando a quantidade de cada item
                $totalValue += $item->price * $item->quantity;
            }
        }
    
        // Garantir que o valor do frete seja convertido de centavos para reais
        $freteValue = $checkout->frete->price ?? 0;
        $freteValueInReais = $freteValue * 100;  // Convertendo centavos para reais
    
        $totalValue += $freteValueInReais;  // Adicionando o frete ao total em reais
    
        $customizations = CheckoutCustomizationSetting::where('store_id', $checkout->store_id)->first();
    
        // Decodifica 'settings' para array, garantindo que não seja null
        $customizations = $customizations ? json_decode($customizations->settings, true) : [];
    }

    return view('checkout.show.yampi', compact('checkout', 'totalValue', 'customizations', 'freteValue', 'payment_discount_pix', 'payment_discount_credit_card', 'ordersBump', 'gPixels'));
}

    public function shopify_cart_payload(Request $request)
    {
        $data = $request->all();

        $domain = $request->getHost();

        $domain = Domain::where('domain', $domain)->first();

        // Verifica se a loja já existe no banco, se não, cria
        $shop = Shop::firstOrCreate(
            ['shopify_url' => $data['shop']],
            ['origin' => $data['origin']]
        );

        $domain = Domain::where('domain', $domain->domain)->first();
        
        // Salva os dados do carrinho
        $cartData = $data['cart_payload'];
        $cart = Cart::updateOrCreate(
            ['token' => $cartData['token']],
            [
                // Utilize a coluna correta; se no model está definido 'shop', utilize-o, ou ajuste para 'shop_domain'
                'shop' => $shop->shopify_url,
                'note' => $cartData['note'] ?? null,
                'attributes' => is_array($cartData['attributes']) ? json_encode($cartData['attributes']) : $cartData['attributes'],
                'original_total_price' => $cartData['original_total_price'],
                'total_price' => $cartData['total_price'],
                'total_discount' => $cartData['total_discount'],
                'total_weight' => $cartData['total_weight'],
                'item_count' => $cartData['item_count'],
                'requires_shipping' => $cartData['requires_shipping'],
                'currency' => $cartData['currency'],
                'items_subtotal_price' => $cartData['items_subtotal_price'],
                'cart_level_discount_applications' => is_array($cartData['cart_level_discount_applications']) ? json_encode($cartData['cart_level_discount_applications']) : $cartData['cart_level_discount_applications'],
            ]
        );

        // Salva os itens do carrinho
        foreach ($cartData['items'] as $item) {
            CartItem::updateOrCreate(
                ['cart_token' => $cart->token, 'variant_id' => $item['variant_id']],
                [
                    'quantity' => $item['quantity'],
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'original_price' => $item['original_price'],
                    'discounted_price' => $item['discounted_price'],
                    'line_price' => $item['line_price'],
                    'sku' => $item['sku'] ?? null,
                    'grams' => $item['grams'],
                    'vendor' => $item['vendor'],
                    'taxable' => $item['taxable'],
                    'product_id' => $item['product_id'],
                    'url' => $item['url'],
                    'image' => $item['image'],
                    'handle' => $item['handle'],
                    'featured_image' => is_array($item['featured_image']) ? json_encode($item['featured_image']) : $item['featured_image'],
                    'options_with_values' => is_array($item['options_with_values']) ? json_encode($item['options_with_values']) : $item['options_with_values'],
                    'discounts' => is_array($item['discounts']) ? json_encode($item['discounts']) : $item['discounts'],
                ]
            );
        }

        $checkout = Checkout::where('token', $cart->token)->first();

        if(!$checkout){
            // Cria ou atualiza o checkout associado a esse carrinho
            $checkout = Checkout::updateOrCreate(
                ['cart_token' => $cart->token],
                [
                    'token' => $cart->token, // Utiliza o mesmo token do carrinho
                    'shop_domain' => $shop->shopify_url,
                    'store_id' => $domain->store_id,
                    'steps' => 0,
                ]
            );
        }

        // Monta a URL de redirecionamento do checkout
        $checkoutUrl = "https://{$domain->domain}/checkout/redirect/cart/{$cart->token}";

        return response()->json([
            'skip_cart' => 0,
            'active' => true,
            'checkout_direct_url' => $checkoutUrl,
        ], 200);
    }


    public function checkout_redirect_to_link(Request $request, $token)
    {
        $key = $request->query('key');
        
        // Criando o cookie corretamente
        $cookie = Cookie::make('checkout_token', $token . '?key=' . $key, 240);  // 240 minutos de duração

        $checkout = Checkout::where('token', $token . '?key=' . $key)->firstOrFail();
        
        // Captura todos os parâmetros de marketing
        $marketingParams = $this->extractMarketingParams($request);
        
        if (!empty($marketingParams)) {
            // Atualiza os metadados mantendo os existentes e adicionando os novos
            $currentMetadata = $checkout->metadados ?? [];
            $checkout->metadados = array_merge($currentMetadata, $marketingParams);
            $checkout->ip = $request->header('CF-Connecting-IP') ?? $request->ip();
        }
        
        if($checkout->steps === 0){
            $checkout->steps = 1;
        }
        
        $checkout->save();

        return redirect()->route('show.checkoout')->cookie($cookie);
    }

    /**
     * Extrai todos os parâmetros de marketing da requisição
     */
    protected function extractMarketingParams(Request $request): array
    {
        $params = [];
        $marketingKeys = [
            // Parâmetros UTM padrão
            'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
            // Parâmetros adicionais
            'keyword', 'device', 'network', 'placement', 'creative', 'adgroupid', 'campaignid'
        ];
        
        foreach ($marketingKeys as $key) {
            if ($request->has($key)) {
                $params[$key] = $request->input($key);
            }
        }
        
        return $params;
    }


public function recive_personal_data(Request $request)
{
    // Validação dos dados recebidos (opcional, mas recomendado)
    $request->validate([
        'email' => 'required|email',
        'name' => 'required|string|max:255',
        'cpf' => 'required', // Se você tiver uma validação personalizada para CPF
        'phone' => 'required|string',
        'checkoutToken' => 'required|string',
    ]);

    $personalData = Checkout::where('token', $request->checkoutToken)->first();

    if($personalData){
        $personalData->customer_email = $request->email;
        $personalData->customer_name = $request->name;
        $personalData->customer_taxId = $request->cpf;
        $personalData->customer_telphone = $request->phone;
    
        $personalData->steps = 2;
        // Salve os dados no banco
        $personalData->save();

        return response()->json(['message' => 'Dados salvos com sucesso!'], 200);
    }

    // Retorne uma resposta (por exemplo, para indicar sucesso)
    return response()->json([
        'message' => 'Checkout não econtrado',
    ], 400);
}

public function receive_customer_shipment_address(Request $request)
{
    $validatedData = $request->validate([
        'address.cep'        => 'required|string|max:9', 
        'address.logradouro' => 'required|string|max:255',
        'numero'             => 'required|string|max:10',
        'complemento'        => 'nullable|string',
        'address.bairro'     => 'required|string|max:255',
        'address.localidade' => 'required|string|max:255',
        'address.uf'         => 'required|string|max:2', // Apenas o código UF
        'address.estado'     => 'required|string|max:255',
        'checkoutToken'      => 'required|string', // Apenas para consulta
    ]);    

    // Buscar o checkout pelo token
    $shippmentAddress = Checkout::where('token', $request->checkoutToken)->first();

    if ($shippmentAddress) {
        // Removendo o checkoutToken dos dados antes de salvar
        unset($validatedData['checkoutToken']);
        
        // Salvar os dados como JSON na coluna customer_shipping_address
        $shippmentAddress->customer_shipping_address = json_encode($validatedData);
        $shippmentAddress->save();

        return response()->json(['message' => 'Endereço salvo com sucesso!'], 200);
    }

    return response()->json([
        'message' => 'Erro ao salvar o endereço, checkout não encontrado.'
    ], 404);
}

public function get_orderbump_list(Request $request)
{
    // Recuperando o checkoutToken enviado pela requisição
    $checkoutToken = $request->input('checkoutToken');
    
    // Aqui você pode usar o checkoutToken para buscar as ofertas associadas
    $checkout = Checkout::where('token', $request->checkoutToken)->first();

    // Buscando os OrderBumps para o checkout
    $orderBumps = OrderBump::where('store_id', $checkout->store_id) // Ajuste conforme sua lógica de banco de dados
        ->with('product') // Supondo que exista um relacionamento com o produto
        ->get();

    // Estruturando os dados para retorno
    $products = $orderBumps->map(function ($orderBump) {
        // Decodificando as variantes e imagem
        $variants = $this->decodeJsonField($orderBump->product->variants);
        $image = $this->decodeJsonField($orderBump->product->image);

        // Garantindo que variants é um array e não vazio antes de acessar
        $variantTitles = [];
        $variantPrice = null; // Variável para armazenar o preço da variante
        if (is_array($variants)) {
            // Se existir mais de uma variante, pegamos os títulos e preços
            foreach ($variants as $variant) {
                $variantTitles[] = $variant['title'] ?? 'Sem título';
                if ($variantPrice === null) {
                    // Pegamos o preço da primeira variante, se houver
                    $variantPrice = $variant['price'] ?? 0;
                }
            }
        } else {
            // Caso seja apenas uma variante, pegamos o título e preço diretamente
            $variantTitles[] = $variants['title'] ?? 'Sem título';
            $variantPrice = $variants['price'] ?? 0;
        }

        return [
            'title' => $orderBump->title, // Ou o campo que você preferir
            'description' => $orderBump->description,
            'name' => $orderBump->product->title,
            'oldPrice' => $variantPrice, // Usando o preço da variante
            'newPrice' => $orderBump->price,
            'image' => $image['src'] ?? '', // Acessando a imagem (caso exista)
            'variants' => $variantTitles, // Títulos das variantes
            'order_bump_id' => $orderBump->id,
        ];
    });

    // Retornando a resposta em formato JSON
    return response()->json([
        'products' => $products
    ]);
}

// Função para tratar e decodificar o campo JSON
private function decodeJsonField($field)
{
    // Verifica se o campo não é vazio ou uma string vazia
    if (empty($field) || $field === '""') {
        return [];
    }

    // Decodifica o JSON e retorna o resultado
    return json_decode($field, true);
}


public function storePaymentDiscounts(Request $request)
{
    // Captura os valores do request e garante que sejam numéricos e nunca NULL
    $paymentMethods = [
        'credit_card' => is_numeric($request->input('credit_card')) ? floatval($request->input('credit_card')) : 0,
        'pix' => is_numeric($request->input('pix')) ? floatval($request->input('pix')) : 0,
        'bank_slip' => is_numeric($request->input('boleto')) ? floatval($request->input('boleto')) : 0,
    ];

    $storeId = session('store_id');

    if (!$storeId) {
        return response()->json([
            'success' => false,
            'message' => 'Nenhuma loja identificada na sessão.',
        ], 400);
    }

    $processedPayments = [];

    foreach ($paymentMethods as $method => $discount) {
        $discount = $discount ?? 0; // Garante que nunca será NULL

        $discountEntry = CheckoutsPaymentDiscount::updateOrCreate(
            ['store_id' => $storeId, 'payment_method' => $method],
            ['discount_percentage' => $discount] // Usa o nome correto da coluna
        );

        $processedPayments[] = [
            'payment_method' => $method,
            'discount_percentage' => $discount,
            'store_id' => $storeId,
        ];
    }

    return redirect()->back();
}

public function item_update_quantity(Request $request){
    $item = CartItem::find($request->id);
    if ($item) {
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json(['success' => true, 'quantity' => $item->quantity]);
    }
    return response()->json(['success' => false, 'message' => 'Item não encontrado'], 404);
}

public function item_remove_item(Request $request){
    $item = CartItem::find($request->id);
    if ($item) {
        $item->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false, 'message' => 'Item não encontrado'], 404);
}

public function cart_total_value(Request $request)
{
    $checkoutToken = $request->input('checkoutToken');

    if (!$checkoutToken) {
        return response()->json([
            'success' => false,
            'message' => 'Token do checkout é obrigatório.'
        ], 400);
    }

    $checkout = Checkout::where('token', $checkoutToken)->first();

    // Inicializando a variável para armazenar o valor total
    $totalValue = 0;

    // Verificando se o checkout e os itens do carrinho existem
    if ($checkout && $checkout->cart && $checkout->cart->items) {
        foreach ($checkout->cart->items as $item) {
            // Somando o valor total considerando a quantidade de cada item
            $itemTotal = $item->price * $item->quantity;
            
            // Logando o valor de cada item individualmente
            Log::info('Item ID: ' . $item->id . ' - Preço: ' . $item->price . ' - Quantidade: ' . $item->quantity . ' - Total: ' . $itemTotal);
            
            // Adicionando ao valor total
            $totalValue += $itemTotal;
        }
    }

    $fretePrice = $checkout->frete->price ?? 0;

    if($fretePrice > 0){
        // e converta para centavos
        if ($fretePrice < 1) {
            $fretePrice *= 100; // Converte para centavos
        } else {
            // Caso contrário, certifique-se de que o valor já está em centavos
            $fretePrice = round($fretePrice * 100);
        }
        
        $totalValue += $fretePrice;
    }


    return response()->json([
        'success' => true,
        'total' => number_format($totalValue / 100, 2, ',', '.')
    ]);
}

public function select_offer_orderbump(Request $request)
{
    $offerId = $request->input('offerId');
    $checkoutToken = $request->input('checkoutToken');

    if (!$checkoutToken) {
        return response()->json([
            'success' => false,
            'message' => 'Token do checkout é obrigatório.'
        ], 400);
    }

    if (!$offerId) {
        return response()->json([
            'success' => false,
            'message' => 'Id do bump é obrigatório.'
        ], 400);
    }

    // Recuperar o OrderBump
    $orderBump = OrderBump::find($offerId);

    if (!$orderBump) {
        return response()->json([
            'success' => false,
            'message' => 'Bump Não Encontrado'
        ], 400);
    }

    // Recuperar o Checkout com base no token
    $checkout = Checkout::where('token', $checkoutToken)->first();

    if (!$checkout) {
        return response()->json([
            'success' => false,
            'message' => 'Checkout Não Encontrado'
        ], 400);
    }

    // Recuperar o Cart associado ao checkoutToken
    $cart = Cart::where('token', $checkoutToken)->first();

    if (!$cart) {
        return response()->json([
            'success' => false,
            'message' => 'Carrinho Não Encontrado'
        ], 400);
    }

    // Verifique se o variant_id existe no produto, se não, defina um valor padrão (como 0)
    $variantId = $orderBump->product->variant_id ?? 0;

    // Atribua o valor de price como o original_price, caso não exista
    $originalPrice = $orderBump->price; // Ou atribua um valor default se necessário

    // Converter o preço original para centavos, se não estiver em centavos
    if ($originalPrice < 1) {
        // Se o valor for menor que 1 (presumivelmente um valor em reais com casas decimais), converta para centavos
        $originalPrice *= 100;
    } else {
        // Caso contrário, certifique-se de que o valor já está em centavos (evitar conversões duplicadas)
        $originalPrice = round($originalPrice * 100);
    }

    // Definir o preço com o desconto (se houver), em centavos
    $discountedPrice = $orderBump->discounted_price ?? $originalPrice; // Se o preço com desconto não existir, use o preço original

    // Converter o preço com desconto para centavos, se não estiver em centavos
    if ($discountedPrice < 1) {
        // Se o valor for menor que 1, converta para centavos
        $discountedPrice *= 100;
    } else {
        // Caso contrário, certifique-se de que o valor já está em centavos
        $discountedPrice = round($discountedPrice * 100);
    }

    // Calcular o valor de line_price (preço multiplicado pela quantidade), em centavos
    $linePrice = $discountedPrice * 1; // Neste caso, multiplicando pela quantidade (1 item)

    // Agora, o $linePrice está em centavos

    // Defina valores padrão para os campos que podem estar ausentes
    $sku = $orderBump->product->sku ?? 'default-sku';
    $grams = $orderBump->product->grams ?? 0; // Valor padrão de 0
    $vendor = $orderBump->product->vendor ?? 'default-vendor';
    $taxable = $orderBump->product->taxable ?? true; // Assume que o produto é tributável por padrão
    $url = $orderBump->product->url ?? ''; // Valor padrão vazio
    $image = $orderBump->product->image ?? ''; // Valor padrão vazio
    $handle = $orderBump->product->handle ?? ''; // Valor padrão vazio
    $featuredImage = $orderBump->product->image ?? '';
    $optionsWithValues = $orderBump->product->options_with_values ?? '';
    $discounts = $orderBump->discount;

    // Adicionar o produto do OrderBump como um novo CartItem
    $cartItem = new CartItem([
        'title' => $orderBump->product->title,
        'cart_token' => $cart->token,
        'product_id' => $orderBump->product_id, // Produto do OrderBump
        'price' => $orderBump->price * 100, // Preço do OrderBump em centavos
        'quantity' => 1, // Quantidade (ajuste conforme necessário)
        'total_price' => $orderBump->price * 100, // Preço total em centavos
        'discount' => $orderBump->discount, // Desconto (ajuste conforme necessário)
        'variant_id' => $variantId, // Atribuir o valor de variant_id
        'original_price' => $originalPrice, // Garantir que original_price tenha um valor em centavos
        'discounted_price' => $discountedPrice, // Atribuir o preço com o desconto ou o preço original em centavos
        'line_price' => $linePrice, // Atribuir o valor de line_price em centavos
        'sku' => $sku,
        'grams' => $grams,
        'vendor' => $vendor,
        'taxable' => $taxable,
        'url' => $url,
        'image' => $image,
        'handle' => $handle,
        'featured_image' => $featuredImage,
        'options_with_values' => $optionsWithValues,
        'discounts' => $discounts,
        'is_bump' => true,
        'bump_id' => $orderBump->id,
    ]);

    // Salvar o CartItem
    $cart->items()->save($cartItem);

    // Retornar a resposta com sucesso
    return response()->json([
        'success' => true,
        'message' => 'Produto do bump adicionado ao carrinho com sucesso!',
        'orderBump' => $orderBump,
        'cartItem' => $cartItem
    ]);
}



public function remove_offer_orderbump(Request $request)
{
    $offerId = $request->input('offerId');
    $checkoutToken = $request->input('checkoutToken');

    if (!$checkoutToken) {
        return response()->json([
            'success' => false,
            'message' => 'Token do checkout é obrigatório.'
        ], 400);
    }

    // Recuperar o Cart associado ao checkoutToken
    $cart = CartItem::where('cart_token', $checkoutToken)->where('bump_id', $request->offerId)->first();

    if (!$cart) {
        return response()->json([
            'success' => false,
            'message' => 'Bump Não Encontrado'
        ], 400);
    }

    $cart->delete();

    // Retornar a resposta com sucesso
    return response()->json([
        'success' => true,
        'message' => 'OrderBump Removido com sucesso',
    ]);
}





public function cep_lookup(Request $request)
{
    // Validação do CEP para garantir que está no formato correto
    $validated = $request->validate([
        'cep' => 'required|regex:/^\d{5}-\d{3}$/', // Verifica o formato do CEP (XXXXX-XXX)
    ]);

    // Obtenha o CEP da requisição
    $cep = $validated['cep'];

    // Realiza a requisição GET ao ViaCEP
    $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
    // Verifica se a resposta é bem-sucedida
    if ($response->successful()) {
        // Retorna a resposta JSON
        return response()->json($response->json());
    } else {
        // Caso a consulta ao ViaCEP falhe, você pode tratar isso de alguma forma
        return response()->json([
            'error' => 'Não foi possível consultar o CEP.',
        ], 400);
    }
}


public function getCartItems(Request $request)
{
    $checkoutToken = $request->input('checkoutToken');

    // Buscar o checkout e os itens do carrinho
    $checkout = Checkout::where('cart_token', $checkoutToken)->first();

    if (!$checkout) {
        return response()->json(['success' => false, 'message' => 'Carrinho não encontrado'], 404);
    }


    // Transformar os itens do carrinho em um formato JSON-friendly
    $items = $checkout->cart->items->map(function ($item) {

        $imageData = $item->featured_image;

        // Verifica se já é um array
        if (is_array($imageData)) {
            $imageUrl = $imageData['url'] ?? $imageData['src'] ?? '';
        } elseif (is_string($imageData)) {
            // Tenta decodificar a string JSON
            $decodedImage = json_decode($imageData, true);
    
            // Se a decodificação for bem-sucedida e o resultado for um array, tenta pegar a URL
            if (is_array($decodedImage)) {
                $imageUrl = $decodedImage['url'] ?? $decodedImage['src'] ?? '';
            } else {
                $imageUrl = ''; // Se não conseguir decodificar, define como vazio
            }
        } else {
            $imageUrl = ''; // Caso o formato seja inesperado
        }

        if($item->is_bump === 1){
            return [
                'id' => $item->id,
                'title' => $item->title,
                'price' => number_format($item->price / 100, 2, ',', '.'),
                'quantity' => $item->quantity,
                'image' => $imageUrl,
                'is_bump' => true,
                'bump_id' => $item->bump_id
            ];
        }

        return [
            'id' => $item->id,
            'title' => $item->title,
            'price' => number_format($item->price / 100, 2, ',', '.'),
            'quantity' => $item->quantity,
            'image' => $imageUrl,

        ];
    });

    return response()->json(['success' => true, 'items' => $items]);
}

public function list_shippiment_methods(Request $request)
    {
        $checkout = Checkout::where('token', $request->checkoutToken)->first();

        $shippings = $checkout->store->shipping;

        return response()->json($shippings);
    }


    public function recive_selected_shippiment_method(Request $request)
{
    // Valida os dados recebidos
    $request->validate([
        'checkoutToken' => 'required|string',
        'frete_id' => 'required|integer', // Ajuste para o tipo correto do ID do frete
    ]);

    // Obtém os dados do request
    $checkoutToken = $request->input('checkoutToken');
    $freteId = $request->input('frete_id');

    // Busca o checkout pelo token
    $checkout = Checkout::where('token', $checkoutToken)->first();

    if (!$checkout) {
        return response()->json(['message' => 'Checkout não encontrado.'], 404);
    }

    // Atualiza os dados do checkout
    $checkout->frete_id = $freteId;
    $checkout->steps = 3;
    $checkout->save();

    // Busca os detalhes do frete selecionado (ajuste conforme seu modelo)
    $freteSelecionado = $checkout->frete;

    if (!$freteSelecionado) {
        return response()->json(['message' => 'Frete não encontrado.'], 404);
    }

    // Retorna os detalhes do frete e a mensagem de sucesso
    return response()->json([
        'message' => 'Frete selecionado com sucesso!',
        'frete' => [
            'name' => $freteSelecionado->name,
            'price' => $freteSelecionado->price,
            'prazo' => $freteSelecionado->min_delivery_days. ' dias ou até ' . $freteSelecionado->min_delivery_days,
        ]
    ], 200);
}

    public function payment_finzalization($token){

        $order = CheckoutOrder::where('external_reference', $token)->first();

        $customizations = CheckoutCustomizationSetting::where('store_id', $order->store_id)->first();
    
        // Decodifica 'settings' para array, garantindo que não seja null
        $customizations = $customizations ? json_decode($customizations->settings, true) : [];

        $gPixels = GoogleAdsPixel::where('store_id', $order->store_id)->get() ?? null;

        if(!$order){
            abort(404);
        }

        return view('checkout.show.pix', compact('order', 'customizations', 'gPixels'));
    }


    public function generatePixPayment(Request $request)
    {
        try {
            
            $checkout = Checkout::where('token', $request->checkoutToken)->first();
            $externalReference = 'INV-' . date('Y') . '-' . str_pad(mt_rand(1, 9999999), 4, '0', STR_PAD_LEFT);
            
             // Filtra os itens do checkout e adiciona-os ao corpo da requisição
             $cartItems = $checkout->cart->items; // Resgata os itens do checkout

             $totalItemsPrice = 0;
             $data['items'] = []; // Inicialize o array de itens
             
             foreach ($cartItems as $item) {
                 $totalItemsPrice += $item->price * $item->quantity; // Adiciona o preço total dos itens
                 
                 // Adiciona o item ao array
                 $data['items'][] = [
                     "title" => $item->title,
                     "externalRef" => $externalReference, // Fallback se não houver referência externa
                     "unitPrice" => intval($item->price), // Converte para centavos (multiplicando por 100)
                     "quantity" => intval($item->quantity),
                     "tangible" => false, // Converte para booleano
                 ];
             }          

            $shippingFee = (int) (floatval($checkout->frete->price) * 100);

            $totalPrice = $totalItemsPrice + $shippingFee;

            $payment_discount_pix = CheckoutsPaymentDiscount::where('store_id', $checkout->store_id)
                ->where('payment_method', 'pix')
                ->first();

           if ($payment_discount_pix) {
                // Calcula o desconto em centavos (mantendo precisão)
                $discountValue = intval($totalPrice * $payment_discount_pix->discount_percentage / 100);
                
                // Subtrai o desconto
                $totalPrice -= $discountValue;
            }

            $shippingAddress = is_string($checkout->customer_shipping_address) 
                ? json_decode($checkout->customer_shipping_address, true) // Decodifica a string JSON para um array
                : $checkout->customer_shipping_address;

            $data = [
                "paymentMethod" => "pix",
                "value" => $totalPrice,  // Este valor deve ser o total do pedido (preço total dos itens + frete - descontos)
                "customer" => [
                    "externalRef" => $externalReference,
                    "name" => $checkout->customer_name,
                    "email" => $checkout->customer_email,
                    "phone" => preg_replace('/\D/', '', $checkout->customer_telphone),
                    "birthdate" => "1990-05-15",
                    "document" => [
                        "number" => preg_replace('/\D/', '', $checkout->customer_taxId),
                        "type" => "CPF"
                    ]
                ],
                "dueDate" => Carbon::tomorrow()->format('Y-m-d'),
                "description" => "Pagamento Gerado Checkout Adoorei",
                "externalReference" => $externalReference,
                "postbackUrl" => env('APP_URL').'/api/webhook',
                "traceable" => true,
                "pix" => [
                    "expiresInDays" => 1
                ],
                "items" => $data['items'], // Inicializa os itens
                "shipping" => [
                    "fee" => (int) (floatval($checkout->frete->price) * 100),
                    "address" => [
                        "street" => $shippingAddress['address']['logradouro'], // Acessa 'logradouro'
                        "streetNumber" => $shippingAddress['numero'],
                        "complement" => $shippingAddress['complemento'] ?? '',
                        "zipCode" => $shippingAddress['address']['cep'],
                        "neighborhood" => $shippingAddress['address']['bairro'],
                        "city" => $shippingAddress['address']['localidade'],
                        "state" => $shippingAddress['address']['estado'],
                        "country" => "BR"
                    ]
                ]
            ];    

           if(env('APP_ENV') === 'local'){
                $clientId = env('SANDBOX_CLIENT_ID'); // Recupera o CLIENT_ID da variável de ambiente
                $secretKey = env('SANDBOX_SECRET_KEY'); // Recupera o SECRET_KEY da variável de ambiente

                // Combina o CLIENT_ID e SECRET_KEY no formato "CLIENT_ID:SECRET_KEY"
                $authString = $clientId . ':' . $secretKey;

                // Codifica a string em base64
                $encodedAuthString = base64_encode($authString);

                // Agora, monta o valor do header Authorization com "Basic" seguido do valor codificado
                $authorizationHeader = 'Basic ' . $encodedAuthString;

                // Usando na requisição
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $authorizationHeader // Aqui está o Authorization codificado
                ])->post('https://sandbox.pay2w.com/transactions', $data);
           }else{

                $gateway = Gateway::where('status', 'active')->where('store_id', $checkout->store_id)->first();

                $clientId = $gateway->client_id; // Recupera o CLIENT_ID da variável de ambiente
                $secretKey = $gateway->secret_key; // Recupera o SECRET_KEY da variável de ambiente

                // Combina o CLIENT_ID e SECRET_KEY no formato "CLIENT_ID:SECRET_KEY"
                $authString = $clientId . ':' . $secretKey;

                // Codifica a string em base64
                $encodedAuthString = base64_encode($authString);

                // Agora, monta o valor do header Authorization com "Basic" seguido do valor codificado
                $authorizationHeader = 'Basic ' . $encodedAuthString;

                // Usando na requisição
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $authorizationHeader // Aqui está o Authorization codificado
                ])->post('https://api.pay2w.com/transactions', $data);
           }

            // Converte a resposta para JSON
            $responseData = $response->json();

            if(isset($responseData['message']) === 'Unauthorized.'){
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciais Invalidas Contate O Dono Da Loja',
                ], 200);
            }

            // Criar o pedido no banco de dados
            $checkoutOrder = CheckoutOrder::create([
                'payment_method' => 'pix',
                'store_id' => $checkout->store_id,
                'checkout_token' => $checkout->token,
                'status' => 'pending',
                'total_value' => $responseData['amount'], // Salva o valor diretamente
                'installments' => 1,
                'customer_data' => json_encode($data['customer']),
                'items' => json_encode($data['items']),
                'shipping_data' => json_encode($data['shipping']),
                'payment_data' => json_encode($responseData['pix']),
                'external_reference' => $externalReference,
            ]);

            $utmify = AppsUtmify::where('store_id', $checkout->store_id)->first();

            if($utmify){
                $orderData = [
                    'orderId' => $checkoutOrder->external_reference,
                    'platform' => 'shopify',
                    'paymentMethod' => 'pix',
                    'status' => 'waiting_payment',
                    'createdAt' => date('Y-m-d H:i:s'),
                    'approvedDate' => null,
                    'refundedAt' => null,
                    'customer' => [
                        'name' => $checkout->customer_name,
                        'email' => $checkout->customer_email,
                        'phone' => $checkout->customer_telphone,
                        'document' => $checkout->customer_taxId,
                        'country' => 'BR',
                        'ip' => $checkout->ip // Usando o IP real do cliente
                    ],
                    'products' => array_map(function($item) {
                        return [
                            'id' => '123', // Usando ID do item ou gerando um fallback
                            'name' => 'PRODUTO VENDEDOR',
                            'planId' => null,
                            'planName' => null,
                            'quantity' => $item['quantity'],
                            'priceInCents' => intval($item['unitPrice'])
                        ];
                    }, $data['items']),
                    'trackingParameters' => [
                        'src' => $checkout->metadados['src'] ?? null,
                        'sck' => $checkout->metadados['sck'] ?? null,
                        'utm_source' => $checkout->metadados['utm_source'] ?? null,
                        'utm_campaign' => $checkout->metadados['utm_campaign'] ?? null,
                        'utm_medium' => $checkout->metadados['utm_medium'] ?? null,
                        'utm_content' => $checkout->metadados['utm_content'] ?? null,
                        'utm_term' => $checkout->metadados['utm_term'] ?? null
                    ],
                    'commission' => [
                        'totalPriceInCents' => $totalPrice,
                        'gatewayFeeInCents' => 0, // Ajustar conforme gateway
                        'userCommissionInCents' => 0, // Ajustar conforme regras de comissão
                        'currency' => 'BRL'
                    ],
                    'isTest' => false,
                ];
    
                $response = Http::withHeaders([
                    'x-api-token' => $utmify->utmify_api_key,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])->post('https://api.utmify.com.br/api-credentials/orders', $orderData);

                return $response;

            }

            Mail::to($checkout->customer_email)->send(new OrderGeneratedMail($checkoutOrder));

            return response()->json([
                'success' => true,
                'message' => 'Pagamento PIX gerado com sucesso!',
                'redirect_url' => route('finalization.checkout', ['external_reference' => $externalReference]),
            ], 200);        

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao gerar pagamento PIX',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function processCardPayment(Request $request){
        try {

            $requestData = $request->except('card_name');
            foreach ($requestData as $key => $value) {
                if (is_string($value)) {
                    $requestData[$key] = preg_replace('/\s+/', '', $value); // Remove todos os espaços em branco
                }
            }

            // Criar uma nova instância de Request com os dados sem espaços
            $request->merge($requestData);
            
            $validatedData = $request->validate([
                'card_number' => 'required|string|size:16', // 16 dígitos para o número do cartão
                'card_name' => 'required|string|max:255',
                'card_expiry' => 'required|string|size:5', // MM/YY
                'card_cvc' => 'required|string|max:4', // 3 dígitos para CVC
                'cpf' => 'required|string|size:11', // CPF com 11 dígitos
                'installments' => 'required|integer|min:1',
            ]);
        
            // Formatar os dados recebidos
            $cardData = $validatedData;
        
            // Remover espaços extras do número do cartão e data de expiração
            $cardData['card_number'] = preg_replace('/\s+/', '', $cardData['card_number']); // Remover espaços do número do cartão
            $cardData['card_expiry'] = preg_replace('/\s+/', '', $cardData['card_expiry']); // Remover espaços da data de expiração
        
             // Separar a data de expiração em mês e ano
            list($expiryMonth, $expiryYear) = explode('/', $cardData['card_expiry']);

            // Verificar se o ano tem 2 dígitos e formatar para 4 dígitos
            if (strlen($expiryYear) == 2) {
                $expiryYear = '20' . $expiryYear; // Adiciona "20" para formar um ano completo
            }

            $cardData['card_expiry_month'] = trim($expiryMonth);  // Mês da expiração
            $cardData['card_expiry_year'] = trim($expiryYear);  // Ano da expiração completo
        
            // Formatar o número de parcelas como inteiro
            $cardData['installments'] = (int) $cardData['installments'];

            $checkout = Checkout::where('token', $request->checkoutToken)->first();
            $externalReference = 'INV-' . date('Y') . '-' . str_pad(mt_rand(1, 9999999), 4, '0', STR_PAD_LEFT);
            
             // Filtra os itens do checkout e adiciona-os ao corpo da requisição
             $cartItems = $checkout->cart->items; // Resgata os itens do checkout

             $totalItemsPrice = 0;
             $data['items'] = []; // Inicialize o array de itens
             
             foreach ($cartItems as $item) {
                 $totalItemsPrice += $item->price * $item->quantity; // Adiciona o preço total dos itens
                 
                 // Adiciona o item ao array
                 $data['items'][] = [
                     "title" => $item->title,
                     "externalRef" => $externalReference, // Fallback se não houver referência externa
                     "unitPrice" => intval($item->price), // Converte para centavos (multiplicando por 100)
                     "quantity" => intval($item->quantity),
                     "tangible" => false, // Converte para booleano
                 ];
             }          

            $shippingFee = (int) (floatval($checkout->frete->price) * 100);

            $totalPrice = $totalItemsPrice + $shippingFee;

            $shippingAddress = is_string($checkout->customer_shipping_address) 
                ? json_decode($checkout->customer_shipping_address, true) // Decodifica a string JSON para um array
                : $checkout->customer_shipping_address;

            $data = [
                "paymentMethod" => "credit_card",
                "value" => $totalPrice,  // Este valor deve ser o total do pedido (preço total dos itens + frete - descontos)
                "customer" => [
                    "externalRef" => $externalReference,
                    "name" => $checkout->customer_name,
                    "email" => $checkout->customer_email,
                    "phone" => preg_replace('/\D/', '', $checkout->customer_telphone),
                    "birthdate" => "1990-05-15",
                    "document" => [
                        "number" => preg_replace('/\D/', '', $checkout->customer_taxId),
                        "type" => "CPF"
                    ]
                ],
                "dueDate" => Carbon::tomorrow()->format('Y-m-d'),
                "description" => "Pagamento Gerado Checkout Adoorei",
                "externalReference" => $externalReference,
                "postbackUrl" => env('APP_URL').'/api/webhook',
                "traceable" => true,
                "card" => [
                    "id" => $externalReference,
                    "number" => $cardData['card_number'],
                    "holderName" => $cardData['card_name'],
                    "expirationMonth" => $cardData['card_expiry_month'],
                    "expirationYear" => $cardData['card_expiry_year'],
                    "cvv" => $cardData['card_cvc'],
                ],
                "items" => $data['items'], // Inicializa os itens
                "shipping" => [
                    "fee" => (int) (floatval($checkout->frete->price) * 100),
                    "address" => [
                        "street" => $shippingAddress['address']['logradouro'], // Acessa 'logradouro'
                        "streetNumber" => $shippingAddress['numero'],
                        "complement" => $shippingAddress['complemento'] ?? '',
                        "zipCode" => $shippingAddress['address']['cep'],
                        "neighborhood" => $shippingAddress['address']['bairro'],
                        "city" => $shippingAddress['address']['localidade'],
                        "state" => $shippingAddress['address']['estado'],
                        "country" => "BR"
                    ]
                ],
                "installments" => $cardData['installments'],
            ];    


           if(env('APP_ENV') === 'local'){
                $clientId = env('SANDBOX_CLIENT_ID'); // Recupera o CLIENT_ID da variável de ambiente
                $secretKey = env('SANDBOX_SECRET_KEY'); // Recupera o SECRET_KEY da variável de ambiente

                // Combina o CLIENT_ID e SECRET_KEY no formato "CLIENT_ID:SECRET_KEY"
                $authString = $clientId . ':' . $secretKey;

                // Codifica a string em base64
                $encodedAuthString = base64_encode($authString);

                // Agora, monta o valor do header Authorization com "Basic" seguido do valor codificado
                $authorizationHeader = 'Basic ' . $encodedAuthString;

                // Usando na requisição
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $authorizationHeader // Aqui está o Authorization codificado
                ])->post('https://sandbox.pay2w.com/transactions', $data);
           }else{

            $gateway = Gateway::where('status', 'active')->where('store_id', $checkout->store_id)->first();

            $clientId = $gateway->client_id; // Recupera o CLIENT_ID da variável de ambiente
            $secretKey = $gateway->secret_key; // Recupera o SECRET_KEY da variável de ambiente

            // Combina o CLIENT_ID e SECRET_KEY no formato "CLIENT_ID:SECRET_KEY"
            $authString = $clientId . ':' . $secretKey;

            // Codifica a string em base64
            $encodedAuthString = base64_encode($authString);

            // Agora, monta o valor do header Authorization com "Basic" seguido do valor codificado
            $authorizationHeader = 'Basic ' . $encodedAuthString;

            // Usando na requisição
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $authorizationHeader // Aqui está o Authorization codificado
            ])->post('https://api.pay2w.com/transactions', $data);
       }
            
            // Converte a resposta para JSON
            $responseData = $response->json();

            if($responseData['status'] !== 'refused'){
                // Criar o pedido no banco de dados
                $checkoutOrder = CheckoutOrder::create([
                    'payment_method' => 'credit_card',
                    'store_id' => $checkout->store_id,
                    'checkout_token' => $checkout->token,
                    'status' => 'refused',
                    'total_value' => $data['value'], // Salva o valor diretamente
                    'installments' => $data['installments'],
                    'customer_data' => json_encode($data['customer']),
                    'items' => json_encode($data['items']),
                    'shipping_data' => json_encode($data['shipping']),
                    'payment_data' => json_encode([
                        'card' => $data['card'],
                        'error_reason' => $responseData['refusedReason'] ?? null, // Certifique-se de que `reason` existe
                    ]),
                    'external_reference' => $externalReference,
                ]);

                return response()->json([
                    'success' => false,
                    'approved' => false,
                    'message' => $responseData['refusedReason'],
                ], 400);
            }
            elseif($responseData['status'] !== 'paid' || $responseData['status'] !== 'authorized'){
                 // Criar o pedido no banco de dados
                $checkoutOrder = CheckoutOrder::create([
                    'payment_method' => 'credit_card',
                    'store_id' => $checkout->store_id,
                    'checkout_token' => $checkout->token,
                    'status' => 'paid',
                    'total_value' => $data['value'], // Salva o valor diretamente
                    'installments' => $data['installments'],
                    'customer_data' => json_encode($data['customer']),
                    'items' => json_encode($data['items']),
                    'shipping_data' => json_encode($data['shipping']),
                    'payment_data' => json_encode([
                        'card' => $data['card'],
                        'hash' => $responseData['card']['hash'] ?? null, // Certifique-se de que `reason` existe
                    ]),
                    'external_reference' => $externalReference,
                ]);

                return response()->json([
                    'success' => true,
                    'approved' => true,
                    'message' => 'Pagamento efetuado com sucesso!',
                    'redirect_url' => route('complete.checkout', ['external_reference' => $externalReference]),
                ], 200); 
            }
                  

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar pagamento',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function payment_complete($externalReference){

        $order = CheckoutOrder::where('external_reference', $externalReference)->first();

        $customizations = CheckoutCustomizationSetting::where('store_id', $order->store_id)->first();
    
        $gPixels = GoogleAdsPixel::where('store_id', $order->store_id)->get() ?? null;

        // Decodifica 'settings' para array, garantindo que não seja null
        $customizations = $customizations ? json_decode($customizations->settings, true) : [];

        if(!$order){
            abort(404);
        }

        $order_customer_data = $order->customer_data ? json_decode($order->customer_data, true) : [];
        $order_shipping_data = $order->shipping_data ? json_decode($order->shipping_data, true) : [];
        $items = $order->checkout->cart->items;

        return view('checkout.show.complete', compact('order', 'customizations', 'order_customer_data', 'items', 'order_shipping_data', 'gPixels'));
    }


    public function search_shippiment_data(Request $request){

        $checkout = Checkout::where('token', $request->checkout_token)->first();

        return response()->json([
            'success' => true,
            'data' => json_decode($checkout->customer_shipping_address),
            'frete' => $checkout->frete,
        ], 200);

    }

    public function storeGatewayCredentials(Request $request)
    {

        $request->validate([
            'client_id' => 'required|string',
            'secret_key' => 'required|string',
            'enable_credit_card' => 'nullable',
            'enable_pix' => 'nullable',
            'enable_boleto' => 'nullable',
            'enable_custom_interest_rate' => 'nullable',
            'additional_interest_rate' => 'nullable|numeric|min:0',
            'interest_rule' => 'nullable|string',
        ]);


        $gateway = Gateway::where('store_id', session('store_id'))->where('name', 'pay2win')->first();

        if (!$gateway) {
            // Criando um novo gateway
            Gateway::create([
                'name' => 'pay2win',
                'store_id' => session('store_id'),
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key,
                'enable_credit_card' => $request->boolean('enable_credit_card'),
                'enable_pix' => $request->boolean('enable_pix'),
                'enable_boleto' => $request->boolean('enable_boleto'),
                'enable_custom_interest_rate' => $request->boolean('enable_custom_interest_rate'),
                'additional_interest_rate' => $request->additional_interest_rate,
                'interest_rule' => $request->interest_rule,
            ]);
        } else {
            // Atualizando os dados do gateway existente
            $gateway->update([
                'client_id' => $request->client_id,
                'secret_key' => $request->secret_key,
                'enable_credit_card' => $request->boolean('enable_credit_card'),
                'enable_pix' => $request->boolean('enable_pix'),
                'enable_boleto' => $request->boolean('enable_boleto'),
                'enable_custom_interest_rate' => $request->boolean('enable_custom_interest_rate'),
                'additional_interest_rate' => $request->additional_interest_rate,
                'interest_rule' => $request->interest_rule,
            ]);
        }

        return redirect()->route('gatewayconfig', ['gateway' => 'pay2win'])->with('success', 'Gateway salvo com sucesso!');
        

    }

    public function shipping_get_list(Request $request){
        $checkout = Checkout::where('token', $request->checkoutToken)->first();

        if(!$checkout){
            return response()->json([
                'success' => false,
                'message' => 'Checkout Ou Frete não encontrados.',
            ], 200); 
        }

        return response()->json([
            'success' => true,
            'frete' => $checkout->frete->price,
        ], 200);

    }

}
