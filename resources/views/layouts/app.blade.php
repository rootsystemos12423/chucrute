<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Incluindo o store_id na meta tag -->
        <meta name="store_id" content="{{ session('store_id') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Sora:wght@100..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <wireui:scripts />
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body x-data="{ open: false }" class="font-sora antialiased bg-gray-100">

        <div class="min-h-screen flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm py px-4 flex justify-end items-center">
                <nav>
                    <a href="#" class="text-gray-600 hover:text-gray-900">Dashboard</a>
                    <a href="#" class="ml-4 text-gray-600 hover:text-gray-900">Configurações</a>
                </nav>

                <div class="flex items-center justify-end w-full h-full gap-7">
                    <div class="items-center hidden xl:flex cursor-pointer">
                      <div class="w-[320px]">
                        <div id="percentage-bar" class="flex items-center justify-start rounded border border-shadowColor-100 p-6 bg-uncontrastColor border-none px-3" style="width: 100%; height: 75px;">
                          <div class="value-container flex w-full min-w-fit flex-col items-start justify-between self-stretch" style="width: 0%;">
                            <span class="text-regular text-primary"></span>
                          </div>
                          <div class="value-container flex items-center self-stretch" style="width: 100%;">
                            <div class="bar text-center font-extrabold min-h-6 w-full bg-[#ff0071] rounded-lg py-1 pl-4 text-regular text-white hover:opacity-70">RAUL NIVEL MAXIMO</div>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="relative hidden h-[50px] w-[50px] cursor-pointer select-none items-center justify-center rounded-full bg-gray-300 text-regular font-bold leading-none text-uncontrastColor hover:shadow-[0_0_0_3px] xl:flex">
                      <div class="text-white text-lg p-2">RDF</div>
                    </div>
                    <!---->
                  </div>
            </header>

            <div class="flex flex-1">
                <!-- Sidebar -->
                <aside class="w-72 bg-zinc-900 shadow-lg h-screen fixed flex flex-col items-center left-0 top-0 p-6 overflow-y-auto overflow-x-hidden">
                    <!-- Cabeçalho com divisão -->
                    <div class="pb-6 text-center">
                        <x-application-logo />
                    </div>

                    <div class="pt-4 pb-4 bg-zinc-800 w-full rounded-lg flex flex-col w-64">
                        <div class="flex items-center justify-between pr-4 pl-4 cursor-pointer" id="toggleStoreList">
                            <div class="flex items-center justify-start gap-3"><div class="flex h-[30px] w-[30px] select-none items-center justify-center rounded-md bg-[#D9D9D9] text-subtitle font-bold uppercase leading-none text-contrastColor">{{ collect(explode(' ', $authStore->name))->filter()->take(2)->map(fn($word) => Str::substr($word, 0, 1))->join('') }}</div><div class="max-w-[160px] truncate text-regular font-bold text-white">{{ $authStore->name }}</div></div>
                            <i class="fa-solid fa-chevron-down text-sm text-zinc-300 cursor-pointer"></i>
                        </div>

                        <div id="list-stores" class="flex flex-col hidden gap-3 px-2 pt-4">
                            <hr class="border-white/50">
                            <div class="flex flex-col gap-3 px-3 pb-3">
                              <span class="text-white text-regular">Suas lojas</span>
                              <div class="flex flex-col gap-2">
                                
                                @foreach ($stores as $store)
                                  @if ($store->id != intval(session('store_id')))
                                      <form method="POST" action="{{ route('change.checkout.store') }}" class="flex h-[60px] w-full min-w-max cursor-pointer items-center justify-between rounded bg-transparent px-2 hover:bg-shadowColor-50">
                                          @csrf
                                          <button class="flex items-center justify-between w-full">
                                              <input type="hidden" name="store_id" value="{{ $store->id }}">
                                              <div class="flex items-center justify-start gap-3">
                                                  <div class="flex h-[30px] w-[30px] select-none items-center justify-center rounded-md bg-[#D9D9D9] text-subtitle font-bold uppercase leading-none text-contrastColor">
                                                      {{ collect(explode(' ', $store->name))->filter()->take(2)->map(fn($word) => Str::substr($word, 0, 1))->join('') }}
                                                  </div>
                                                  <div class="max-w-[130px] truncate text-regular font-bold text-white">{{ $store->name }}</div>
                                              </div>
                                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon" class="h-5 w-5 text-[#D9D9D9] hover:text-highlighted">
                                                  <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z"></path>
                                                  <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z"></path>
                                              </svg>
                                          </button>
                                      </form>
                                  @endif
                            @endforeach
                            
                            
    
                              </div>
                              <button 
                                  class="text-[13px] select-none flex justify-center items-center gap-4 py-2.5 px-3 rounded disabled:opacity-50 disabled:pointer-events-none font-extrabold bg-[#F30168] text-white rounded-lg"
                                  @click="open = true"
                                  type="button"
                              >
                                  ADICIONAR NOVA LOJA
                              </button>

                            </div>
                          </div>
                    </div>

                    <script>
                      document.addEventListener('DOMContentLoaded', function () {
                          const toggleButton = document.getElementById('toggleStoreList');
                          const storeList = document.getElementById('list-stores');
                          const icon = toggleButton.querySelector('i');
                      
                          let isOpen = false;
                          
                          function toggleStoreList() {
                              isOpen = !isOpen;
                              storeList.classList.toggle('hidden', !isOpen);
                              toggleButton.setAttribute('aria-expanded', isOpen);
                              icon.style.transform = isOpen ? 'rotate(180deg)' : 'rotate(0deg)';
                          }
                      
                          toggleButton.addEventListener('click', function (event) {
                              event.stopPropagation();
                              toggleStoreList();
                          });
                      
                          document.addEventListener('click', function (event) {
                              if (!toggleButton.contains(event.target) && !storeList.contains(event.target) && isOpen) {
                                  toggleStoreList();
                              }
                          });
                      });
                      </script>
                      
                
                    <!-- Navegação com espaçamento denso -->
                    <nav class="flex flex-col gap-1 w-full pt-4">
                        <div class="flex flex-col items-start justify-start w-full h-full">
                            <!-- Página Inicial -->
                            <a aria-current="page" href="{{ route('dashboard') }}" class="router-link-active router-link-exact-active flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white @if(request()->routeIs('dashboard')) font-bold text-white @else text-white/70 @endif">
                                <i class="fas fa-home text-lg text-white/70"></i>
                                <span class="select-none truncate text-regular font-semibold">Página inicial</span>
                            </a>
                    
                           <!-- Relatórios -->
                            <div class="flex w-full flex-col">
                                <div class="flex min-h-[48px] w-full min-w-max cursor-pointer items-center justify-between rounded-lg px-5 hover:font-bold hover:text-white @if(request()->routeIs('reports')) font-bold text-white @else text-white/70 @endif" id="toggleReports">
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-chart-line text-lg text-white/70"></i>
                                        <span class="select-none text-regular">Relatórios</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-sm" id="toggleIcon"></i>
                                </div>
                            </div>

                            <div class="relative flex pl-8" id="reportsContent" style="display: none;">
                                <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                                <div class="flex w-full flex-col">
                                    <a href="/reports" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                        <span class="select-none truncate text-regular">Visão Geral</span>
                                        <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                    </a>
                                </div>
                            </div>

                            <script>
                                document.getElementById('toggleReports').addEventListener('click', function() {
                                    // Seleciona o conteúdo que será mostrado/ocultado
                                    var reportsContent = document.getElementById('reportsContent');
                                    var toggleIcon = document.getElementById('toggleIcon');
                                    
                                    // Verifica se o conteúdo está visível
                                    if (reportsContent.style.display === 'none' || reportsContent.style.display === '') {
                                        reportsContent.style.display = 'flex'; // Exibe o conteúdo
                                        toggleIcon.classList.remove('fa-chevron-down'); // Remove o ícone de seta para baixo
                                        toggleIcon.classList.add('fa-chevron-up'); // Adiciona o ícone de seta para cima
                                    } else {
                                        reportsContent.style.display = 'none'; // Oculta o conteúdo
                                        toggleIcon.classList.remove('fa-chevron-up'); // Remove o ícone de seta para cima
                                        toggleIcon.classList.add('fa-chevron-down'); // Adiciona o ícone de seta para baixo
                                    }
                                });
                            </script>

                            <!-- FIM RELATORIOS -->

                    
                            <!-- Pedidos -->
                            <div class="flex w-full flex-col">
                                <div class="flex min-h-[48px] w-full min-w-max cursor-pointer items-center justify-between rounded-lg px-5 hover:font-bold hover:text-white @if(request()->routeIs('orders') || request()->routeIs('recover_carts')) font-bold text-white @else text-white/70 @endif" id="toggleOrders">
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-shopping-cart text-lg text-white/70"></i>
                                        <span class="select-none text-regular">Pedidos</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-sm" id="ordersIcon"></i>
                                </div>
                            </div>


                            <div class="relative ordersContent flex pl-8" style="display: none;">
                                <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                                <div class="flex w-full flex-col">
                                  <a href="/orders" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                    <span class="select-none truncate text-regular">Ver Todos</span>
                                    <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                  </a>
                                </div>
                              </div>
                              
                              <div class="relative ordersContent flex pl-8" style="display: none;">
                                <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                                <div class="flex w-full flex-col">
                                  <a href="/recover/carts" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                    <span class="select-none truncate text-regular">Carrinhos Abandonados</span>
                                    <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                  </a>
                                </div>
                              </div>


                              <script>
                                document.getElementById('toggleOrders').addEventListener('click', function() {
                                  // Seleciona todos os elementos com a classe "ordersContent"
                                  var orderContents = document.querySelectorAll(".ordersContent");
                                  var toggleIcon = document.getElementById('ordersIcon');
                                  
                                  // Verifica o estado do primeiro elemento como referência
                                  var isHidden = orderContents[0].style.display === 'none' || orderContents[0].style.display === '';
                              
                                  // Percorre todos os elementos e ajusta a exibição
                                  orderContents.forEach(function(element) {
                                    element.style.display = isHidden ? 'flex' : 'none';
                                  });
                                  
                                  // Altera o ícone conforme o estado
                                  if (isHidden) {
                                    toggleIcon.classList.remove('fa-chevron-down');
                                    toggleIcon.classList.add('fa-chevron-up');
                                  } else {
                                    toggleIcon.classList.remove('fa-chevron-up');
                                    toggleIcon.classList.add('fa-chevron-down');
                                  }
                                });
                              </script>
                    
                            <!-- Produtos -->
                            <div class="flex w-full flex-col">
                                <div class="flex min-h-[48px] w-full min-w-max cursor-pointer items-center justify-between rounded-lg px-5 hover:font-bold hover:text-white @if(request()->routeIs('orders') || request()->routeIs('recover_carts')) font-bold text-white @else text-white/70 @endif"" id="toggleProducts">
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-box-open text-lg text-white/70"></i>
                                        <span class="select-none text-regular">Produtos</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-sm" id="productsIcon"></i>
                                </div>
                            </div>

                            <div class="relative productContent flex pl-8" style="display: none;">
                                <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                                <div class="flex w-full flex-col">
                                  <a href="/products" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                    <span class="select-none truncate text-regular">Ver Todos</span>
                                    <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                  </a>
                                </div>
                              </div>


                              <script>
                                document.getElementById('toggleProducts').addEventListener('click', function() {
                                  // Seleciona todos os elementos com a classe "ordersContent"
                                  var productContents = document.querySelectorAll(".productContent");
                                  var toggleIcon = document.getElementById('productsIcon');
                                  
                                  // Verifica o estado do primeiro elemento como referência
                                  var isHidden = productContents[0].style.display === 'none' || productContents[0].style.display === '';
                              
                                  // Percorre todos os elementos e ajusta a exibição
                                  productContents.forEach(function(element) {
                                    element.style.display = isHidden ? 'flex' : 'none';
                                  });
                                  
                                  // Altera o ícone conforme o estado
                                  if (isHidden) {
                                    toggleIcon.classList.remove('fa-chevron-down');
                                    toggleIcon.classList.add('fa-chevron-up');
                                  } else {
                                    toggleIcon.classList.remove('fa-chevron-up');
                                    toggleIcon.classList.add('fa-chevron-down');
                                  }
                                });
                              </script>
                    
                            <!-- Marketing -->
                            <div class="flex w-full flex-col">
                                <div class="flex min-h-[48px] w-full min-w-max cursor-pointer items-center justify-between rounded-lg px-5 hover:font-bold hover:text-white text-white/70" id="toggleMarketing">
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-bullhorn text-lg text-white/70"></i>
                                        <span class="select-none text-regular">Marketing</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-sm" id="marketingIcon"></i>
                                </div>
                            </div>

                            <div class="relative marketingContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('cupons') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Cupons</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative marketingContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('orderbump') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Order Bump</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative marketingContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('upsell') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Upsell</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative marketingContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('apps') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Pixels</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <script>
                              document.getElementById('toggleMarketing').addEventListener('click', function() {
                                // Seleciona todos os elementos com a classe "ordersContent"
                                var marketingContent = document.querySelectorAll(".marketingContent");
                                var toggleIcon = document.getElementById('marketingIcon');
                                
                                // Verifica o estado do primeiro elemento como referência
                                var isHidden = marketingContent[0].style.display === 'none' || marketingContent[0].style.display === '';
                            
                                // Percorre todos os elementos e ajusta a exibição
                                marketingContent.forEach(function(element) {
                                  element.style.display = isHidden ? 'flex' : 'none';
                                });
                                
                                // Altera o ícone conforme o estado
                                if (isHidden) {
                                  toggleIcon.classList.remove('fa-chevron-down');
                                  toggleIcon.classList.add('fa-chevron-up');
                                } else {
                                  toggleIcon.classList.remove('fa-chevron-up');
                                  toggleIcon.classList.add('fa-chevron-down');
                                }
                              });
                            </script>
                    
                            <!-- Checkout -->
                            <div class="flex w-full flex-col">
                                <div class="flex min-h-[48px] w-full min-w-max cursor-pointer items-center justify-between rounded-lg px-5 hover:font-bold hover:text-white text-white/70" id="toggleCheckout">
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-cash-register text-lg text-white/70"></i>
                                        <span class="select-none text-regular">Checkout</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-sm" id="checkoutIcon"></i>
                                </div>
                            </div>

                            <div class="relative checkoutContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('descontos') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Descontos</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative checkoutContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('builder.yampi') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Personalizar</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative checkoutContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('socialproof') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Provas Sociais</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative checkoutContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('pagamentos') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Pagamento</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <script>
                              document.getElementById('toggleCheckout').addEventListener('click', function() {
                                // Seleciona todos os elementos com a classe "ordersContent"
                                var checkoutContent = document.querySelectorAll(".checkoutContent");
                                var toggleIcon = document.getElementById('checkoutIcon');
                                
                                // Verifica o estado do primeiro elemento como referência
                                var isHidden = checkoutContent[0].style.display === 'none' || checkoutContent[0].style.display === '';
                            
                                // Percorre todos os elementos e ajusta a exibição
                                checkoutContent.forEach(function(element) {
                                  element.style.display = isHidden ? 'flex' : 'none';
                                });
                                
                                // Altera o ícone conforme o estado
                                if (isHidden) {
                                  toggleIcon.classList.remove('fa-chevron-down');
                                  toggleIcon.classList.add('fa-chevron-up');
                                } else {
                                  toggleIcon.classList.remove('fa-chevron-up');
                                  toggleIcon.classList.add('fa-chevron-down');
                                }
                              });
                            </script>
                    
                            <!-- Apps -->
                            <a href="/apps" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                <i class="fas fa-th text-lg text-white/70"></i>
                                <span class="select-none truncate text-regular">Apps</span>
                            </a>
                    
                            <!-- Configurações -->
                            <div class="flex w-full flex-col">
                                <div class="flex min-h-[48px] w-full min-w-max cursor-pointer items-center justify-between rounded-lg px-5 hover:font-bold hover:text-white text-white/70" id="configToggle">
                                    <div class="flex items-center gap-5">
                                        <i class="fas fa-cog text-lg text-white/70"></i>
                                        <span class="select-none text-regular">Configurações</span>
                                    </div>
                                    <i class="fas fa-chevron-down text-sm" id="configIcon"></i>
                                </div>
                            </div>

                            <div class="relative configContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('configgeral') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Geral</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative configContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('dominios') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Domínios</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative configContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('logistic') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Logística</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative configContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('pagamentos') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Webhooks</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <div class="relative configContent flex pl-8" style="display: none;">
                              <hr class="t-0 l-0 drawer-bar absolute h-full border-l-2 border-white/70">
                              <div class="flex w-full flex-col">
                                <a href="{{ route('logs') }}" class="flex min-h-[48px] w-full cursor-pointer items-center justify-start gap-5 rounded-lg px-5 hover:font-bold hover:text-white text-white/70">
                                  <span class="select-none truncate text-regular">Logs</span>
                                  <div class="rounded-[4px] bg-[#F30168] py-[0.5px] px-1 text-[10px] text-white" style="display: none;">Novo</div>
                                </a>
                              </div>
                            </div>

                            <script>
                              document.getElementById('configToggle').addEventListener('click', function() {
                                // Seleciona todos os elementos com a classe "ordersContent"
                                var configContent = document.querySelectorAll(".configContent");
                                var toggleIcon = document.getElementById('configIcon');
                                
                                // Verifica o estado do primeiro elemento como referência
                                var isHidden = configContent[0].style.display === 'none' || configContent[0].style.display === '';
                            
                                // Percorre todos os elementos e ajusta a exibição
                                configContent.forEach(function(element) {
                                  element.style.display = isHidden ? 'flex' : 'none';
                                });
                                
                                // Altera o ícone conforme o estado
                                if (isHidden) {
                                  toggleIcon.classList.remove('fa-chevron-down');
                                  toggleIcon.classList.add('fa-chevron-up');
                                } else {
                                  toggleIcon.classList.remove('fa-chevron-up');
                                  toggleIcon.classList.add('fa-chevron-down');
                                }
                              });
                            </script>
                    
                            <!-- Demais itens... -->
                        </div>
                    </nav>
                </aside>

                <!-- Page Content -->
                <main class="relative ml-80 flex h-full min-h-max w-full flex-col gap-4 pr-4 transition-[padding] ease-in-out max-xl:pl-4">
                  <div 
                  x-show="open"
                  x-transition:enter="transition ease-out duration-300 transform"
                  x-transition:enter-start="opacity-0 scale-95"
                  x-transition:enter-end="opacity-100 scale-100"
                  x-transition:leave="transition ease-in duration-200 transform"
                  x-transition:leave-start="opacity-100 scale-100"
                  x-transition:leave-end="opacity-0 scale-95"
                  class="fixed inset-0 bg-black bg-opacity-50 z-40 flex justify-center items-center"
              >
                  <!-- Modal Container -->
                  <form method="POST" action="{{ route('create.checkout.store') }}" class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg overflow-hidden">
                    @csrf
                      <!-- Modal Header -->
                      <div class="bg-primary text-white py-4 px-6 flex justify-between items-center">
                          <span class="text-lg text-gray-700 font-semibold">ADICIONAR NOVA LOJA</span>
                          <button @click="open = false" class="text-gray-600 hover:text-gray-400">
                              <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                              </svg>
                          </button>
                      </div>
              
                      <!-- Modal Body -->
                      <div class="p-6 space-y-4">
                          <div class="text-sm text-gray-700">
                              <div class="font-semibold">{{ auth()->user()->name }}</div>
                              <div class="text-xs">{{ auth()->user()->email }}</div>
                          </div>
              
                          <hr class="my-4 border-gray-200 opacity-40">
              
                          <div class="font-semibold text-gray-800">Dados da sua loja</div>
                          <div class="text-sm text-gray-600">Nome da loja</div>
                          <div class="flex flex-col gap-3">
                              <input 
                                  type="text" 
                                  placeholder="Ex.: Loja Eletros"
                                  class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary transition-all"
                                  min="-Infinity" 
                                  max="Infinity"
                                  name="name"
                              >
                              <small class="text-xs text-gray-500">Esse será o nome enviado nos e-mails da sua loja</small>
                          </div>
              
                          <hr class="my-4 border-gray-200 opacity-40">
              
                          <div class="flex items-center gap-3">
                              <label class="flex items-center justify-center cursor-pointer bg-gray-100 border rounded-full w-5 h-5">
                                  <input type="checkbox" class="text-highlighted outline-none focus:outline-none">
                              </label>
                              <div class="text-sm text-gray-700">
                                  Ao concluir com seu cadastro, você concorda com nossos 
                                  <a href="#" class="underline text-primary hover:text-highlighted">termos de uso</a> e 
                                  <a href="#" class="underline text-primary hover:text-highlighted">políticas de privacidade</a>.
                              </div>
                          </div>
                      </div>
              
                      <!-- Modal Footer -->
                      <div class="flex justify-end space-x-4 p-4">
                          <button 
                              @click="open = false" 
                              class="text-sm text-gray-700 py-2 px-4 rounded-md border border-gray-300 hover:bg-gray-100 focus:outline-none transition"
                          >
                              Cancelar
                          </button>
                          <button 
                              type="submit" 
                              class="text-sm text-white bg-[#ff0071] py-2 px-4 rounded-md focus:outline-none transition"
                          >
                              Salvar
                          </button>
                      </div>
                  </div>
                </form>              
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>