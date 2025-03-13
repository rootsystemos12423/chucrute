<x-app-layout>
 
      <div class="flex flex-col w-full px-4 pt-6 h-max xl:overflow-hidden">
            <!---->
            <div class="flex flex-col gap-4">
              <div class="flex flex-col items-start justify-between gap-5 md:flex-row md:items-center">
                <div class="flex flex-col items-start justify-start gap-5">
                  <div class="flex flex-col gap-4">
                    <!---->

                   <!-- HEADER AREA INICIO -->
                    <div class="flex flex-row items-center gap-2 pl-1">
                      <div class="flex items-center gap-5 text-center flex-wrap">
                        <h1 class="text-2xl font-bold text-primary">PEDIDOS</h1>
                        <!---->
                        <p class="text-small text-secondary">({{ $count }} pedidos)</p>
                      </div>
                    </div>
                    <p class="pl-1 text-sm text-primary">Acompanhe os pedidos de sua loja.</p>
                  </div>
                </div>
                
                
                <div class="flex flex-row items-center justify-start gap-3">
                  <button class="text-sm outline-[#ff0983 text-[#ff0983] select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none outline px-[18px] py-[14px]" type="submit"> REENVIAR PEDIDOS</button>
                  <button class="text-sm select-none flex justify-center bg-[#ff0983] text-white items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none px-[18px] py-[14px]" type="submit"> EXPORTAR PLANILHA</button>
                </div>
              </div>
              
              <!-- HEADER AREA FIM -->
              
              <!-- SECOND HEADER AREA INCIO -->
              <div class="mt-[24px] flex w-full flex-col items-start justify-start border-0 outline-none gap-[32px]">
                <div class="flex flex-col items-start justify-start w-full gap-4">
                  <div class="flex items-center justify-start w-full gap-4">
                    
                   <!-- SEARCH BAR INICIO -->
                  <div class="flex flex-col border-0 outline-none bg-transparent items-start justify-start p-0 w-full" type="text">
                      <div class="flex w-full items-center justify-center gap-2 rounded border p-2 border-shadowColor-200 bg-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-6 w-6 text-primary">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                        </svg>
                        <input type="text" placeholder="Buscar por nome, numero do pedido, email ou cpf" class="w-full rounded-md border-0 bg-transparent text-sm text-primary outline-none disabled:cursor-not-allowed">
                      </div>
                      <!---->
                    </div>
                    <!-- SEARCH BAR FIM -->

                    <!-- FILTRO INICIO -->
                    <div class="self-stretch bg-white border border-gray-300">
                      <button class="text-sm select-none flex justify-center items-center p-4 rounded disabled:opacity-50 disabled:pointer-events-none" type="submit">
                        <i class="fa-solid fa-filter text-2xl text-gray-300"></i>
                      </button>
                    </div>
                    <!-- FILTRO FIM -->
                  </div>
                  <!---->
                </div>
                <!---->
              </div>

              <!-- SECOND HEADER AREA FIM -->

               <!-- LISTAGEM DE PEDIDOS INCIO -->
              <div class="flex flex-col gap-5">
                <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
                  <!---->
                  <table class="w-full table-auto max-lg:min-w-max">
                    
                        <thead>
                      <tr>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left w-[40px]">
                          <!---->
                          <label class="flex items-center justify-center cursor-pointer bg-white border rounded border-shadowColor-200 h-[16px] max-h-[16px] min-h-[16px] w-[16px] min-w-[16px] max-w-[16px] p-2">
                            <input class="hidden" type="checkbox">
                            <!---->
                          </label>
                        </th>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left w-[60px]">
                          <!---->
                        </th>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left w-[110px]">
                          <span class="min-w-max">Nº do pedido</span>
                        </th>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left w-[0px]">
                          <span class="min-w-max">Status</span>
                        </th>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left w-[0px]">
                          <span class="min-w-max">Total</span>
                        </th>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left">
                          <span class="min-w-max">Nome do cliente</span>
                        </th>
                        <th class="border-b border-tableBorder bg-[#f9fafb] px-[6px] pb-[20px] pt-[20px] text-sm uppercase text-primary text-left w-[250px]">
                          <span class="min-w-max">Tags</span>
                        </th>
                      </tr>
                    </thead>

                    <tbody>
                        <!-- PEDIDO INDIVIDUAL INICIO -->
                        @foreach ($orders as $order)
                        @php
                              $order_customer_data = $order->customer_data ? json_decode($order->customer_data, true) : [];
                        @endphp
                          <tr class="border-b border-tableBorder bg-white clickable" onclick="window.location.href='/orders/{{ $order->id }}';" style="cursor: pointer;">
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              <label class="flex items-center justify-center cursor-pointer bg-white border rounded border-shadowColor-200 h-[16px] max-h-[16px] min-h-[16px] w-[16px] min-w-[16px] max-w-[16px]">
                                <input class="hidden" type="checkbox">
                                <!---->
                              </label>
                            </td>
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              @if($order->payment_method === 'pix')
                              <svg xmlns="http://www.w3.org/2000/svg" width="39" height="26" viewBox="0 0 39 26" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M39 22.75C39 24.5375 37.5375 26 35.75 26H3.25C1.4625 26 0 24.5375 0 22.75V3.25C0 1.4625 1.4625 0 3.25 0H35.75C37.5375 0 39 1.4625 39 3.25V22.75Z" fill="white"></path>
                                <path d="M35.75 0H3.25C1.4625 0 0 1.4625 0 3.25V22.75C0 24.5375 1.4625 26 3.25 26H35.75C37.5375 26 39 24.5375 39 22.75V3.25C39 1.4625 37.5375 0 35.75 0ZM35.75 0.65C37.1839 0.65 38.35 1.8161 38.35 3.25V22.75C38.35 24.1839 37.1839 25.35 35.75 25.35H3.25C1.8161 25.35 0.65 24.1839 0.65 22.75V3.25C0.65 1.8161 1.8161 0.65 3.25 0.65H35.75Z" fill="#B3B3B3"></path>
                                <path d="M16.0813 16.7106C16.3515 16.7116 16.6192 16.6588 16.8688 16.5555C17.1184 16.4521 17.3451 16.3002 17.5355 16.1085L19.6347 14.0094C19.7092 13.9384 19.8081 13.8987 19.9111 13.8987C20.014 13.8987 20.113 13.9384 20.1875 14.0094L22.2948 16.1172C22.4856 16.3086 22.7124 16.4603 22.9622 16.5635C23.2119 16.6667 23.4797 16.7194 23.7499 16.7184H24.1639L21.5037 19.3773C21.3064 19.575 21.072 19.7319 20.814 19.839C20.5559 19.946 20.2793 20.0012 20 20.0012C19.7206 20.0012 19.444 19.946 19.1859 19.839C18.9279 19.7319 18.6935 19.575 18.4962 19.3773L15.8252 16.7106H16.0813ZM23.7499 9.28252C23.4798 9.2817 23.2122 9.33446 22.9626 9.43773C22.7129 9.54101 22.4863 9.69275 22.2957 9.88419L20.1914 11.9929C20.1181 12.066 20.0187 12.1071 19.9152 12.1071C19.8116 12.1071 19.7123 12.066 19.639 11.9929L17.5399 9.89327C17.3494 9.70158 17.1228 9.54964 16.8732 9.44628C16.6235 9.34292 16.3558 9.29019 16.0856 9.29117H15.8252L18.4962 6.62279C18.8951 6.22402 19.436 6 20 6C20.564 6 21.1049 6.22402 21.5037 6.62279L24.1639 9.28208L23.7499 9.28252Z" fill="#4AB7A8"></path>
                                <path d="M13.6231 11.4967L15.2115 9.90798H16.0813C16.4628 9.90841 16.8283 10.0594 17.0991 10.3275L19.1982 12.4267C19.2918 12.5208 19.403 12.5954 19.5255 12.6463C19.6479 12.6973 19.7793 12.7235 19.9119 12.7235C20.0446 12.7235 20.1759 12.6973 20.2984 12.6463C20.4209 12.5954 20.5321 12.5208 20.6256 12.4267L22.733 10.3193C23.0038 10.0509 23.3695 9.90009 23.7508 9.89976H24.782L26.3772 11.495C26.776 11.8938 27 12.4347 27 12.9987C27 13.5627 26.776 14.1036 26.3772 14.5025L24.782 16.0977H23.7499C23.3689 16.0977 23.0029 15.9463 22.7321 15.6782L20.6252 13.5699C20.433 13.3863 20.1773 13.2839 19.9115 13.2839C19.6457 13.2839 19.3901 13.3863 19.1978 13.5699L17.0987 15.6691C16.8279 15.9372 16.4624 16.0886 16.0809 16.0886H15.2115L13.6231 14.5042C13.4256 14.3068 13.2689 14.0724 13.162 13.8143C13.055 13.5563 13 13.2798 13 13.0005C13 12.7212 13.055 12.4446 13.162 12.1866C13.2689 11.9286 13.4256 11.6942 13.6231 11.4967Z" fill="#4AB7A8"></path>
                              </svg>
                              @elseif($order->payment_method === 'credit_card')
                              <svg data-v-323e7a1c="" height="39" width="35" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.00 512.00" xml:space="preserve" fill="#000000" stroke="#000000" stroke-width="0.00512"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="10.24"></g><g id="SVGRepo_iconCarrier"><g><g><path style="fill:#5d647f;" d="M472,72H40C17.945,72,0,89.945,0,112v288c0,22.055,17.945,40,40,40h432c22.055,0,40-17.945,40-40 V112C512,89.945,494.055,72,472,72z"></path></g><g><path style="fill:#ffd100;" d="M176,232H80c-8.837,0-16-7.163-16-16v-64c0-8.837,7.163-16,16-16h96c8.837,0,16,7.163,16,16v64 C192,224.837,184.837,232,176,232z"></path></g><g><g><path style="fill:#b8bac0;" d="M120,336H80c-8.837,0-16-7.163-16-16v-8c0-8.837,7.163-16,16-16h40c8.837,0,16,7.163,16,16v8 C136,328.837,128.837,336,120,336z"></path></g><g><path style="fill:#b8bac0;" d="M224,336h-40c-8.837,0-16-7.163-16-16v-8c0-8.837,7.163-16,16-16h40c8.837,0,16,7.163,16,16v8 C240,328.837,232.837,336,224,336z"></path></g><g><path style="fill:#b8bac0;" d="M328,336h-40c-8.837,0-16-7.163-16-16v-8c0-8.837,7.163-16,16-16h40c8.837,0,16,7.163,16,16v8 C344,328.837,336.837,336,328,336z"></path></g><g><path style="fill:#b8bac0;" d="M432,336h-40c-8.837,0-16-7.163-16-16v-8c0-8.837,7.163-16,16-16h40c8.837,0,16,7.163,16,16v8 C448,328.837,440.837,336,432,336z"></path></g></g><g><g><path style="fill:#8a8895;" d="M232,384H72c-4.422,0-8-3.582-8-8s3.578-8,8-8h160c4.422,0,8,3.582,8,8S236.422,384,232,384z"></path></g></g><g><g><path style="fill:#8a8895;" d="M336,384h-72c-4.422,0-8-3.582-8-8s3.578-8,8-8h72c4.422,0,8,3.582,8,8S340.422,384,336,384z"></path></g></g><g><path style="fill:#ff4f19;" d="M368,216.002C359.211,225.821,346.439,232,332.224,232c-26.51,0-48-21.49-48-48s21.49-48,48-48 c14.213,0,26.983,6.177,35.772,15.993"></path></g><g><polygon style="fill:#ff9500;" points="192,192 112,192 112,176 192,176 192,160 112,160 112,136 96,136 96,232 112,232 112,208 192,208 "></polygon></g><g><circle style="fill:#ffd100;" cx="400" cy="184" r="48"></circle></g></g></g></svg>
                              @endif
                            </td>
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              <div class="min-w-max">
                                <span class="min-w-max text-primary">#{{ $order->external_reference }}</span>
                                <br>
                                <span class="min-w-max text-[#515d74]">
                                  {{ $order->created_at->isToday() ? 'Hoje' : $order->created_at->translatedFormat('d/m/Y') }}, {{ $order->created_at->format('H:i') }}
                              </span>                                
                            </div>
                            </td>
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              @if($order->status === 'pending')
                              <div class="inline-flex items-center px-3 py-1 rounded text-sm text-statusPending bg-statusPending-100 min-w-max">
                                Pendente
                              </div>
                              @elseif($order->status === 'paid')
                                <div class="inline-flex items-center px-3 py-1 rounded text-regular text-statusApproved bg-statusApproved-100 min-w-max">Aprovado</div>
                              @elseif($order->status === 'refused')
                                <div class="inline-flex items-center px-3 py-1 rounded text-regular text-red-400 bg-red-400/05 min-w-max">Recusado</div>
                              @endif
                            </td>
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              <div class="min-w-max">R$ {{ number_format($order->total_value / 100, 2, ',', '.') }}</div>
                            </td>
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              <div class="flex flex-col items-center justify-center w-full gap-2">
                                <div class="w-full">{{ $order_customer_data['name'] }}</div>
                              </div>
                            </td>
                            <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-sm text-primary text-left">
                              <div class="flex flex-wrap gap-[8px]">
                                <div class="text-small text-primary bg-gray-300 px-3 py-1 rounded-full min-w-max max-w-max">
                                  shopify
                                </div>
                              </div>
                            </td>
                          </tr>    
                        @endforeach   
                    </tbody>
                  </table>
                </div>
            


                  
                </div>
              </div>
            </div>
            <div class="pt-8"></div>
          </div>
      
  </x-app-layout>
  