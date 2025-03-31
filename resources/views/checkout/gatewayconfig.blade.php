<x-app-layout>
  <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
    <form method="POST" action="{{ route('store.pagamento.gateway') }}" class="flex flex-col gap-10">
      @csrf
      <div class="flex flex-col gap-10">
        <div class="flex flex-col items-start justify-start gap-5">
          <div class="flex flex-col gap-4">
            <a href="{{ route('pagamentos') }}" class="flex max-w-max cursor-pointer items-center justify-start gap-2 text-regular text-secondary hover:text-highlighted">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
              </svg>
              ver todos gateways
            </a>
            <div class="flex flex-row items-center gap-2 pl-1">
              <img class="rounded-lg" width="42" height="42" src="/images/pagamento/pay2win.png" alt="Pay2Win">
              <div class="flex items-center gap-5 text-center flex-wrap">
                <h1 class="text-title font-bold text-primary">Pay2Win</h1>
              </div>
            </div>
            <p class="pl-1 text-regular text-primary">Integre sua loja ao gateway Skale Pay.</p>
          </div>
        </div>
        
        <div class="flex flex-wrap items-start justify-start w-full gap-5 md:flex-nowrap lg:flex-row">
          <div class="flex flex-col items-start justify-start order-2 w-full gap-5 md:order-1 lg:w-8/12">
            <div class="w-full">
              <div class="flex flex-col flex-grow w-full gap-5 p-8 rounded justify-left items-left bg-white">
                <span class="mb-4 font-bold text-regular text-primary">Informações básicas</span>
                <div class="flex flex-col items-start justify-start w-full gap-2">
                  <span class="text-regular text-primary">Client Id: *</span>
                  <input name="client_id" type="text" placeholder="p2w_01956c00-69e5-7985-9411-c416d3014a4f" class="w-full p-2 border rounded-md" value="{{ $gateway->client_id ?? '' }}" />
                </div>
                <div class="flex flex-col items-start justify-start w-full gap-2">
                  <span class="text-regular text-primary">Secret Key: *</span>
                  <input name="secret_key" type="text" placeholder="o/Rd/QA7HZAQDlE0neriyBMLH8NBh6bU" class="w-full p-2 border rounded-md" value="{{ $gateway->secret_key ?? '' }}" />
                </div>
              </div>
            </div>

            <div class="w-full">
              <div class="flex flex-col flex-grow w-full gap-5 p-8 rounded justify-left items-left bg-white">
                <span class="mb-4 font-bold text-regular text-primary">Regras</span>
                <div class="flex items-center">
                  <x-toggle name="enable_credit_card" id="enable_credit_card" label="Ativar cartão de crédito" :checked="$gateway->enable_credit_card ?? false" />
                </div>
                <div class="flex items-center">
                  <x-toggle name="enable_pix" id="enable_pix" label="Ativar pix" :checked="$gateway->enable_pix ?? false" />
                </div>
                <div class="flex items-center">
                  <x-toggle name="enable_boleto" id="enable_boleto" label="Ativar boleto bancário" :checked="$gateway->enable_boleto ?? false" />
                </div>
                <div class="flex items-center">
                  <x-toggle name="enable_custom_interest_rate" id="enable_custom_interest_rate" label="Utilizar taxa de juros customizada." :checked="$gateway->enable_custom_interest_rate ?? false" />
                </div>

                <div class="flex flex-col items-start justify-start w-64 gap-2 mt-4 mb-4">
                  <span class="text-xs text-primary">Taxa de juros de parcelamento</span>
                  <div x-data="{ additional_interest_rate: {{ $gateway->additional_interest_rate ?? 0 }} }">
                    <x-prefix-input 
                        wire:model="additional_interest_rate" 
                        x-model="additional_interest_rate" 
                        name="additional_interest_rate" 
                        type="number" 
                        placeholder="Insira a taxa de juros" 
                        class="w-full p-2 border rounded-md" 
                        suffix="%"
                    />
                </div>                
                </div>

                <span class="text-regular text-primary">Oferecer parcelamento sem juros.</span>
                <select name="interest_rule" class="p-2 border rounded-md text-gray-500 w-84 outline-none">
                  <option value="all" {{ isset($gateway->interest_rule) && $gateway->interest_rule == 'all' ? 'selected' : '' }}>Cobrar juros em todas as parcelas</option>
                  <option value="none" {{ isset($gateway->interest_rule) && $gateway->interest_rule == 'none' ? 'selected' : '' }}>Não cobrar juros</option>
                </select>
              </div>
            </div>

            <div class="flex w-full items-center justify-end gap-5">
              <button type="button" class="px-4 py-2 bg-transparent border border-[#ff0071] text-[#ff0071] rounded-md">Cancelar</button>
              <button type="submit" class="px-4 py-2 bg-[#ff0071] text-white rounded-md">Salvar</button>
            </div>
          </div>

          <div class="flex flex-col items-start justify-start order-1 w-full gap-5 md:order-2 lg:w-4/12">
            <div class="flex w-full flex-col items-start justify-start gap-7 rounded bg-white p-4">
              <div class="flex w-full flex-col items-start justify-start gap-3">
                <span class="text-regular font-bold text-primary">Status * </span>
                <x-custom-select
                  id="status-select"
                  name="status"
                  :options="[
                      ['value' => 'active', 'label' => 'Ativo'],
                      ['value' => 'inactive', 'label' => 'Inativo'],
                  ]"
                  selected="{{ $gateway->status ?? 'active' }}"
                  placeholder="Selecione o status"
                  prefixIcon
                  prefixIconColor="bg-green-500"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="pt-16"></div>
  </div>
</x-app-layout>
