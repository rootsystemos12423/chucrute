<x-app-layout>
      <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
            <div class="flex flex-col gap-10">
              <div class="flex flex-col items-start justify-start gap-5">
                <div class="flex flex-col gap-4">
                  <!---->
                  <div class="flex flex-row items-center gap-2 pl-1">
                    <div class="flex items-center gap-5 text-center flex-wrap">
                      <h1 class="text-title font-bold text-primary">APPS</h1>
                      <!---->
                      <p class="text-small text-secondary"></p>
                    </div>
                  </div>
                  <p class="pl-1 text-regular text-primary">Integre sua loja com outras ferramentas.</p>
                </div>
              </div>
              <div class="flex w-full items-center justify-center gap-2">
                <div class="flex flex-col items-start justify-start gap-2 w-full">
                  <div class="flex w-full items-center justify-center gap-2 rounded border p-2 border-shadowColor-200 bg-uncontrastColor">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-6 w-6 text-primary">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                    </svg>
                    <input type="text" placeholder="Busque pelo nome do app que deseja integrar" class="w-full rounded-md border-0 bg-transparent text-regular text-primary outline-none disabled:cursor-not-allowed">
                  </div>
                  <!---->
                </div>
                <button class="flex select-none items-center justify-center gap-4 rounded px-3 py-2.5 text-regular disabled:pointer-events-none disabled:opacity-50 bg-transparent text-[#ff0071] outline outline-1 outline-[#ff0071]"> ATIVOS </button>
                <button class="flex select-none items-center justify-center gap-4 rounded px-3 py-2.5 text-regular disabled:pointer-events-none disabled:opacity-50 bg-[#ff0071] text-white"> TODOS </button>
              </div>
              <div class="flex flex-col gap-5">
                <div id="pixels">
                  <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
                    <!---->
                    <table class="w-full table-auto max-lg:min-w-max">
                      <thead>
                        <tr>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                            <span class="min-w-max">PIXELS</span>
                          </th>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[150px] max-w-[150px]">
                            <!---->
                          </th>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[60px] max-w-[60px]">
                            <!---->
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="border-b border-tableBorder bg-uncontrastColor custom-hover">
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex items-center space-x-8">
                              <img class="ml-4 h-[50px] w-[50px] min-w-[50px] rounded-lg" src="https://cdn.adoorei.com/imagens/apps/googleads.png" alt="Google Ads">
                              <div class="flex flex-col gap-4 text-regular text-primary">
                                <div class="flex items-center gap-4 font-bold">Google Ads
                                  <!---->
                                </div>
                                <div>Integração nativa com pixel do Google ads para rastreio de suas vendas.</div>
                              </div>
                            </div>
                          </td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left"></td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex w-full items-center justify-center">
                              <div class="relative" style="--color: var(--shadow-color-200); --size: 12px; width: 12px; height: 12px;">
                                <div class="dot absolute"></div>
                                <div class="ringing absolute"></div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div id="google">
                  <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
                    <!---->
                    <table class="w-full table-auto max-lg:min-w-max">
                      <thead>
                        <tr>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                            <span class="min-w-max">Google</span>
                          </th>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[150px] max-w-[150px]">
                            <!---->
                          </th>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[60px] max-w-[60px]">
                            <!---->
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="border-b border-tableBorder bg-uncontrastColor custom-hover">
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex items-center space-x-8">
                              <img class="ml-4 h-[50px] w-[50px] min-w-[50px] rounded-lg" src="https://cdn.adoorei.com/imagens/apps/googlemerchantcenter.png" alt="Google Merchant Center">
                              <div class="flex flex-col gap-4 text-regular text-primary">
                                <div class="flex items-center gap-4 font-bold">Google Merchant Center
                                  <!---->
                                </div>
                                <div>Google Shopping é uma das principais formas de incrementar resultados, em vendas, na sua própria loja.</div>
                              </div>
                            </div>
                          </td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left"></td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex w-full items-center justify-center">
                              <div class="relative" style="--color: var(--shadow-color-200); --size: 12px; width: 12px; height: 12px;">
                                <div class="dot absolute"></div>
                                <div class="ringing absolute"></div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            
                <div id="plataformas">
                  <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
                    <!---->
                    <table class="w-full table-auto max-lg:min-w-max">
                      <thead>
                        <tr>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                            <span class="min-w-max">PLATAFORMAS</span>
                          </th>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[150px] max-w-[150px]">
                            <!---->
                          </th>
                          <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[60px] max-w-[60px]">
                            <!---->
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="border-b border-tableBorder bg-uncontrastColor custom-hover">
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                              <a href="{{ route('shopify') }}">
                                <div class="flex items-center space-x-8">
                                  <img class="ml-4 h-[50px] w-[50px] min-w-[50px] rounded-lg" src="https://cdn.adoorei.com/imagens/apps/shopify.png" alt="Shopify">
                                  <div class="flex flex-col gap-4 text-regular text-primary">
                                    <div class="flex items-center gap-4 font-bold">Shopify
                                      <!---->
                                    </div>
                                    <div>Plataforma global de e-commerce.</div>
                                  </div>
                                </div>
                            </a>
                          </td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left"></td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex w-full items-center justify-center">
                              <div class="relative" style="--color: var(--green-color-palette); --size: 12px; width: 12px; height: 12px;">
                                <div class="dot absolute"></div>
                                <div class="ringing absolute"></div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr class="border-b border-tableBorder bg-uncontrastColor custom-hover">
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex items-center space-x-8">
                              <img class="ml-4 h-[50px] w-[50px] min-w-[50px] rounded-lg" src="https://cdn.adoorei.com/imagens/apps/woocommerce.png" alt="Woocommerce">
                              <div class="flex flex-col gap-4 text-regular text-primary">
                                <div class="flex items-center gap-4 font-bold">Woocommerce
                                  <!---->
                                </div>
                                <div>Plataforma de comércio eletrônico construída no Wordpress.</div>
                              </div>
                            </div>
                          </td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left"></td>
                          <td class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                            <div class="flex w-full items-center justify-center">
                              <div class="relative" style="--color: var(--shadow-color-200); --size: 12px; width: 12px; height: 12px;">
                                <div class="dot absolute"></div>
                                <div class="ringing absolute"></div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="pt-16"></div>
          </div>
</x-app-layout>
      