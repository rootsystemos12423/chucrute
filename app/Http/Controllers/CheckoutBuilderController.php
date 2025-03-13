<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CheckoutCustomizationSetting;
use Illuminate\Support\Facades\Log;

class CheckoutBuilderController extends Controller
{
    public function yampi(){

        $customizations = CheckoutCustomizationSetting::where('store_id', session('store_id'))->first();

        // Decodifica 'settings' para array, garantindo que não seja null
        $customizations = $customizations ? json_decode($customizations->settings, true) : [];

        return view('builder.yampi', compact('customizations'));
    }

    public function store_personalization(Request $request) {
        try {
            // Captura os dados recebidos do formulário
            $customizationSettings = $request->all();
    
            // Verifica se um arquivo foi enviado ou se já existe uma logo definida
            if ($request->hasFile('cabecalho_logo_file')) {
                $storeId = session('store_id');
                $randomId = rand(100000, 999999);
                $file = $request->file('cabecalho_logo_file');
                $extension = $file->getClientOriginalExtension();
                $fileName = "{$randomId}_{$storeId}.{$extension}";
    
                // Salvar o arquivo na pasta pública
                $file->move(public_path('store_logo_customization'), $fileName);
    
                // Adiciona o caminho ao array de configurações
                $customizationSettings['cabecalho_logo_path'] = "store_logo_customization/{$fileName}";
            } else {
                // Caso não tenha enviado um novo arquivo, verifica se já existe um valor setado no banco
                $existingSettings = CheckoutCustomizationSetting::where('store_id', session('store_id'))->first();
                if ($existingSettings && isset($existingSettings->settings)) {
                    $settings = json_decode($existingSettings->settings, true);
                    if (isset($settings['cabecalho_logo_path'])) {
                        $customizationSettings['cabecalho_logo_path'] = $settings['cabecalho_logo_path'];
                    }
                }
            }
            
            // Agora salva no banco em JSON
            CheckoutCustomizationSetting::updateOrCreate(
                ['store_id' => session('store_id')],
                ['settings' => json_encode($customizationSettings)]
            );                     
        
            return redirect()->route('builder.yampi')->with('success', 'Configurações salvas com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao processar a personalização', ['erro' => $e->getMessage()]);
    
            return redirect()->route('builder.yampi')->withErrors(['error' => 'Ocorreu um erro: ' . $e->getMessage()]);
        }
    }    

}
