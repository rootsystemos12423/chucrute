      <x-app-layout>
  
            <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
              <form method="POST" action="{{ route('utmify.store') }}" class="flex flex-col gap-10">
               @csrf
                <div class="flex flex-col gap-10">
                  <div class="flex flex-col items-start justify-start gap-5">
                    <div class="flex flex-col gap-4">
                      <a href="{{ route('apps') }}" class="flex max-w-max cursor-pointer items-center justify-start gap-2 text-regular text-secondary hover:text-highlighted">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path></svg>
                        ver todos gateways
                      </a>
                      <div class="flex flex-row items-center gap-2 pl-1">
                        <img data-v-9ef7c93f="" class="h-[50px] w-[50px] min-w-[50px] rounded-lg p-1" src="https://cdn.adoorei.com/imagens/apps/utmify.png" alt="Utmify">
                        <div class="flex items-center gap-5 text-center flex-wrap">
                          <h1 class="text-title font-bold text-primary">UTMIFY</h1>
                          <!---->
                          <p class="text-small text-secondary"></p>
                        </div>
                      </div>
                      <p class="pl-1 text-regular text-primary">Crie uma integração com pixel do Utmify.</p>
                    </div>
                  </div>
                  <div class="flex flex-wrap items-start justify-start w-full gap-5 md:flex-nowrap lg:flex-row">
                    <div class="flex flex-col items-start justify-start order-2 w-full gap-5 md:order-1 lg:w-8/12">
                      <div class="w-full">
                        <div class="flex flex-col flex-grow w-full gap-5 p-8 rounded justify-left items-left bg-white">
                          <span class="mb-4 font-bold text-regular text-primary">Informações básicas</span>

                          <div class="flex flex-col items-start justify-start w-full gap-2">
                              <span class="text-regular text-primary">Api Da Utmify *</span>
                              <input wire:model="api_key" name="api_key" value="{{ $utmify->utmify_api_key ?? '' }}" type="text" class="w-full p-2 border rounded-md" />
                            </div>
                        </div>

                      </div>
                          
                      <div class="w-full">
                        <!---->
                      </div>
                      <div class="flex w-full items-center justify-end gap-5">
                        <button type="button" wire:click="cancel" class="px-4 py-2 bg-transparent border border-[#ff0071] text-[#ff0071] rounded-md">Cancelar</button>
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
                            selected="active" 
                            placeholder="Selecione o status"
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