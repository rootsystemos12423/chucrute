<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\Shipping;
use App\Models\Log;

class ConfigController extends Controller
{
    public function geralIndex(){

        return view('config.geral');
    }

    public function dominiosIndex(){

        $domains = Domain::where('store_id', session('store_id'))->get();

        return view('config.dominios', compact('domains'));
    }

    public function logisticIndex(){

        $fretes = Shipping::where('store_id', session('store_id'))->get();

        return view('config.logistic', compact('fretes'));
    }

    public function storeDomain(Request $request)
{
    // Validação dos dados recebidos
    $request->validate([
        'domain' => 'required|string|max:255',
        'sub_domain' => 'required|string|max:255',
    ]);

    $domainUrl = $request->input('sub_domain').'.'.$request->input('domain');

    try {
        // Criação do novo domínio
        $domain = new Domain();
        $domain->domain = $domainUrl;
        $domain->store_id = session('store_id'); // Se o domínio estiver associado a um usuário
        $domain->save();

        // Retorna uma resposta de sucesso
        return redirect()->back()->with('success', 'Domínio cadastrado com sucesso!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Erro ao cadastrar o domínio.');
    }
}

public function LogisticShow(){

    return view('config.logisticCreate');
}

public function logistic_store(Request $request)
    {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'nullable|numeric|min:0',
                'min_delivery_days' => 'nullable|integer|min:0',
                'max_delivery_days' => 'nullable|integer|min:0',
                'status' => 'required|in:active,inactive',
                'store_id' => 'required',
            ]);

            $shipping = Shipping::create([
                'name' => $request->name,
                'price' => $request->price,
                'min_delivery_days' => $request->min_delivery_days,
                'max_delivery_days' => $request->max_delivery_days,
                'status' => $request->status,
                'store_id' => $request->store_id,
            ]);

            return response()->json([
                'message' => 'Frete cadastrado com sucesso!',
                'shipping' => $shipping
            ], 201);
        }

    public function LogsIndex(){
            $query = Log::with('user')
            ->orderBy('created_at', 'desc');

        // Aplicar filtros
        if ($exception = request('exception')) {
            $query->where('exception', $exception);
        }

        if ($code = request('code')) {
            $query->where('code', $code);
        }

        // Filtro por data
        $dateFilter = request('date', 'week');
        switch ($dateFilter) {
            case 'today': $query->whereDate('created_at', today()); break;
            case 'week': $query->where('created_at', '>=', now()->subWeek()); break;
            case 'month': $query->where('created_at', '>=', now()->subMonth()); break;
        }

        return view('config.logs', [
            'logs' => $query->paginate(20),
            'exceptionTypes' => Log::distinct('exception')->pluck('exception')
        ]);
    }

    public function Logshow(Log $log)
    {
        return view('config.log', compact('log'));
    }
}
