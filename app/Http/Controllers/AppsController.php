<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopifyCheckoutStore;
use Illuminate\Support\Facades\Http;
use App\Models\StoreProductShopifyCheckout;
use Illuminate\Support\Facades\Log;
use App\Models\Domain;
use App\Models\GoogleAdsPixel;
use App\Models\AppsUtmify;

class AppsController extends Controller
{
    public function index(){

        return view('apps.index');
    }

    public function shopify(){

        $shopify = ShopifyCheckoutStore::Find(session('store_id')) ?? '';

        return view('apps.shopify.shopify', compact('shopify'));
    }

    public function storeShopifyCheckoutStore(Request $request)
    {

        $validated = $request->validate([
            'store_id' => 'required|exists:users_checkout_stores,id',
            'shopify_url' => 'required|string',
            'shopify_api_token' => 'required|string',
            'shopify_api_key' => 'required|string',
            'shopify_api_secret' => 'required|string',
            'skip_cart' => 'sometimes|boolean',
        ]);

        $domain = Domain::where('store_id', $validated['store_id'])->first();

        if(!$domain){
            return response()->json([
                'message' => 'Dominio Não Cadastrado',
            ], 400);
        }

        $FindStore = ShopifyCheckoutStore::where('store_id', $validated['store_id'])->first();

        if($FindStore){
            $FindStore->update($validated);
            $theme = $this->updateThemeAssets($FindStore);
            $products = $this->getShopifyProducts($FindStore);
            
            return response()->json([
                'message' => 'Shopify checkout store updated successfully!',
            ], 200);
        }

        // Cria um novo registro na tabela shopify_checkout_store
        $store = ShopifyCheckoutStore::create($validated);

        $theme = $this->updateThemeAssets($store, $domain);

        $products = $this->getShopifyProducts($store);

        return response()->json([
            'message' => 'Shopify checkout store created successfully!',
        ], 200);
    }

