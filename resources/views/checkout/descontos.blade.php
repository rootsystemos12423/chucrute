<x-app-layout>
      <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
            <div class="flex flex-col gap-10">
              <div class="flex flex-col items-start justify-between gap-5 md:flex-row">
                <div class="flex flex-col items-start justify-start gap-5">
                  <div class="flex flex-col gap-4">
                    <!---->
                    <div class="flex flex-row items-center gap-2 pl-1">
                      <div class="flex items-center gap-5 text-center flex-wrap">
                        <h1 class="text-title font-bold text-primary">DESCONTO POR FORMA DE PAGAMENTO</h1>
                        <!---->
                        <p class="text-small text-secondary"></p>
                      </div>
                    </div>
                    <p class="pl-1 text-regular text-primary">Ofereça descontos por forma de pagamento.</p>
                  </div>
                </div>
              </div>
              <form method="POST" action="{{ route('store.checkout.discounts') }}" class="flex flex-col gap-10">
                @csrf
                <input type="hidden" name="store_id" value="{{ session('store_id') }}">
            
                <div class="flex flex-col gap-5 rounded-md bg-uncontrastColor p-4">
                    <div class="flex flex-col gap-2">
                        <label class="text-regular font-bold text-primary">Cartão de crédito</label>
                        <div class="flex w-full items-center justify-start rounded-md border border-shadowColor-200 bg-uncontrastColor">
                            <input name="credit_card" type="number" min="0" max="100" placeholder="Porcentagem" value="{{ $discountCard }}" class="w-full rounded-md border-0 bg-transparent p-3 text-primary outline-none">
                            <div class="border-l p-3 text-primary border-shadowColor-200 bg-shadowColor-25">
                                <p class="font-regular rounded-md px-2">%</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="flex flex-col gap-2">
                        <label class="text-regular font-bold text-primary">Pix</label>
                        <div class="flex w-full items-center justify-start rounded-md border border-shadowColor-200 bg-uncontrastColor">
                            <input name="pix" type="number" min="0" max="100" placeholder="Porcentagem" value="{{ $discountPix }}" class="w-full rounded-md border-0 bg-transparent p-3 text-primary outline-none">
                            <div class="border-l p-3 text-primary border-shadowColor-200 bg-shadowColor-25">
                                <p class="font-regular rounded-md px-2">%</p>
                            </div>
                        </div>
                    </div>
            
                    <div class="flex flex-col gap-2">
                        <label class="text-regular font-bold text-primary">Boleto bancário</label>
                        <div class="flex w-full items-center justify-start rounded-md border border-shadowColor-200 bg-uncontrastColor">
                            <input name="boleto" type="number" min="0" max="100" placeholder="Porcentagem" value="{{ $discountBankSlip }}" class="w-full rounded-md border-0 bg-transparent p-3 text-primary outline-none">
                            <div class="border-l p-3 text-primary border-shadowColor-200 bg-shadowColor-25">
                                <p class="font-regular rounded-md px-2">%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                  <div class="w-full md:px-4">
                    <div class="flex w-full items-center justify-start gap-3 rounded border border-shadowColor-100 p-4">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-9 text-[#ff0071]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                      </svg>
                      <a href="https://ajuda.adoorei.com/pt-BR/" target="_blank" rel="noopener noreferrer" class="text-regular text-primary hover:text-[#ff0071]">
                        <strong class="text-[#ff0071]">Está com dúvidas?&nbsp; </strong>
                        <span class="underline"> Aprenda como criar um desconto por forma de pagamento</span>
                      </a>
                    </div>
                  </div>
                  <div class="flex gap-4 max-md:w-full">
                    <button data-v-ef89643d="" class="text-regular select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none outline min-w-max py-3 px-4 max-md:w-full border-[#ff0071] text-[#ff0071]" type="submit"> Cancelar</button>
                    <button data-v-ef89643d="" class="text-regular select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none min-w-max py-3 px-4 max-md:w-full bg-[#ff0071] text-white" type="submit"> Salvar</button>
                  </div>
                </div>
            </form>            
            </div>
            <div class="pt-16"></div>
          </div>
</x-app-layout>
      