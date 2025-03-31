<x-app-layout>
 
    <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
        <div class="flex flex-col gap-5">
          <h1 class="font-bold text-title text-primary">Olá {{ auth()->user()->name }},</h1>
          <p class="text-regular text-primary">Seu último acesso foi 9 de fevereiro de 2025 às 10:06</p>
          <div class="flex flex-col w-full gap-6 p-6 bg-white">
            <span class="font-bold text-primary">Seu checkout está configurado, boas vendas.</span>
            <div class="flex flex-col gap-5">
              <!-- Domínio -->
              @if($domain !== null)
              <div class="flex justify-between bg-[#4a9f0c06] rounded-[5px] border border-[#4a9f0c] py-3 px-5">
                <div class="flex items-center justify-center gap-6">
                  <i class="fa fa-globe text-gray-800 text-[45px] md:text-[36px] min-w-[36px] text-neutral-600"></i>
                  <div class="flex flex-col gap-2">
                    <span class="text-neutral-600 text-[13px]">Domínio</span>
                    <span class="font-semibold text-[13px]">Verifique seu domínio. Deve ser o mesmo utilizado na Shopify, WooCommerce ou na sua landing page.</span>
                  </div>
                </div>
                <div class="relative p-[10px_20px]" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                  <div class="dot absolute"></div>
                  <div class="ringing absolute"></div>
                </div>
              </div>
              @else
              <a href="{{ route('dominios') }}" class="flex justify-between rounded-[5px] border border-[#E6EAF2] hover:border-[#ff0071] hover:border py-3 px-5">
                <div class="flex items-center justify-center gap-6">
                  <i class="fa fa-globe text-gray-800 text-[45px] md:text-[36px] min-w-[36px] text-neutral-600"></i>
                  <div class="flex flex-col gap-2">
                    <span class="text-neutral-600 text-[13px]">Domínio</span>
                    <span class="font-semibold text-[13px]">Verifique seu domínio. Deve ser o mesmo utilizado na Shopify, WooCommerce ou na sua landing page.</span>
                  </div>
                </div>
                <div class="relative p-[10px_20px]" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                  <div class="dot absolute"></div>
                  <div class="ringing absolute"></div>
                </div>
              </a>
              @endif
      
              <!-- Gateway -->
              @if($gateway !== null)
              <div class="flex justify-between rounded-[5px] bg-[#4a9f0c06] rounded-[5px] border border-[#4a9f0c] py-3 px-5">
                <div class="flex items-center justify-center gap-6">
                  <i class="fa fa-plug text-[45px] text-gray-800 md:text-[36px] min-w-[36px] text-neutral-600"></i>
                  <div class="flex flex-col gap-2">
                    <span class="text-neutral-600 text-[13px]">Gateway</span>
                    <span class="font-semibold text-[13px]">Configure os meios de pagamentos que serão exibidos em sua loja.</span>
                  </div>
                </div>
                <div class="relative p-[10px_20px]" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                  <div class="dot absolute"></div>
                  <div class="ringing absolute"></div>
                </div>
              </div>
            @else
              <a href="{{ route('pagamentos') }}" class="flex justify-between rounded-[5px] border border-[#E6EAF2] hover:border-[#ff0071] hover:border py-3 px-5">
                <div class="flex items-center justify-center gap-6">
                  <i class="fa fa-plug text-[45px] text-gray-800 md:text-[36px] min-w-[36px] text-neutral-600"></i>
                  <div class="flex flex-col gap-2">
                    <span class="text-neutral-600 text-[13px]">Gateway</span>
                    <span class="font-semibold text-[13px]">Configure os meios de pagamentos que serão exibidos em sua loja.</span>
                  </div>
                </div>
                <div class="relative p-[10px_20px]" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                  <div class="dot absolute"></div>
                  <div class="ringing absolute"></div>
                </div>
            </a>
            @endif
      
              <!-- Configurações do site -->
              @if($shipping !== null)
              <div class="flex justify-between rounded-[5px] bg-[#4a9f0c06] border border-[#4a9f0c] py-3 px-5">
                <div class="flex items-center justify-center gap-6">
                  <i class="fa-solid fa-truck text-[45px] text-gray-800 md:text-[36px] min-w-[36px] text-neutral-600"></i>
                  <div class="flex flex-col gap-2">
                    <span class="text-neutral-600 text-[13px]">Frete</span>
                    <span class="font-semibold text-[13px]">Crie metodos de entrega para ser exibido no seu checkout.</span>
                  </div>
                </div>
                <div class="relative p-[10px_20px]" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                  <div class="dot absolute"></div>
                  <div class="ringing absolute"></div>
                </div>
              </div>
            @else
            <a href="{{ route('logistic') }}" class="flex justify-between rounded-[5px] border border-[#E6EAF2] hover:border-[#ff0071] hover:border py-3 px-5">
              <div class="flex items-center justify-center gap-6">
                <i class="fa-solid fa-truck text-[45px] text-gray-800 md:text-[36px] min-w-[36px] text-neutral-600"></i>
                <div class="flex flex-col gap-2">
                  <span class="text-neutral-600 text-[13px]">Frete</span>
                  <span class="font-semibold text-[13px]">Crie metodos de entrega para ser exibido no seu checkout.</span>
                </div>
              </div>
              <div class="relative p-[10px_20px]" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                <div class="dot absolute"></div>
                <div class="ringing absolute"></div>
              </div>
          </a>
            @endif

            </div>
          </div>
        </div>
      </div>
      
    
</x-app-layout>