    private function getShopifyProducts($store)
{
    // Construa a URL da API da Shopify
    $apiUrl = "https://{$store->shopify_url}.myshopify.com/admin/api/2024-10/products.json";

    try {
        // Realiza a requisição GET
        $response = Http::withHeaders([
            'X-Shopify-Access-Token' => $store->shopify_api_token,
        ])->get($apiUrl);

        // Verifica se a requisição foi bem-sucedida
        if ($response->successful()) {
            $products = $response->json()['products'] ?? [];

            // Para cada produto retornado, salve na tabela store_products_shopify_checkout
            foreach ($products as $product) {
                // Verifique se o produto já existe com base no product_id
                $existingProduct = StoreProductShopifyCheckout::where('product_id', $product['id'])->first();

                if ($existingProduct) {
                    // Caso o produto exista, faça a atualização dos dados diferentes
                    $existingProduct->update([
                        'title' => $product['title'],
                        'body_html' => $product['body_html'] ?? null,
                        'vendor' => $product['vendor'] ?? null,
                        'product_type' => $product['product_type'] ?? null,
                        'created_at_shopify' => $product['created_at'] ?? null,
                        'updated_at_shopify' => $product['updated_at'] ?? null,
                        'handle' => $product['handle'] ?? null,
                        'published_at' => $product['published_at'] ?? null,
                        'template_suffix' => $product['template_suffix'] ?? null,
                        'published_scope' => $product['published_scope'] ?? null,
                        'tags' => $product['tags'] ?? null,
                        'status' => $product['status'] ?? null,
                        'admin_graphql_api_id' => $product['admin_graphql_api_id'] ?? null,
                        'variants' => json_encode($product['variants'] ?? []),
                        'options' => json_encode($product['options'] ?? []),
                        'images' => json_encode($product['images'] ?? []),
                        'image' => json_encode($product['image'] ?? []),
                    ]);
                } else {
                    // Caso o produto não exista, crie um novo
                    StoreProductShopifyCheckout::create([
                        'product_id' => $product['id'],
                        'title' => $product['title'],
                        'body_html' => $product['body_html'] ?? null,
                        'vendor' => $product['vendor'] ?? null,
                        'product_type' => $product['product_type'] ?? null,
                        'created_at_shopify' => $product['created_at'] ?? null,
                        'updated_at_shopify' => $product['updated_at'] ?? null,
                        'handle' => $product['handle'] ?? null,
                        'published_at' => $product['published_at'] ?? null,
                        'template_suffix' => $product['template_suffix'] ?? null,
                        'published_scope' => $product['published_scope'] ?? null,
                        'tags' => $product['tags'] ?? null,
                        'status' => $product['status'] ?? null,
                        'admin_graphql_api_id' => $product['admin_graphql_api_id'] ?? null,
                        'variants' => json_encode($product['variants'] ?? []),
                        'options' => json_encode($product['options'] ?? []),
                        'images' => json_encode($product['images'] ?? []),
                        'image' => json_encode($product['image'] ?? []),
                        'user_checkout_store_id' => $store->id, // Salva o relacionamento com a store
                    ]);
                }

                // Caso o produto tenha imagens, associe-as com a lógica necessária
                if (!empty($product['images'])) {
                    foreach ($product['images'] as $image) {
                        // Salve as imagens associadas ao produto, se necessário
                        // Isso pode incluir salvar os links ou outras informações
                    }
                }

                // Salve as variantes, se necessário
                if (!empty($product['variants'])) {
                    foreach ($product['variants'] as $variant) {
                        // Salve as variantes associadas ao produto, se necessário
                    }
                }
            }

            return $products; // Retorna a lista de produtos
        } else {
            // Em caso de erro, retorna uma mensagem de erro
            return ['error' => 'Erro ao recuperar produtos: ' . $response->status()];
        }
    } catch (\Exception $e) {
        // Em caso de exceção, retorna uma mensagem de erro
        return ['error' => 'Erro ao recuperar produtos: ' . $e->getMessage()];
    }
}


private function updateThemeAssets($store, $domain)
{
    // Obtém a lista de temas da loja
    $apiUrl = "https://{$store->shopify_url}.myshopify.com/admin/api/2024-10/themes.json";
    
    $response = Http::withHeaders([
        'X-Shopify-Access-Token' => $store->shopify_api_token,
        'Content-Type' => 'application/json',
    ])->get($apiUrl);

    // Verifica se a resposta foi bem-sucedida
    if (!$response->successful()) {
        Log::error('Erro ao obter temas do Shopify', ['response' => $response->body()]);
        return;
    }

    // Extrai o ID do tema ativo
    $themes = collect($response->json()['themes'] ?? []);
    $activeTheme = $themes->firstWhere('role', 'main');

    if (!$activeTheme) {
        Log::error('Nenhum tema ativo encontrado para a loja: ' . $store->shopify_url);
        return;
    }

    $activeThemeId = $activeTheme['id'];

    $endpoint_url = "https://{$domain->domain}/api/public/shopify/cart";

    // Renderiza o snippet e passa a variável para a view
    $snippetContent = view('snippet.yampi', ['endpoint_url' => $endpoint_url])->render();

    // URL para atualizar os assets do tema
    $apiUrl = "https://{$store->shopify_url}.myshopify.com/admin/api/2024-10/themes/{$activeThemeId}/assets.json";

    // Atualiza o arquivo no tema ativo
    $updateResponse = Http::withHeaders([
        'X-Shopify-Access-Token' => $store->shopify_api_token,
        'Content-Type' => 'application/json',
    ])->put($apiUrl, [
        'asset' => [
            'key'   => 'snippets/ChtCheckout.liquid',
            'value' => $snippetContent,
        ]
    ]);

    // Obtém o conteúdo do layout/theme.liquid
    $apiUrl = "https://{$store->shopify_url}.myshopify.com/admin/api/2024-10/themes/{$activeThemeId}/assets.json?asset[key]=layout/theme.liquid";

    $response = Http::withHeaders([
        'X-Shopify-Access-Token' => $store->shopify_api_token,
        'Content-Type' => 'application/json',
    ])->get($apiUrl);

    // Verifica se a requisição foi bem-sucedida
    if (!$response->successful()) {
        Log::error('Erro ao obter theme.liquid', ['response' => $response->body()]);
        return;
    }

    // Obtém o conteúdo do theme.liquid
    $themeLiquidContent = $response->json()['asset']['value'] ?? '';

    if (empty($themeLiquidContent)) {
        Log::error('theme.liquid retornou um valor vazio');
        return;
    }

    // Garante que {{ content_for_header }} e {{ content_for_layout }} estejam presentes
    if (!str_contains($themeLiquidContent, '{{ content_for_header }}')) {
        $themeLiquidContent = str_replace('<head>', "<head>\n    {{ content_for_header }}", $themeLiquidContent);
    }

    if (!str_contains($themeLiquidContent, '{{ content_for_layout }}')) {
        $themeLiquidContent = str_replace('<body>', "<body>\n    {{ content_for_layout }}", $themeLiquidContent);
    }

    // Adiciona o snippet ao final do <body>
    $snippetScript = "{% capture cht_snippet_content %}{% include 'ChtCheckout' %}{% endcapture %} {% unless cht_snippet_content contains 'Liquid error' %} {% include 'ChtCheckout' %} {% endunless %}";

    if (!str_contains($themeLiquidContent, $snippetScript)) {
        $themeLiquidContent = str_replace('</body>', "    $snippetScript\n</body>", $themeLiquidContent);
    }

    // Atualiza o theme.liquid com o novo conteúdo
    $updateResponse = Http::withHeaders([
        'X-Shopify-Access-Token' => $store->shopify_api_token,
        'Content-Type' => 'application/json',
    ])->put("https://{$store->shopify_url}.myshopify.com/admin/api/2024-10/themes/{$activeThemeId}/assets.json", [
        'asset' => [
            'key'   => 'layout/theme.liquid',
            'value' => $themeLiquidContent,
        ]
    ]);

    if ($updateResponse->successful()) {
        Log::info('theme.liquid atualizado com sucesso', ['theme_id' => $activeThemeId]);
    } else {
        Log::error('Erro ao atualizar theme.liquid', ['response' => $updateResponse->body()]);
    }

}


public function googleads(){

    $pixels = GoogleAdsPixel::where('store_id', session('store_id'))->get();

    $count = GoogleAdsPixel::where('store_id', session('store_id'))->count();

    return view('apps.googleAds.gads', compact('pixels', 'count'));
}

public function googleadsCreate(){

    return view('apps.googleAds.create');
}

public function googleadsStore(Request $request)
{
    // Validação dos dados
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'conversion_id' => 'required|string|max:50',
        'conversion_label' => 'required|string|max:255',
    ]);

    // Criar e salvar o pixel no banco
    $pixel = GoogleAdsPixel::create([
        'store_id' => session('store_id'), // Inclui o store_id para evitar erro
        'conversion_id' => $validated['conversion_id'],
        'name' => $validated['name'],
        'conversion_label' => $validated['conversion_label'],
        'send_event_pix' => $request->has('sent_pix'), // Salva como true se estiver presente
        'send_event_bankslip' => $request->has('sent_bank_slip'), // Salva como true se estiver presente
    ]);

    // Redirecionar com mensagem de sucesso
    return redirect()->route('googleads')->with('success', 'Pixel do Google Ads criado com sucesso!');
}

public function utmify(){

    $utmify = AppsUtmify::where('store_id', session('store_id'))->first() ?? null;

    return view('apps.utmify.create', compact('utmify'));
}

public function utmify_store(Request $request){
     // Validação dos dados
     $validated = $request->validate([
        'name' => 'required|string|max:255',
        'api_key' => 'required|string|max:255',
    ]);

    // Criar e salvar o pixel no banco
    $pixel = AppsUtmify::updateOrCreate(
        ['store_id' => session('store_id')],
        [
        'utmify_api_key' => $validated['api_key'], // Inclui o store_id para evitar erro
        ]);

    // Redirecionar com mensagem de sucesso
    return redirect()->route('utmify')->with('success', 'Utmify Cadastrada Com Sucesso!');
}
    
}
