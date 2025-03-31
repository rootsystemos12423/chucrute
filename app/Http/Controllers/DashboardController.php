<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Domain;
use App\Models\Gateway;
use App\Models\Shipping;
use App\Models\CheckoutOrder;


class DashboardController extends Controller
{
    public function index()
    {
        $storeId = session('store_id');

        $domain = Domain::where('store_id', $storeId)->first() ?? null;
        $gateway = Gateway::where('store_id', $storeId)->first() ?? null;
        $shipping = Shipping::where('store_id', $storeId)->first() ?? null;

        return view('dashboard', compact('domain', 'gateway', 'shipping'));
    }


    public function create_checkout_store(Request $request)
{
    // Validação dos dados recebidos
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    try {
        // Criação da loja
        $store = Store::create([
            'name' => $validated['name'],  // Nome da loja
            'user_id' => auth()->user()->id,  // Atribuindo o ID do usuário logado
        ]);

        session(['store_id' => $store->id]);

        // Retorno de sucesso
        return redirect()->back(); // HTTP 201 Created
    } catch (\Exception $e) {
        // Retorno de erro
        return response()->json([
            'status' => 'error',
            'message' => 'Erro ao criar a loja: ' . $e->getMessage()
        ], 500); // HTTP 500 Internal Server Error
    }
}


public function change_checkout_store(Request $request)
{
        // Validação dos dados recebidos
        $validated = $request->validate([
            'store_id' => 'required|string|max:255',
        ]);

        session(['store_id' => $request->store_id]);

        // Retorno de sucesso
        return redirect()->back(); // HTTP 201 Created
}

public function mail(){

    $order = CheckoutOrder::find(5);
    
    return view('mail.order_confirmation', compact('order'));
}

}
