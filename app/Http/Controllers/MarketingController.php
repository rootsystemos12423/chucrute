<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreProductShopifyCheckout;
use App\Models\OrderBump;


class MarketingController extends Controller
{
    public function cuponsIndex() {
     
        return view('marketing.cupons');
    }

    public function orderbumpIndex() {

        $orderbumps = OrderBump::where('store_id', session('store_id'))->get();
        $count = OrderBump::where('store_id', session('store_id'))->count();


        return view('marketing.orderbump', compact('orderbumps', 'count'));
    }

    public function upsellIndex() {
     
        return view('marketing.upsell');
    }

    public function orderbump_create() {
     
        return view('marketing.orderbump.create');
    }

    // No seu Controller
    public function list_products_orderbump(Request $request)
{
    // Verifica se o 'store_id' foi enviado na requisição
    $storeId = $request->input('store_id');
    
    // Se não for encontrado o 'store_id', podemos retornar um erro ou lidar de outra forma
    if (!$storeId) {
        return response()->json([
            'error' => 'Store ID não fornecido.',
        ], 400);
    }

    // Inicia a consulta para obter os produtos
    $query = StoreProductShopifyCheckout::where('user_checkout_store_id', $storeId);

    // Se a busca for fornecida, filtra pelos produtos
    if ($request->has('search') && $request->input('search') !== '') {
        $searchTerm = $request->input('search');
        $query->where('title', 'like', "%{$searchTerm}%");
    }

    // Obtemos os produtos com o filtro aplicado (se houver)
    $products = $query->get();

    // Envia os produtos de volta
    return response()->json([
        'products' => $products->map(function ($product) {
            // Decodifica o JSON da imagem
            $image = json_decode($product->image, true); // A imagem é uma string JSON
    
            return [
                'id' => $product->product_id,
                'name' => $product->title,
                'image' => $image['src'], // Acessa o campo 'src' da imagem
            ];
        }),
    ], 200);    
}


public function store_orderbump_info(Request $request)
{
    // Validação dos dados enviados no formulário
    $request->validate([
        'product_id' => 'required', // Valida se o produto existe no banco
        'offer_title' => 'required|string|max:255',
        'discount' =>  'required|string|max:255',
        'offer_button_text' =>  'required|string|max:255',
        'offer_desc_text' =>  'required|string|max:255',
    ]);

    try {

        $product = StoreProductShopifyCheckout::where('product_id', $request->input('product_id'))->first();

        // Criando ou atualizando a informação de order bump
        $orderBump = new OrderBump();
        $orderBump->store_id = $product->userCheckoutStore->id;
        $orderBump->product_id = $request->input('product_id');
        $variants = json_decode($product->variants, true); // Decodifica para um array associativo

        if (!empty($variants) && isset($variants[0]['price'])) {
            $originalPrice = $variants[0]['price']; // Preço original do primeiro variant
            $discount = $request->input('discount'); // Desconto em %
        
            // Calcula o preço final e garante que sempre tenha duas casas decimais
            $orderBump->price = sprintf('%.2f', $originalPrice - ($originalPrice * ($discount / 100)));
        }             
         else {
            return redirect()->back()->with('error', 'Erro: Variants não encontrados ou mal formatados.');
        }

        $orderBump->discount = $request->input('discount');
        $orderBump->title = $request->input('offer_title');
        $orderBump->description = $request->input('offer_desc_text');
        $orderBump->button_text = $request->input('offer_button_text');

        // Salvar no banco de dados
        $orderBump->save();

        // Retornar uma resposta de sucesso
        return redirect()->back()->with('success', 'Order Bump criado com sucesso!');
    } catch (\Exception $e) {
        // Se houver algum erro, capturar e retornar uma mensagem
        return redirect()->back()->with('error', 'Erro ao criar Order Bump: ' . $e->getMessage());
    }
}


}
