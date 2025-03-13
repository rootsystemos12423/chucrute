<x-app-layout>
      <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
          <form @submit.prevent="submitForm" x-data="shippingForm()" class="flex flex-col gap-10">
              <div class="flex flex-col gap-10">
                  <div class="flex flex-col items-start justify-start gap-5">
                      <div class="flex flex-col gap-4">
                          <a href="{{ route('logistic') }}" class="flex max-w-max cursor-pointer items-center justify-start gap-2 text-regular text-secondary hover:text-highlighted">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                              </svg>
                              Ver os fretes
                          </a>
                          <div class="flex flex-row items-center gap-2 pl-1">
                              <h1 class="text-title font-bold text-primary">LOGÍSTICA</h1>
                          </div>
                          <p class="pl-1 text-regular text-primary">Cadastre um frete em sua loja.</p>
                      </div>
                  </div>
  
                  <div class="flex flex-wrap items-start justify-start w-full gap-5 md:flex-nowrap lg:flex-row">
                      <input type="hidden" name="_token" x-ref="csrfToken" value="{{ csrf_token() }}">
  
                      <div class="flex flex-col w-full lg:w-8/12 bg-white p-8 rounded gap-5">
                          <span class="mb-4 font-bold text-regular text-primary">Informações do Frete</span>
  
                          <!-- Nome do Frete -->
                          <div class="flex flex-col gap-2">
                              <label class="text-regular text-primary">Nome do Frete *</label>
                              <input x-model="shipping_name" class="w-full px-4 py-3 border-gray-400 border rounded-md text-sm" placeholder="Ex: Frete Grátis" type="text" required>
                          </div>
  
                          <!-- Valor do Frete -->
                          <div class="flex flex-col gap-2">
                              <label class="text-regular text-primary">Valor do Frete *</label>
                              <div class="relative w-64">
                                  <span class="absolute left-3 top-3 text-gray-500">R$</span>
                                  <input x-model="shipping_price" type="text" placeholder="0,00" class="w-full pl-8 pr-4 py-3 border-gray-400 border rounded-md text-sm">
                              </div>
                              <span class="text-xs text-gray-600 p-1">Deixe em branco caso seja grátis.</span>
                          </div>
  
                          <!-- Dias mínimos para entrega -->
                          <div class="flex flex-col gap-2">
                              <label class="text-regular text-primary">Dias mínimos para entrega</label>
                              <input x-model="min_delivery_days" class="w-64 px-4 py-3 border-gray-400 border rounded-md text-sm" placeholder="Ex: 2" type="number">
                              <span class="text-xs text-gray-600 p-1">Deixe em branco caso não queira exibir um prazo no checkout.</span>
                          </div>
  
                          <!-- Dias máximos para entrega -->
                          <div class="flex flex-col gap-2">
                              <label class="text-regular text-primary">Dias máximos para entrega</label>
                              <input x-model="max_delivery_days" class="w-64 px-4 py-3 border-gray-400 border rounded-md text-sm" placeholder="Ex: 10" type="number">
                              <span class="text-xs text-gray-600 p-1">Deixe em branco caso não queira exibir um prazo no checkout.</span>
                          </div>
                      </div>
  
                      <!-- Configurações Adicionais -->
                      <div class="flex flex-col w-full lg:w-4/12 bg-white p-4 rounded gap-5">
                          <div class="flex flex-col gap-3">
                              <label class="text-regular font-bold text-primary">Status *</label>
                              <select x-model="status" class="border-gray-400 border rounded-md p-2">
                                  <option value="active">Ativo</option>
                                  <option value="inactive">Inativo</option>
                              </select>
                          </div>
                      </div>
                  </div>
  
                  <div class="flex w-full items-center justify-end gap-5">
                      <button type="button" class="px-4 py-2 bg-transparent border border-[#ff0071] text-[#ff0071] rounded-md">Cancelar</button>
                      <button type="submit" class="px-4 py-2 bg-[#ff0071] text-white rounded-md">Salvar</button>
                  </div>
              </div>
          </form>
  
          <div class="pt-16"></div>
      </div>
  
      <script>
          function shippingForm() {
              return {
                  shipping_name: '',
                  shipping_price: '',
                  min_delivery_days: '',
                  max_delivery_days: '',
                  status: 'active',
  
                  async submitForm() {
                      const response = await fetch('/api/dashboard/logistic/store', {
                          method: 'POST',
                          headers: {
                              'Content-Type': 'application/json',
                              'X-CSRF-TOKEN': this.$refs.csrfToken.value
                          },
                          body: JSON.stringify({
                              name: this.shipping_name,
                              price: this.shipping_price,
                              min_delivery_days: this.min_delivery_days,
                              max_delivery_days: this.max_delivery_days,
                              status: this.status,
                              store_id: {{ session('store_id') }},
                          })
                      });
  
                      const data = await response.json();
  
                      if (response.ok) {
                          alert('Frete cadastrado com sucesso!');
                          location.reload(); // Atualiza a página após o cadastro
                      } else {
                          alert(data.message || 'Erro ao cadastrar frete.');
                      }
                  }
              };
          }
      </script>
  </x-app-layout>
  