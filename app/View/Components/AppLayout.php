<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Store;


class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Obtém todas as lojas do usuário
        $stores = Store::where('user_id', auth()->user()->id)->get();

        // Se a sessão store_id não estiver definida, define com a loja mais antiga
        if (!session()->has('store_id') && $stores->isNotEmpty()) {
            $oldestStore = $stores->sortBy('created_at')->first(); // Loja mais antiga
            session(['store_id' => $oldestStore->id]);
        }

        // Obtém a loja ativa baseada na sessão
        $authStore = Store::where('id', session('store_id'))->first();

        return view('layouts.app', compact('stores', 'authStore'));
    }

}
