<x-app-layout>

      <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
            <!---->
            <div class="flex flex-col gap-4">
              <div class="flex flex-col items-start justify-between gap-5 md:flex-row">
               
               <div class="flex flex-col items-start justify-start gap-5">
                  <div class="flex flex-col gap-4">
                    <!---->
                    <div class="flex flex-row items-center gap-2 pl-1">
                      <div class="flex items-center gap-5 text-center flex-wrap">
                        <h1 class="text-title font-bold text-primary">CARRINHOS ABANDONADOS</h1>
                        <!---->
                        <p class="text-small text-secondary">(57 carrinhos)</p>
                      </div>
                    </div>
                    <p class="pl-1 text-regular text-primary">Acompanhe a recuperação de carrinhos abandonados de sua loja.</p>
                  </div>
                </div>

              </div>
              <div class="grid w-full grid-cols-1 gap-5 md:grid-cols-3 md:gap-10">
                <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-uncontrastColor p-4">
                  <div class="flex items-center justify-start gap-3">
                    <span class="text-regular text-primary">Total Abandonado</span>
                    <span class="h-5 w-5 select-none rounded-full bg-shadowColor-400 text-center text-regular text-white text-background el-tooltip__trigger el-tooltip__trigger">i</span>
                  </div>
                  <div>
                    <span class="text-subtitle font-bold text-primary">R$ 5.431,42</span>
                    <!---->
                  </div>
                  <!---->
                </div>
                <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-uncontrastColor p-4">
                  <div class="flex items-center justify-start gap-3">
                    <span class="text-regular text-primary">Total Recuperado</span>
                    <span class="h-5 w-5 select-none rounded-full bg-shadowColor-400 text-center text-regular text-white text-background el-tooltip__trigger el-tooltip__trigger">i</span>
                  </div>
                  <div>
                    <span class="text-subtitle font-bold text-primary">R$ 248,76</span>
                    <!---->
                  </div>
                  <!---->
                </div>
                <div class="flex min-w-max flex-col gap-4 rounded-md border border-shadowColor-100 bg-uncontrastColor p-4">
                  <div class="flex items-center justify-start gap-3">
                    <span class="text-regular text-primary">Taxa de Recuperação</span>
                    <span class="h-5 w-5 select-none rounded-full bg-shadowColor-400 text-center text-regular text-white text-background el-tooltip__trigger el-tooltip__trigger">i</span>
                  </div>
                  <div>
                    <span class="text-subtitle font-bold text-primary">4.58%</span>
                    <!---->
                  </div>
                  <!---->
                </div>
              </div>
              <div class="w-full">
                <div class="flex flex-col items-start justify-start gap-2 w-full border-0" type="text">
                  <div class="flex w-full items-center justify-center gap-2 rounded border p-2 border-shadowColor-200 bg-uncontrastColor">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-6 w-6 text-primary">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"></path>
                    </svg>
                    <input type="text" placeholder="Buscar por nome ou e-mail" class="w-full rounded-md border-0 bg-transparent text-regular text-primary outline-none disabled:cursor-not-allowed">
                  </div>
                  <!---->
                </div>
              </div>
              <div class="flex flex-col gap-5">
                <div id="table-container" class="table-container w-full overflow-x-auto overscroll-x-none rounded">
                  <!---->
                  <table class="w-full table-auto max-lg:min-w-max">
                    <thead>
                      <tr>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                          <span class="min-w-max">Data</span>
                        </th>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[200px]">
                          <span class="min-w-max">Status</span>
                        </th>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                          <span class="min-w-max">Nome do cliente</span>
                        </th>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[130px]">
                          <span class="min-w-max">Abandonou em</span>
                        </th>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left w-[150px]">
                          <!---->
                        </th>
                        <th class="border-b border-tableBorder bg-tableHeader px-[6px] pb-[20px] pt-[20px] text-regular uppercase text-primary text-left">
                          <span class="min-w-max">Total</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <tr data-v-2bf42f57="" class="border-b border-tableBorder bg-uncontrastColor clickable">
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <span class="min-w-max text-secondary">
                            <div>Hoje, <br> 17:03 </div>
                          </span>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <div class="inline-flex items-center px-3 py-1 rounded text-regular text-statusTransit bg-statusTransit-100 min-w-max">Em recuperação</div>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">Julia</td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <span class="min-w-max">Pagamento</span>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <a target="_blank" rel="noopener noreferrer" href="https://wa.me/5511958587740?text=Oi Julia, você não finalizou seu pedido. Restam apenas 3 unidades do produto escolhido, para finalizar sua compra acesse o link https://compra.franbyffr.com/Z2NwLXVzLWVhc3QxOjAxSk01S0E3QlExWTBaUzhCQUhOMkVUMkFa%3Fkey%3Dd2b6fee9a979083eb04b9a211c8dc772?source=continue.">
                              <i class="fa-brands fa-whatsapp text-2xl text-[#00BB8E]"></i>
                          </a>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">R$ 79,99</td>
                      </tr>

                      <tr data-v-2bf42f57="" class="border-b border-tableBorder bg-uncontrastColor clickable">
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <span class="min-w-max text-secondary">
                            <div>Hoje, <br> 17:00 </div>
                          </span>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <div class="inline-flex items-center px-3 py-1 rounded text-regular text-statusDelivered bg-statusDelivered-100 min-w-max">Recuperado</div>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">Julia</td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <span class="min-w-max">Pagamento</span>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">
                          <a target="_blank" rel="noopener noreferrer" href="https://wa.me/5527995047076?text=Oi Julia, você não finalizou seu pedido. Restam apenas 3 unidades do produto escolhido, para finalizar sua compra acesse o link https://compra.franbyffr.com/Z2NwLXVzLWVhc3QxOjAxSk01SzU3R1o1UEZKQUhGUTJSRVhCQ01H%3Fkey%3Df23cfda137c3c2c48918092957307fa1?source=continue.">
                              <i class="fa-brands fa-whatsapp text-2xl text-[#00BB8E]"></i>
                          </a>
                        </td>
                        <td data-v-b18394c4="" class="break-all px-[6px] pb-[30px] pt-[30px] text-regular text-primary text-left">R$ 114,38</td>
                      </tr>

                  
                    </tbody>
                  </table>
                </div>


                
              </div>
            </div>
            <div class="pt-8"></div>
          </div>
          
      </x-app-layout>
      