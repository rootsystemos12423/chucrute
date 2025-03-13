<x-app-layout>
  
  <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
    <form novalidate="" class="flex flex-col gap-10">
      <div class="flex flex-col gap-10">
        <div class="flex flex-col items-start justify-start gap-5">
          <div class="flex flex-col gap-4">
            <a href="{{ route('pagamentos') }}" class="flex max-w-max cursor-pointer items-center justify-start gap-2 text-regular text-secondary hover:text-highlighted">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path></svg>
              ver todos gateways
            </a>
            <div class="flex flex-row items-center gap-2 pl-1">
              <img class="rounded-lg" width="42" height="42" src="/images/pagamento/pay2win.png" alt="Pay2Win">
              <div class="flex items-center gap-5 text-center flex-wrap">
                <h1 class="text-title font-bold text-primary">Pay2Win</h1>
                <p class="text-small text-secondary"></p>
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
                  <span class="text-regular text-primary">Chave Secreta: *</span>
                  <input wire:model="secret_key" type="text" placeholder="Insira a chave secreta" class="w-full p-2 border rounded-md" />
                </div>
              </div>
            </div>
            <div class="w-full">
              <div class="flex flex-col flex-grow w-full gap-5 p-8 rounded justify-left items-left bg-white">
                <span class="mb-4 font-bold text-regular text-primary">Regras</span>
            
                <div class="flex items-center">
                  <x-toggle wire:model="enable_credit_card" id="enable_credit_card" label="Ativar cartão de crédito" />
                </div>
                
                <div class="flex items-center">
                  <x-toggle wire:model="enable_pix" id="enable_pix" label="Ativar pix" />
                </div>
                
                <div class="flex items-center">
                  <x-toggle wire:model="enable_boleto" id="enable_boleto" label="Ativar boleto bancário" />
                </div>
                
                <div class="flex items-center">
                  <x-toggle wire:model="enable_custom_interest_rate" id="enable_custom_interest_rate" label="Utilizar taxa de juros customizada." />
                </div>
                
                <div class="flex flex-col items-start justify-start w-64 gap-2 mt-4 mb-4">
                  <span class="text-xs text-primary">Taxa de juros de parcelamento</span>
                  <x-prefix-input wire:model="additional_interest_rate" type="number" placeholder="Insira a taxa de juros" class="w-full p-2 border rounded-md" suffix="%" />
                </div>
                
                <span class="text-regular text-primary">Oferecer parcelamento sem juros.</span>
                <select wire:model="interest_rule" class="p-2 border rounded-md text-gray-500 w-84 outline-none">
                  <option value="all">Cobrar juros em todas as parcelas</option>
                  <option value="none">Não cobrar juros</option>
                </select>
              </div>
            </div>            
            <div class="w-full">
              <!---->
            </div>
            <div class="flex w-full items-center justify-end gap-5">
              <button type="button" wire:click="cancel" class="px-4 py-2 bg-transparent border border-[#ff0071] text-[#ff0071] rounded-md">Cancelar</button>
              <button type="submit" class="px-4 py-2 bg-[#ff0071] text-white rounded-md">Salvar</button>
            </div>
            <div class="w-full md:px-4 block md:hidden">
              <div class="flex w-full items-center justify-start gap-3 rounded border border-shadowColor-100 p-4">
                <a href="#" target="_blank" rel="noopener noreferrer" class="text-regular text-primary hover:text-highlighted">
                  <strong class="text-highlighted">Está com dúvidas?&nbsp; </strong>
                  <span class="underline">Como integrar o gateway Skale Pay?</span>
                </a>
              </div>
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
                  selected="active" 
                  placeholder="Selecione o status"
                  prefixIcon
                  prefixIconColor="bg-green-500"
              />
              </div>
            </div>
            <div class="w-full md:px-4 hidden md:block">
              <div class="flex w-full items-center justify-start gap-3 rounded border border-shadowColor-100 p-4">
                <a href="#" target="_blank" rel="noopener noreferrer" class="text-regular text-primary hover:text-highlighted">
                  <strong class="text-highlighted">Está com dúvidas?&nbsp; </strong>
                  <span class="underline">Como integrar o gateway Skale Pay?</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="pt-16"></div>
  </div>

</x-app-layout>
