<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Sora:wght@100..800&display=swap" rel="stylesheet">
     <!-- Scripts -->
     @vite(['resources/css/app.css', 'resources/js/app.js'])

     <!-- Styles -->
     @livewireStyles

</head>
<body class="bg-gray-50 text-white">


      <header class="bg-white shadow-md p-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-gray-700 font-semibold text-xs">
                    <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 15L1 8L8 1" stroke="#292D32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    Sair do construtor
                </a>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="relative">
                    <span class="text-gray-700">Tema</span>
                    <select class="border rounded px-4 w-94 text-md py-2 text-gray-700 focus:outline-none focus:ring">
                        <option>Conversion</option>
                    </select>
                </div>
                
                <div class="flex items-center gap-2">
                    <button class="p-2 rounded border text-gray-700">
                        <svg width="18" height="22" viewBox="0 0 18 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 6V16C17 20 16 21 12 21H6C2 21 1 20 1 16V6C1 2 2 1 6 1H12C16 1 17 2 17 6Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M11 4.5H7" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.99995 18.1C9.85599 18.1 10.55 17.406 10.55 16.55C10.55 15.694 9.85599 15 8.99995 15C8.14391 15 7.44995 15.694 7.44995 16.55C7.44995 17.406 8.14391 18.1 8.99995 18.1Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                    <button class="p-2 rounded border bg-gray-200 text-gray-700">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.44 2H17.55C21.11 2 22 2.89 22 6.44V12.77C22 16.33 21.11 17.21 17.56 17.21H6.44C2.89 17.22 2 16.33 2 12.78V6.44C2 2.89 2.89 2 6.44 2Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M12 17.2202V22.0002" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M2 13H22" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M7.5 22H16.5" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <div>
                <button class="bg-[#ff0071] text-white px-4 py-2 rounded transition">Salvar</button>
            </div>
        </header>        


    <div class="h-screen">
      <main class="flex">
            <aside x-data="{ openSections: {} }"" class="sidebar bg-white shadow-md w-64 min-h-screen border-r-2 border-t-2 border-gray-300">
                  <ul class="space-y-2">   
                      <!-- Item 1: Cabeçalho -->
                      <li x-data="{ index: 0 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Cabeçalho</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="space-y-2">
                                  <li>
                                      <div class="flex flex-col space-y-2">
                                          <span class="text-xs text-gray-600">Logo</span>
                                          <div class="bg-white border border-gray-200 w-full h-20 flex items-center justify-center">
                                              <img class="h-16" src="https://adooreibr.s3.us-east-2.amazonaws.com/images/fa77da57-6fe0-4e9a-9e73-ee8181185e32_1ba4c7efc7ae27896ebcff7a85c14aa4" alt="Logo">
                                          </div>
                                          <p class="text-xs text-gray-500">Aceitamos os formatos .jpg e .png com menos de 500kb.</p>
                                          <p class="text-xs text-gray-500">Sugestão de tamanho: 300px x 90px</p>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="flex flex-col space-y-2">
                                          <span class="text-xs text-gray-600">Alinhamento da logo</span>
                                          <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                              <option>Esquerda</option>
                                              <option>Centro</option>
                                              <option>Direita</option>
                                          </select>
                                      </div>
                                  </li>
                                  <li>
                                      <div class="flex items-center p-2">
                                          <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted mr-2">
                                          <span class="text-xs text-gray-600">Fixar logo no topo</span>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </li>
              
                      <!-- Item 2: Barra de Avisos -->
                      <li x-data="{ index: 1 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Barra de Avisos</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="space-y-2 p-2 mt-2">
                                    <li>
                                          <div class="flex flex-col space-y-2">
                                                <span class="text-xs text-gray-600">Texto do botão de finalizar compra</span>
                                                <div class="flex items-center space-x-2">
                                                    <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                                    <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                                </div>
                                            </div>
                                    </li>
                                    <li>
                                          <div class="flex flex-col space-y-2">
                                                <span class="text-xs text-gray-600">Fundo da barra de avisos</span>
                                                <div class="flex items-center space-x-2">
                                                    <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                                    <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                                </div>
                                            </div>
                                    </li>
                                    <li>
                                          <div class="flex flex-col space-y-2">
                                                <span class="text-xs text-gray-600">Fundo da barra de avisos</span>
                                                <div class="flex items-center space-x-2">
                                                    <input type="textarea" class="border-gray-500 text-gray-400 rounded-md p-4 text-xs w-full outline-gray-300" placeholder="Digite aqui seu texto">
                                                </div>
                                            </div>
                                    </li>
                                </ul>
                          </div>
                      </li>
              
                      <!-- Item 3: Carrinho -->
                      <li x-data="{ index: 2 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Carrinho</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="p-2">
                                  <li>
                                      <div class="flex items-center space-x-2">
                                          <input type="checkbox" class="form-checkbox h-5 w-5 rounded-sm border-gray-300 outline-none text-highlighted">
                                          <span class="text-xs text-gray-600">Exibir cupom de desconto</span>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </li>
              
                      <!-- Item 4: Conteúdo -->
                      <li x-data="{ index: 3 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Conteúdo</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="p-2 space-y-4">
                                    <!-- Visual de inputs e botões -->
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-xs text-gray-600">Visual de inputs e botões</span>
                                            <select class="w-full p-2 border border-gray-300 rounded-sm text-sm text-gray-700">
                                                <option>Arredondado</option>
                                                <option>Retangular</option>
                                                <option>Oval</option>
                                            </select>
                                        </div>
                                    </li>
                                
                                    <!-- Opções de formatos -->
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <label class="flex items-center space-x-2">
                                                <div class="bg-gray-300 rounded-xs h-5 w-5 text-gray-500"></div>
                                                <span class="text-xs text-gray-600">Retangular</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                                <div class="bg-gray-300 rounded-md h-5 w-5 text-gray-500"></div>
                                                <span class="text-xs text-gray-600">Arredondado</span>
                                            </label>
                                            <label class="flex items-center space-x-2">
                                                <div class="bg-gray-300 rounded-lg h-5 w-5 text-gray-500"></div>
                                                <span class="text-xs text-gray-600">Oval</span>
                                            </label>
                                        </div>
                                    </li>
                                
                                    <!-- Checkbox Sombra no card ativo -->
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-gray-500 border-gray-300">
                                            <span class="text-xs text-gray-600">Sombra no card ativo</span>
                                        </div>
                                    </li>
                                
                                    <!-- Texto do botão primário -->
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-xs text-gray-600">Texto do botão primário</span>
                                            <div class="flex items-center space-x-2">
                                                <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                                <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                            </div>
                                        </div>
                                    </li>
                                
                                    <!-- Fundo do botão primário -->
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-xs text-gray-600">Fundo do botão primário</span>
                                            <div class="flex items-center space-x-2">
                                                <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                                <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                            </div>
                                        </div>
                                    </li>
                                
                                    <!-- Checkbox Sombra no botão primário -->
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-gray-500 border-gray-300">
                                            <span class="text-xs text-gray-600">Sombra no botão primário</span>
                                        </div>
                                    </li>
                                
                                    <!-- Checkbox Efeito Pulsar -->
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300" checked>
                                            <span class="text-xs text-gray-600">Efeito Pulsar</span>
                                        </div>
                                    </li>
                                
                                    <!-- Texto do botão de finalizar compra -->
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-xs text-gray-600">Texto do botão de finalizar compra</span>
                                            <div class="flex items-center space-x-2">
                                                <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                                <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                            </div>
                                        </div>
                                    </li>
                                
                                    <!-- Fundo do botão de finalizar compra -->
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-xs text-gray-600">Fundo do botão de finalizar compra</span>
                                            <div class="flex items-center space-x-2">
                                                <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                                <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                            </div>
                                        </div>
                                    </li>
                                
                                    <!-- Checkbox Sombra no botão finalizar compra -->
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-gray-500 border-gray-300">
                                            <span class="text-xs text-gray-600">Sombra no botão finalizar compra</span>
                                        </div>
                                    </li>
                                
                                    <!-- Checkbox Efeito Pulsar -->
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300" checked>
                                            <span class="text-xs text-gray-600">Efeito Pulsar</span>
                                        </div>
                                    </li>
                                </ul>                                
                          </div>
                      </li>
              
                      <!-- Item 5: Rodapé -->
                      <li x-data="{ index: 4 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Rodapé</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="space-y-2">
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-sm">
                                            <span class="text-xs text-gray-600">Exibir nome da loja</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir formas de pagamento</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir CNPJ/CPF</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir e-mail de contato</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir whatsapp</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir endereço</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir política de privacidade</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir trocas e devoluções</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300 rounded-xs">
                                            <span class="text-xs text-gray-600">Exibir termos de uso</span>
                                        </div>
                                    </li>
                                </ul>
                                
                                <!-- Campo de cor do texto -->
                                <div class="mt-4">
                                    <label class="text-xs text-gray-600">Texto</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#666666">
                                        <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#666666">
                                    </div>
                                </div>
                                
                                <!-- Campo de cor do rodapé -->
                                <div class="mt-4">
                                    <label class="text-xs text-gray-600">Fundo do rodapé</label>
                                    <div class="flex items-center space-x-2">
                                        <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#f3f4f8">
                                        <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#f3f4f8">
                                    </div>
                                </div>
                                
                                
                          </div>
                      </li>
              
                      <!-- Item 6: Escassez -->
                      <li x-data="{ index: 5 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Escassez</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="space-y-2">
                                    <div class="mt-4">
                                          <label class="text-xs text-gray-600">Texto tag de desconto</label>
                                          <div class="flex items-center space-x-2">
                                              <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#666666">
                                              <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#666666">
                                          </div>
                                      </div>
                                      <div class="mt-4">
                                          <label class="text-xs text-gray-600">Fundo tag de desconto</label>
                                          <div class="flex items-center space-x-2">
                                              <input type="color" class="h-10 w-10 rounded-md border-none cursor-pointer" value="#666666">
                                              <input type="text" class="border-gray-300 text-gray-400 rounded-md p-2 text-xs w-24" value="#666666">
                                          </div>
                                      </div>
                              </ul>
                          </div>
                      </li>
              
                      <!-- Item 7: Configurações -->
                      <li x-data="{ index: 6 }" class="sidebar-item text-xs p-6 border-b-2 border-gray-300">
                          <div class="flex justify-between items-center cursor-pointer">
                              <span class="text-gray-700 font-medium uppercase">Configurações</span>
                              <button @click="openSections[index] = !openSections[index]"">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>
                          </div>
                          <div x-show="openSections[index]" class="sidebar-submenu mt-2">
                              <ul class="space-y-2">
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-sm text-gray-600">Navegação</span>
                                            <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                                <option>3 etapas</option>
                                                <option>2 etapas</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-sm text-gray-600">Fonte</span>
                                            <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                                <option>Arial</option>
                                                <option>Times New Roman</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-sm text-gray-600">Parcelamento pré-selecionado</span>
                                            <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                                <option>1x</option>
                                                <option>2x</option>
                                                <option>3x</option>
                                                <option>4x</option>
                                                <option>5x</option>
                                                <option>6x</option>
                                                <option>7x</option>
                                                <option>8x</option>
                                                <option>9x</option>
                                                <option>10x</option>
                                                <option>11x</option>
                                                <option>12x</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-sm text-gray-600">Pagamento pré-selecionado</span>
                                            <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                                <option>Pix</option>
                                                <option>Cartão de crédito</option>
                                                <option>Boleto</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-sm text-gray-600">Idioma</span>
                                            <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                                <option>Português</option>
                                                <option>Inglês</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-sm text-gray-600">Moeda</span>
                                            <select class="w-full p-2 border border-gray-200 rounded-md text-sm text-gray-700">
                                                <option>BRL - Real Brasileiro</option>
                                                <option>USD - Dólar Americano</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                          <div class="flex items-center space-x-2">
                                              <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300">
                                              <span class="text-xs text-gray-600">Solicitar data de nascimento</span>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="flex items-center space-x-2">
                                              <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300">
                                              <span class="text-xs text-gray-600">Solicitar sexo</span>
                                          </div>
                                      </li>
                                      <li>
                                          <div class="flex items-center space-x-2">
                                              <input type="checkbox" class="form-checkbox h-4 w-4 text-highlighted border-gray-300">
                                              <span class="text-xs text-gray-600">Desativar endereço</span>
                                          </div>
                                      </li>
                                </ul>
                          </div>
                      </li>
                  </ul>
              </aside>
              <div class="preview--desktop flex-1 mt-4 overflow-y-auto max-w-screen-xl mx-auto bg-white shadow-lg rounded-lg p-6">
                  @yield('checkout')
            </div>                
      </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
