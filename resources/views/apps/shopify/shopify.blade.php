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
                  <img data-v-c84a4674="" class="h-11 w-11" src="https://cdn.adoorei.com/imagens/apps/shopify.png" alt="">                  
                  <div class="flex items-center gap-5 text-center flex-wrap">
                    <h1 class="text-title font-bold text-primary">SHOPIFY</h1>
                    <p class="text-small text-secondary"></p>
                  </div>
                </div>
                <p class="pl-1 text-regular text-primary">Instale o checkout transparente da Adoorei na sua loja shopify.</p>
              </div>
            </div>
            
            <div x-data="shopifyForm()" class="flex flex-wrap items-start justify-start w-full gap-5 md:flex-nowrap lg:flex-row">
              <form>
                  <!-- Aqui é onde o token CSRF é gerado -->
                  <input type="hidden" name="_token" x-ref="csrfToken" value="{{ csrf_token() }}">

                  <div class="flex flex-col items-start justify-start order-2 w-full gap-5 md:order-1 lg:w-8/12">
                      <div class="w-full">
                          <div class="flex flex-col flex-grow w-full gap-5 p-8 rounded justify-left items-left bg-white">
                              <span class="mb-4 font-bold text-regular text-primary">Informações básicas</span>
                              <div class="flex flex-col items-start justify-start w-full gap-2">
                                  <span class="text-regular text-primary">URL da loja *</span>
                                  <x-prefix-input 
                                          name="shopify_url" 
                                          wire:model="shopify_url" 
                                          x-model="shopify_url"
                                          type="text" 
                                          placeholder="sua url aqui" 
                                          class="w-full border rounded-md" 
                                          suffix=".myshopify.com"
                                          x-model="shopify_url"
                                          value="{ shopify_url: '{{ $shopify->shopify_url ?? '' }}' }"
                                    />
                                  <span class="text-xs text-gray-600 p-1">A URL não pode conter os seguintes valores: myshopify.com www., https://, http://, /, .br</span>
                              </div>
                              <div class="flex flex-col items-start justify-start w-full gap-2">
                                  <span class="text-regular text-primary">Token de acesso api admin *</span>
                                  <input value="{{ $shopify->shopify_api_token ?? '' }}" x-model="shopify_api_token" class="w-full px-4 py-3 text-gray-900 bg-white focus:outline-none border-gray-400 border rounded-md text-sm" placeholder="Token De Acesso Shopify" type="text" name="shopify_api_token" x-model="shopify_api_token">
                              </div>
                              <div class="flex flex-col items-start justify-start w-full gap-2">
                                  <span class="text-regular text-primary">Chave de API *</span>
                                  <input value="{{ $shopify->shopify_api_key ?? '' }}" x-model="shopify_api_key" class="w-full px-4 py-3 text-gray-900 bg-white focus:outline-none border-gray-400 border rounded-md text-sm" placeholder="Key De Acesso Shopify" type="text" @if($shopify)value="{{ $shopify->shopify_api_key }}"@endif name="shopify_api_key" x-model="shopify_api_key">
                              </div>
                              <div class="flex flex-col items-start justify-start w-full gap-2">
                                  <span class="text-regular text-primary">Chave secreta da api *</span>
                                  <input value="{{ $shopify->shopify_api_secret ?? '' }}" x-model="shopify_api_secret" class="w-full px-4 py-3 text-gray-900 bg-white focus:outline-none border-gray-400 border rounded-md text-sm" placeholder="Secret Key De Acesso Shopify" type="text" @if($shopify)value="{{ $shopify->shopify_api_secret }}"@endif name="shopify_api_secret" x-model="shopify_api_secret">
                              </div>
                          </div>
                      </div>
              
                      <div class="flex w-full items-center justify-end gap-5">
                          <button type="button" wire:click="cancel" class="px-4 py-2 bg-transparent border border-[#ff0071] text-[#ff0071] rounded-md">Cancelar</button>
                          <button type="button" @click="submitForm" class="px-4 py-2 bg-[#ff0071] text-white rounded-md">Salvar</button>
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
                                  x-model="status"
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
                  </form>
              </div>

              <script>
                document.addEventListener('alpine:init', () => {
                    Alpine.data('shopifyForm', () => ({
                        // Pega os valores do backend, mas permite edição na view
                        shopify_url: '{{ $shopify->shopify_url ?? '' }}',
                        shopify_api_token: '{{ $shopify->shopify_api_token ?? '' }}',
                        shopify_api_key: '{{ $shopify->shopify_api_key ?? '' }}',
                        shopify_api_secret: '{{ $shopify->shopify_api_secret ?? '' }}',
                        status: 'active',
            
                        init() {
                            this.$nextTick(() => {
                                console.log('Alpine iniciado');
                                this.$watch('shopify_url', value => console.log('shopify_url alterado para:', value));
                                this.$watch('shopify_api_token', value => console.log('shopify_api_token alterado para:', value));
                                this.$watch('shopify_api_key', value => console.log('shopify_api_key alterado para:', value));
                                this.$watch('shopify_api_secret', value => console.log('shopify_api_secret alterado para:', value));
                                this.$watch('status', value => console.log('status alterado para:', value));
                            });
                        },
            
                        submitForm() {
                            const formData = {
                                shopify_url: this.shopify_url,
                                shopify_api_token: this.shopify_api_token,
                                shopify_api_key: this.shopify_api_key,
                                shopify_api_secret: this.shopify_api_secret,
                                status: this.status,
                                store_id: {{ session('store_id') }},
                            };
            
                            const csrfToken = this.$refs.csrfToken?.value ?? '';
            
                            fetch('/api/store/shopify/credentials', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-Token': csrfToken,
                                },
                                body: JSON.stringify(formData),
                            })
                            .then(response => response.json()) 
                            .then(data => {
                                if (data.message === 'Shopify checkout store created successfully!') {
                                    alert('Formulário enviado com sucesso!');
                                    console.log(data);
                                } else {
                                    console.error('Erro:', data);
                                    alert('Erro ao enviar o formulário.');
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao processar a resposta:', error);
                            });
                        }
                    }));
                });
            </script>            
            
              

          </div>
        </form>
        <div class="pt-16"></div>
      </div>
    
    </x-app-layout>
    