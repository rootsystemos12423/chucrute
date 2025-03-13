<x-app-layout>
      <div class="flex flex-col w-full px-2 pt-3 h-max xl:overflow-hidden">
            <form method="POST" action="{{ route('orderbump.store') }}" class="flex flex-col gap-10">
             @csrf
              <div class="flex flex-col items-start justify-start gap-5">
                <div class="flex flex-col gap-2">
                  <span class="flex items-center justify-start gap-2 cursor-pointer text-regular text-secondary hover:text-highlighted">
                        <a class="flex gap-2" href="/dashboard"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                            </svg> ver todos order bumps </span></a>
                  <h1 class="font-bold text-title text-primary">ORDER BUMP</h1>
                </div>
                <p class="text-regular text-primary">Crie um order bump em sua loja.</p>
              </div>
              <div class="flex flex-col items-start justify-start gap-5 lg:flex-row">
                <div class="flex flex-col items-start justify-start order-2 w-full gap-5 lg:order-1 lg:w-8/12">
                  <div class="flex flex-row items-start justify-start w-full gap-3 p-4 rounded bg-uncontrastColor">
                    <div class="flex items-center justify-center w-full gap-10 my-16">
                     
                  <button class="outline outline-1 outline-[#ff0071] hover:outline-highlighted text-regular text-primary hover:text-highlighted stroke-primary hover:stroke-highlighted select-none flex flex-col justify-center items-center gap-5 py-5 px-4 rounded disabled:cursor-not-allowed disabled:opacity-50 disabled:pointer-events-none custom-size box-selected" type="submit">
                        <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M58.6667 40C58.6667 50.32 50.32 58.6667 40 58.6667L42.8 54" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M5.33301 24.0002C5.33301 13.6802 13.6797 5.3335 23.9997 5.3335L21.1997 10.0002" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M36.5332 11.8667L47.1465 18L57.6532 11.8934" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M47.1465 28.8532V17.9731" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M44.6396 5.8935L38.2396 9.44005C36.7996 10.24 35.5996 12.2667 35.5996 13.92V20.6935C35.5996 22.3468 36.7729 24.3734 38.2396 25.1734L44.6396 28.7202C45.9996 29.4935 48.2396 29.4935 49.6263 28.7202L56.0262 25.1734C57.4662 24.3734 58.6663 22.3468 58.6663 20.6935V13.92C58.6663 12.2667 57.4929 10.24 56.0262 9.44005L49.6263 5.8935C48.2663 5.14683 46.0263 5.14683 44.6396 5.8935Z" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M6.2666 41.1997L16.8533 47.333L27.3866 41.2264" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M16.8535 58.1862V47.3062" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M14.373 35.2265L7.97302 38.7731C6.53302 39.5731 5.33301 41.5997 5.33301 43.253V50.0265C5.33301 51.6798 6.50636 53.7065 7.97302 54.5065L14.373 58.0532C15.733 58.8265 17.973 58.8265 19.3597 58.0532L25.7597 54.5065C27.1997 53.7065 28.3997 51.6798 28.3997 50.0265V43.253C28.3997 41.5997 27.2264 39.5731 25.7597 38.7731L19.3597 35.2265C17.973 34.4798 15.733 34.4798 14.373 35.2265Z" stroke="#F30168" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg> <span class="text-highlighted font-semibold">Qualquer produto</span> 
                  </button>
                      
                    </div>
                  </div>
                  <div class="flex flex-col items-start justify-start w-full p-4 rounded gap-7 bg-uncontrastColor">
                    <span class="font-bold text-regular text-primary">Oferta</span>
                    <div class="flex flex-col items-start justify-start w-full gap-7">
                      <div class="flex flex-col items-start justify-start w-full gap-2">
                        <!---->
                        <!---->
                        <span class="text-regular text-primary">Oferecer o produto... *</span>
                        <div class="relative w-full">
                              <input type="hidden" name="product_id" id="product_id" value="">
                              <!-- Input de Busca -->
                              <div class="relative w-full text-primary">
                                <div class="flex items-center w-full justify-between border border-gray-300 rounded-lg shadow-sm bg-white px-4 py-1 focus-within:border-[#ff0071] focus-within:ring focus-within:ring-[#ff0071]">
                                  <input 
                                    type="text" 
                                    id="search-input"
                                    class="w-full bg-transparent outline-none text-gray-700 placeholder-gray-400 border-0 outline-0 pl-10" 
                                    placeholder="Buscar por produto"
                                    aria-label="Buscar por produto"
                                    onfocus="toggleProductsList(true)" 
                                    onblur="toggleProductsList(false)"
                                  >
                                  <div class="text-gray-500 absolute left-4">
                                    <img id="selected-product-img" src="" alt="Produto Selecionado" class="hidden w-6 h-6 object-cover rounded-full">
                                  </div>
                                  <div class="absolute right-4 text-gray-500">
                                    <i class="el-icon el-select__caret el-select__icon">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 1024 1024">
                                        <path fill="currentColor" d="M831.872 340.864 512 652.672 192.128 340.864a30.592 30.592 0 0 0-42.752 0 29.12 29.12 0 0 0 0 41.6L489.664 714.24a32 32 0 0 0 44.672 0l340.288-331.712a29.12 29.12 0 0 0 0-41.728 30.592 30.592 0 0 0-42.752 0z"></path>
                                      </svg>
                                    </i>
                                  </div>
                                </div>
                              </div>
                            
                              <!-- Lista de Produtos -->
                              <div id="products-list" class="absolute z-20 top-full left-0 mt-2 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-auto hidden">
                                <!-- Produtos carregados dinamicamente aparecerão aqui -->
                              </div>
                            </div>
                            
                            <script>
                              let selectedProductId = null; // Variável para armazenar o ID do produto selecionado
                            
                              document.addEventListener('DOMContentLoaded', () => {
                                const storeId = document.querySelector('meta[name="store_id"]').getAttribute('content');
                            
                                fetchProducts('', storeId); // Carrega todos os produtos inicialmente
                            
                                // Evento de input para a busca
                                document.getElementById('search-input').addEventListener('input', function() {
                                  const searchTerm = this.value.trim();
                            
                                  if (searchTerm.length > 0) {
                                    fetchProducts(searchTerm, storeId); // Chama a função com o termo de busca
                                  } else {
                                    fetchProducts('', storeId); // Chama a função sem termo de busca
                                  }
                                });
                              });
                            
                              // Função para buscar produtos
                              function fetchProducts(searchTerm = '', storeId) {
                                const url = searchTerm ? `/api/dashboard/orderbumps/search?search=${encodeURIComponent(searchTerm)}&store_id=${storeId}` : `/api/dashboard/orderbumps/search?store_id=${storeId}`;
                            
                                fetch(url)
                                  .then(response => response.json())
                                  .then(data => {
                                    const productList = document.getElementById('products-list');
                                    productList.innerHTML = ''; // Limpa a lista antes de adicionar os novos resultados
                                    productList.classList.remove('hidden'); // Torna a lista visível
                            
                                    if (data.products && data.products.length > 0) {
                                      data.products.forEach(product => {
                                        const productElement = createProductElement(product);
                                        productList.appendChild(productElement);
                                      });
                                    } else {
                                      const noResults = document.createElement('div');
                                      noResults.classList.add('p-3', 'text-center', 'text-gray-500');
                                      noResults.textContent = 'Nenhum produto encontrado';
                                      productList.appendChild(noResults);
                                    }
                                  })
                                  .catch(error => {
                                    console.error('Erro ao buscar produtos:', error);
                                    const productList = document.getElementById('products-list');
                                    productList.classList.remove('hidden'); // Exibe a lista caso ocorra erro
                                    const noResults = document.createElement('div');
                                    noResults.classList.add('p-3', 'text-center', 'text-gray-500');
                                    noResults.textContent = 'Erro ao carregar produtos';
                                    productList.appendChild(noResults);
                                  });
                              }
                            
                              // Função para criar um item de produto
                              function createProductElement(product) {
                                    const productElement = document.createElement('div');
                                    productElement.classList.add('flex', 'items-center', 'p-2', 'cursor-pointer', 'hover:bg-gray-100', 'transition', 'font-medium', 'text-gray-700');

                                    // Adicionando a imagem e o nome do produto
                                    productElement.innerHTML = `
                                    <img src="${product.image}" alt="${product.name}" class="w-10 h-10 object-cover rounded-full mr-3" onError="this.onerror=null;this.src='/path/to/your/default-image.jpg';">
                                    <span>${product.name}</span>
                                    `;

                                    // Quando o produto é selecionado, salva no campo de busca
                                    productElement.addEventListener('click', () => selectProduct(product));

                                    return productElement;
                              }
                            
                              // Função para selecionar o produto
                              function selectProduct(product) {
                                    selectedProductId = product.id; // Salva o ID do produto selecionado
                                    document.getElementById('product_id').value = product.id; // Define o ID do produto no input oculto

                                    document.getElementById('search-input').value = product.name; // Exibe o nome do produto no campo de input
                                    document.getElementById('selected-product-img').src = product.image; // Exibe a imagem do produto selecionado
                                    document.getElementById('selected-product-img').classList.remove('hidden'); // Torna a imagem visível

                                    toggleProductsList(false); // Oculta a lista de produtos
                                    }

                            
                              // Função para alternar a visibilidade da lista de produtos
                              function toggleProductsList(show) {
                                const productList = document.getElementById('products-list');
                                if (show) {
                                  productList.classList.remove('hidden');
                                } else {
                                  productList.classList.add('hidden');
                                }
                              }
                            </script>                            
                                                    
                                                                                                                                      
                        
                      </div>
                      <div class="flex flex-col items-start justify-start w-1/3 gap-2">
                        <span class="text-regular text-primary">Desconto: * </span>
                        <x-prefix-input 
                        name="discount" 
                        wire:model="discount" 
                        x-model="discount"
                        type="text" 
                        placeholder="insira aqui seu desconto" 
                        class="w-full border rounded-md" 
                        suffix="%"
                        x-model="discount"
                        value="{ discount: '{{ $shopify->shopify_url ?? '1' }}' }"
                         />
                      </div>
                      <div class="flex flex-col items-start justify-start w-full gap-2">
                        <span class="text-regular text-primary">Título da oferta: *</span>
                        <div class="flex flex-col items-start justify-start gap-2 w-full" name="title" value="">
                          <input name="offer_title" type="text" placeholder="Garanta Esse Desconto Imperdivel" class="w-full rounded-md border focus:border bg-white border-gray-300 p-2 text-regular text-primary focus:border-highlighted focus:outline-none disabled:cursor-not-allowed" min="-Infinity" max="Infinity">
                          <!---->
                        </div>
                      </div>
                     
                      <div class="flex flex-col items-start justify-start w-full gap-2">
                        <span class="text-regular text-primary">Descrição do Order Bump: *</span>
                        <div class="flex flex-col items-start justify-start gap-2 w-full" name="`button_text" value="">
                          <textarea placeholder="Oferta imperdivel..." name="offer_desc_text" class="w-full rounded-md border focus:border bg-white border-gray-300 focus:order-gray-300 p-2 text-regular text-primary focus:border-highlighted focus:outline-none disabled:cursor-not-allowed" min="-Infinity" max="Infinity"></textarea>
                          <!---->
                        </div>
                      </div>

                      <div class="flex flex-col items-start justify-start w-full gap-2">
                        <span class="text-regular text-primary">Texto do botão: *</span>
                        <div class="flex flex-col items-start justify-start gap-2 w-full" name="`button_text" value="">
                          <input type="text" placeholder="Garanta Desconto" name="offer_button_text" class="w-full rounded-md border focus:border bg-white border-gray-300 focus:order-gray-300 p-2 text-regular text-primary focus:border-highlighted focus:outline-none disabled:cursor-not-allowed" min="-Infinity" max="Infinity">
                          <!---->
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="flex w-full items-center justify-end gap-5">
                        <button type="button" wire:click="cancel" class="px-4 py-2 bg-transparent border border-[#ff0071] text-[#ff0071] rounded-md">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-[#ff0071] text-white rounded-md">Salvar</button>
                  </div>
                  <div class="w-full md:px-4 block md:hidden">
                    <div class="flex w-full items-center justify-start gap-3 rounded border border-shadowColor-100 p-4">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-9 text-highlighted">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                      </svg>
                      <a href="https://ajuda.adoorei.com.br/pt-BR/articles/8370582-como-criar-um-order-bump" target="_blank" rel="noopener noreferrer" class="text-regular text-primary hover:text-highlighted">
                        <strong class="text-highlighted">Está com dúvidas?&nbsp; </strong>
                        <span class="underline">Aprenda como criar um order bump.</span>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="flex flex-col items-start justify-start order-1 w-full gap-5 lg:order-2 lg:w-4/12">
                  <div class="flex flex-col items-start justify-start w-full p-4 rounded gap-7 bg-uncontrastColor">
                    <div class="flex flex-col items-start justify-start w-full gap-3">
                      <span class="font-bold text-regular text-primary">Status *</span>
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
                    </div>
                  </div>
                  <div class="w-full md:px-4 hidden md:block">
                    <div class="flex w-full items-center justify-start gap-3 rounded border border-shadowColor-100 p-4">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon" class="w-9 text-highlighted">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"></path>
                      </svg>
                      <a href="https://ajuda.adoorei.com.br/pt-BR/articles/8370582-como-criar-um-order-bump" target="_blank" rel="noopener noreferrer" class="text-regular text-primary hover:text-highlighted">
                        <strong class="text-highlighted">Está com dúvidas?&nbsp; </strong>
                        <span class="underline">Aprenda como criar um order bump.</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="pt-16"></div>
          </div>
</x-app-layout>
      