<x-app-layout>
    <form method="POST" action="{{ route('builder.store.personalization') }}" enctype="multipart/form-data">
        @csrf
      <div x-data="{ activeTab: 'cabecalho' }" class="max-w-[1200px] mx-auto mt-6">
          <h2 class="text-xl text-gray-900">Personalizar</h2>
          
          <div class="relative mt-4">
            <ul class="flex">
                <li class="mr-6">
                    <a href="#" 
                       @click.prevent="activeTab = 'cabecalho'"
                       :class="activeTab === 'cabecalho' ? 'text-[#ff0071] bg-[#ff0071]/5' : 'text-gray-600 hover:text-[#ff0071]'"
                       class="inline-block px-5 py-2 rounded-md">
                        Cabeçalho
                    </a>
                </li>
                <li class="mr-6">
                    <a href="#" 
                       @click.prevent="activeTab = 'rodape'"
                       :class="activeTab === 'rodape' ? 'text-[#ff0071] bg-[#ff0071]/5' : 'text-gray-600 hover:text-[#ff0071]'"
                       class="inline-block px-4 py-2 rounded-md">
                        Rodapé
                    </a>
                </li>
                <li class="mr-6">
                    <a href="#" 
                       @click.prevent="activeTab = 'resumo'"
                       :class="activeTab === 'resumo' ? 'text-[#ff0071] bg-[#ff0071]/5' : 'text-gray-600 hover:text-[#ff0071]'"
                       class="inline-block px-4 py-2 rounded-md">
                        Resumo
                    </a>
                </li>
                <li class="mr-6">
                    <a href="#" 
                       @click.prevent="activeTab = 'aparencia'"
                       :class="activeTab === 'aparencia' ? 'text-[#ff0071] bg-[#ff0071]/5' : 'text-gray-600 hover:text-[#ff0071]'"
                       class="inline-block px-4 py-2 rounded-md">
                        Aparência
                    </a>
                </li>
                <li>
                    <a href="#" 
                       @click.prevent="activeTab = 'orderbump'"
                       :class="activeTab === 'orderbump' ? 'text-[#ff0071] bg-[#ff0071]/5' : 'text-gray-600 hover:text-[#ff0071]'"
                       class="inline-block px-4 py-2 rounded-md">
                        Order bump
                    </a>
                </li>
            </ul>
              <hr class="mt-4 border-gray-300">
          </div>

          <div class="flex flex-col p-6">

            <!-- CABEÇALHO -->
            <div x-show="activeTab === 'cabecalho'" class="max-w-4xl mx-auto mt-6 flex justify-around gap-8">
                <!-- Seção da Esquerda -->
                <div class="w-1/3">
                    <h2 class="text-lg font-semibold text-gray-900">Cabeçalho</h2>
                    <p class="text-gray-600 mt-1">Personalize a aparência e informações do topo do seu checkout.</p>
                </div>
        
                <div class="flex flex-col w-full">
                    <div class="w-full bg-white p-6 rounded-lg border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Cores</h3>
                            <button class="text-highlighted font-medium hover:underline">Resetar cor padrão</button>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
    
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do cabeçalho</label>
                            <div class="flex items-center mt-1">
                                <input name="cabecalho_cor_cabecalho" type="color" value="{{ $customizations['cabecalho_cor_cabecalho'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['cabecalho_cor_cabecalho'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
            
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor dos elementos</label>
                            <div class="flex items-center mt-1">
                                <input name="cabecalho_cor_elementos" type="color" value="{{ $customizations['cabecalho_cor_elementos'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['cabecalho_cor_elementos'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
            
                        <p class="text-gray-500 text-sm mt-4">
                            Recomendamos usar cores que apresentam um maior contraste para não prejudicar a visualização dos elementos no cabeçalho.
                        </p>
                    </div>
    
                    <div class="w-full bg-white p-6 rounded-lg border mt-4">
                        <h3 class="text-lg font-semibold text-gray-900">Configurações</h3>
                        <hr class="mt-4 border-gray-300 w-full">

                        <div class="mt-6">
                            <label class="text-xs font-medium text-gray-900 uppercase">LOGOTIPO</label>
                            <label for="logo-upload" id="logo-label" class="mt-2 border-dashed border-2 border-gray-300 rounded-md p-4 text-center cursor-pointer block">
                                <input name="cabecalho_logo_file" id="logo-upload" type="file" class="hidden" accept="image/*">
                                <div id="logo-preview">
                                    @if(!empty($customizations['cabecalho_logo_path']))
                                        <img src="{{ asset($customizations['cabecalho_logo_path']) }}" alt="Logo Atual" class="max-h-24 mx-auto mb-2 rounded-md">
                                        <p class="text-gray-700 text-sm">Logotipo Atual</p>
                                    @else
                                        <span class="text-gray-500 text-sm">
                                            Arraste a imagem ou <span class="text-highlighted font-medium hover:underline">clique aqui</span>
                                        </span>
                                    @endif
                                </div>
                            </label>
                        
                            <script>
                                document.getElementById('logo-upload').addEventListener('change', function(event) {
                                    let file = event.target.files[0]; // Obtém o arquivo carregado
                                    let preview = document.getElementById('logo-preview');
                        
                                    if (file) {
                                        let reader = new FileReader();
                                        reader.onload = function(e) {
                                            preview.innerHTML = `
                                                <img src="${e.target.result}" alt="Logo Preview" class="max-h-24 mx-auto mb-2 rounded-md">
                                                <p class="text-gray-700 text-sm">${file.name}</p>
                                            `;
                                        };
                                        reader.readAsDataURL(file);
                                    } else {
                                        preview.innerHTML = `
                                            <span class="text-gray-500 text-sm">
                                                Arraste a imagem ou <span class="text-highlighted font-medium hover:underline">clique aqui</span>
                                            </span>
                                        `;
                                    }
                                });
                            </script>
                        
                            <p class="text-gray-500 text-xs mt-2">
                                Aceitamos os formatos <span class="font-medium">.jpg</span> e <span class="font-medium">.png</span> com menos de <span class="font-medium">500kb</span><br>
                                Sugestão de tamanho: <span class="font-medium">300 px x 90 px</span>
                            </p>
                        </div>                                             
                    
                        <div class="mt-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="cabecalho_product_logo" 
                                       class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500"
                                       value="1" {{ !empty($customizations['cabecalho_product_logo']) && $customizations['cabecalho_product_logo'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-900 text-sm">Usar logotipo da marca dos produtos.</span>
                            </label>
                        </div>                        
                    
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">Posicionamento</label>
                            <select name="cabecalho_logo_position" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="Esquerda" {{ $customizations['cabecalho_logo_position'] == 'Esquerda' ? 'selected' : '' }}>Esquerda</option>
                                <option value="Centro" {{ $customizations['cabecalho_logo_position'] == 'Centro' ? 'selected' : '' }}>Centro</option>
                                <option value="Direita" {{ $customizations['cabecalho_logo_position'] == 'Direita' ? 'selected' : '' }}>Direita</option>
                            </select>
                        </div>                        
                    </div>
                    
                    

                    <div class="w-full bg-white p-6 rounded-lg border mt-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Barra de anúncio / Cronômetro</h3>
                            <button class="text-highlighted font-medium hover:underline">Resetar cor padrão</button>
                        </div>
                        
                        <hr class="mt-4 border-gray-300 w-full">

                        <div class="mt-6">
                            <p class="text-gray-800 text-sm pt-3 pb-3">
                                A barra de anúncio ficará fixa abaixo do cabeçalho. <br>
                                Caso não tenha um texto na barra de anúncio ou o cronômetro esteja zerado, <br>
                                a barra não aparecerá.
                            </p>
                        </div>   
                        
                        <div class="mt-4">
                            <label class="flex flex-col space-y-2">
                                <span class="text-xs font-medium text-gray-900 uppercase">Editor de Texto</span>
                                <div id="quill-editor" class="border border-gray-300 rounded-md min-h-[150px]"></div>
                            </label>
                            <input type="hidden" id="quill-content" name="cabecalho_anuncio_text" value="">
                        </div>
                        
                        <!-- QuillJS CDN -->
                        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
                        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                        
                        <script>
                            var quill = new Quill('#quill-editor', {
                                theme: 'snow',
                                placeholder: 'Escreva aqui...',
                                modules: {
                                    toolbar: [
                                        ['bold', 'italic', 'underline'] // Apenas Negrito, Itálico e Sublinhado
                                    ]
                                }
                            });
                        
                            // Atualize o campo oculto sempre que o conteúdo do editor mudar
                            quill.on('text-change', function(delta, oldDelta, source) {
                                var hiddenField = document.getElementById('quill-content');
                                // Atualiza o valor do campo oculto com o conteúdo em formato Delta ou HTML
                                hiddenField.value = JSON.stringify(quill.getContents()); // Para Delta
                            });
                        </script>                                                                  
                    
                        <div class="mt-4">
                            <label class="flex flex-col space-y-2">
                                <span class="text-xs font-medium text-gray-900 uppercase">Texto do cronômetro</span>
                                <input name="cabecalho_cronometro_text" class="p-3 border-gray-300 w-full rounded-md" value="Oferta termina em" type="text" name="cronometro_text" id="cronometro_text">
                                <span class="text-[9px] font-medium text-gray-500 uppercase">Máximo de 50 caracteres</span>
                            </label>
                        </div>
                    
                        <div class="mt-4">
                            <label class="flex flex-col space-y-2">
                                <span class="text-xs font-medium text-gray-900 uppercase">Tempo do cronômetro</span>
                                <div class="flex gap-2 items-center">
                                    <div class="flex items-center space-x-2 border border-gray-300 rounded-md w-fit bg-white">
                                        <button class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-300 rounded-md">-</button>
                                        <input name="cabecalho_cronometro_time" type="number" value="{{ $customizations['cabecalho_cronometro_time'] }}" 
                                            class="w-16 text-center border-none focus:ring-0 outline-none appearance-none [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <button class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-300 rounded-md">+</button>
                                    </div>   
                                    <span>minutos.</span>
                                </div>                                                          
                                <span class="text-[9px] font-medium text-gray-500 uppercase">Deixe 0 (zero) caso não queira utilizar o cronômetro.</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor da barra</label>
                            <div class="flex items-center mt-1">
                                <input name="cabecalho_bar_color" type="color" value="{{ $customizations['cabecalho_bar_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['cabecalho_bar_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do texto</label>
                            <div class="flex items-center mt-1">
                                <input name="cabecalho_text_color" type="color" value="{{ $customizations['cabecalho_text_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['cabecalho_text_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do cronômetro</label>
                            <div class="flex items-center mt-1">
                                <input name="cabecalho_cronometro_color" type="color" value="{{ $customizations['cabecalho_cronometro_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['cabecalho_cronometro_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                    </div> 
                </div>
            </div> <!-- FIM CABEÇALHO -->



             <!-- Rodapé -->
             <div x-show="activeTab === 'rodape'" class="max-w-4xl mx-auto mt-6 flex justify-around gap-8">
                <!-- Seção da Esquerda -->
                <div class="w-1/3">
                    <h2 class="text-lg font-semibold text-gray-900">Rodapé</h2>
                    <p class="text-gray-600 mt-1">Personalize a aparência e informações do rodapé do seu checkout.</p>
                </div>
        
                <div class="flex flex-col w-full">
                    <div class="w-full bg-white p-6 rounded-lg border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Cores</h3>
                            <button class="text-highlighted font-medium hover:underline">Resetar cor padrão</button>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
    
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do rodapé</label>
                            <div class="flex items-center mt-1">
                                <input name="rodape_cor_rodape" type="color" value="{{ $customizations['rodape_cor_rodape'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['rodape_cor_rodape'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
            
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do texto</label>
                            <div class="flex items-center mt-1">
                                <input name="rodape_cor_text" type="color" value="{{ $customizations['rodape_cor_text'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['rodape_cor_text'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                    </div>
    
                    <div class="w-full bg-white p-6 rounded-lg border mt-4">
                        <h3 class="text-lg font-semibold text-gray-900">Atendimento</h3>
                        <hr class="mt-4 border-gray-300 w-full">

                                 
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">Exibir atendimento?</label>
                            <select name="rodape_atendimento" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="0" {{ $customizations['rodape_atendimento'] == '0' ? 'selected' : '' }}>Não</option>
                                <option value="1" {{ $customizations['rodape_atendimento'] == '1' ? 'selected' : '' }}>Sim</option>
                            </select>
                        </div>                                         
                
                    </div>
                    

                    <div class="w-full bg-white p-6 rounded-lg border mt-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Barra de anúncio / Cronômetro</h3>
                            <button class="text-highlighted font-medium hover:underline">Resetar cor padrão</button>
                        </div>
                        
                        <hr class="mt-4 border-gray-300 w-full">

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">Posicionamento no celular</label>
                            <select name="rodape_position_mobile" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="left" {{ $customizations['rodape_position_mobile'] == 'left' ? 'selected' : '' }}>Esquerda</option>
                                <option value="center" {{ $customizations['rodape_position_mobile'] == 'center' ? 'selected' : '' }}>Centralizado</option>
                            </select>
                        </div>                         

                        <div class="mt-4 space-y-3">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="rodape_show_payment_icon" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                       value="1" {{ !empty($customizations['rodape_show_payment_icon']) && $customizations['rodape_show_payment_icon'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-700">Mostrar ícones das opções de pagamento</span>
                            </label>
                        
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="rodape_show_security_badge" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                       value="1" {{ !empty($customizations['rodape_show_security_badge']) && $customizations['rodape_show_security_badge'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-700">Mostrar selo de segurança</span>
                            </label>
                        
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="rodape_show_store_name" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                       value="1" {{ !empty($customizations['rodape_show_store_name']) && $customizations['rodape_show_store_name'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-700">Mostrar o nome da loja</span>
                            </label>
                        
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="rodape_show_site_adress" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                       value="1" {{ !empty($customizations['rodape_show_site_adress']) && $customizations['rodape_show_site_adress'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-700">Mostrar o endereço do site</span>
                            </label>
                        
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="rodape_show_business_adress" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                       value="1" {{ !empty($customizations['rodape_show_business_adress']) && $customizations['rodape_show_business_adress'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-700">Mostrar o endereço da loja</span>
                            </label>
                        
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="rodape_show_cnpj_details" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                       value="1" {{ !empty($customizations['rodape_show_cnpj_details']) && $customizations['rodape_show_cnpj_details'] == '1' ? 'checked' : '' }}>
                                <span class="text-gray-700">Mostrar razão social e CNPJ ou nome completo e CPF</span>
                            </label>

                            <label class="flex flex-col space-y-2">
                                <span class="text-xs font-medium text-gray-900 uppercase">CNPJ Do Rodapé</span>
                                <input name="rodape_cnpj" class="p-3 border-gray-300 w-full rounded-md" placeholder="00.000.000/0001-00" type="text" id="cronometro_text">
                                <span class="text-[9px] font-medium text-gray-500 uppercase">Esse Cnpj irá aparecer no rodapé do checkout</span>
                            </label>

                            <label class="flex flex-col space-y-2">
                                <span class="text-xs font-medium text-gray-900 uppercase">Razão Social Do Rodapé</span>
                                <input name="rodape_razao_social" class="p-3 border-gray-300 w-full rounded-md" placeholder="Loja Online Ltda" type="text" id="cronometro_text">
                                <span class="text-[9px] font-medium text-gray-500 uppercase">Essa Razão irá aparecer no rodapé do checkout</span>
                            </label>
                            
                        </div>                        
                    </div> 
                    <span class="p-3 text-xs text-gray-500">Segundo o Decreto Federal 7.962/13 - Lei do Ecommerce, as informações de endereço da loja, razão social, CNPJ, telefone e e-mail e as formas de pagamento devem estar visíveis em sua loja.</span>
                </div>
            </div> <!-- FIM Rodapé -->


            <!-- Resumo -->
            <div x-show="activeTab === 'resumo'" class="max-w-4xl mx-auto mt-6 flex justify-around gap-8">
                <!-- Seção da Esquerda -->
                <div class="w-1/3">
                    <h2 class="text-lg font-semibold text-gray-900">Resumo</h2>
                    <p class="text-gray-600 mt-1">Personalize a aparência e informações do resumo do seu checkout.</p>
                </div>
        
                <div class="flex flex-col w-full">
                    <div class="w-full bg-white p-6 rounded-lg border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Resumo de compra no celular</h3>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">O resumo de compras deve ser:</label>
                            <select name="resume_cart_show" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="always_open" {{ $customizations['resume_cart_show'] == 'always_open' ? 'selected' : '' }}>Sempre Aberto</option>
                                <option value="always_close" {{ $customizations['resume_cart_show'] == 'always_close' ? 'selected' : '' }}>Sempre Fechado</option>
                                <option value="open_if_only_1" {{ $customizations['resume_cart_show'] == 'open_if_only_1' ? 'selected' : '' }}>Aberto apenas se tiver 1 item</option>
                            </select>
                        </div>                         
                    </div>
    
                    <div class="w-full bg-white p-6 rounded-lg border mt-4">
                        <h3 class="text-lg font-semibold text-gray-900">Configurações</h3>
                        <hr class="mt-4 border-gray-300 w-full">

                                 
                        <div class="mt-4">
                            <div class="mt-4 space-y-3">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input name="resume_show_cupom_section" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                           value="1" {{ !empty($customizations['resume_show_cupom_section']) && $customizations['resume_show_cupom_section'] == '1' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Exibir campo de cupom de desconto</span>
                                </label>
                        
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input name="resume_allow_qtd_changes" type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]"
                                           value="1" {{ !empty($customizations['resume_allow_qtd_changes']) && $customizations['resume_allow_qtd_changes'] == '1' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Permitir mudança de quantidade dos itens</span>
                                </label>
                            </div>
                        </div>                                     
                
                    </div>
                    

                    <div class="w-full bg-white p-6 rounded-lg border mt-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Observação da compra</h3>
                        </div>
                        
                        <hr class="mt-4 border-gray-300 w-full">

                        <div class="mt-4 space-y-3">
                            <span class="text-sm text-gray-800">Adicione um campo no Checkout para que seus clientes escrevam observações sobre a compra.</span>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="resume_allow_observation_input" {{ !empty($customizations['resume_allow_observation_input']) && $customizations['resume_allow_observation_input'] == '1' ? 'checked' : '' }} type="checkbox" class="form-checkbox text-[#ff0071] focus:ring-[#ff0071]">
                                <span class="text-gray-700">Exibir campo de observação da compra</span>
                            </label>
                        </div>
                    </div> 
                </div>
            </div> <!-- FIM Resumo -->

             <!-- Aparência -->
             <div x-show="activeTab === 'aparencia'" class="max-w-4xl mx-auto mt-6 flex justify-around gap-8">
                <!-- Seção da Esquerda -->
                <div class="w-1/3">
                    <h2 class="text-lg font-semibold text-gray-900">Aparência</h2>
                    <p class="text-gray-600 mt-1">Personalize a aparência do seu checkout.</p>
                </div>
        
                <div class="flex flex-col w-full">
                    <div class="w-full bg-white p-6 rounded-lg border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Cores</h3>
                            <button class="text-highlighted font-medium hover:underline">Resetar cor padrão</button>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Geral</h3>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor dos títulos</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_title_color" type="color" value="{{ $customizations['appearance_title_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_title_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor das descrições</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_description_color" type="color" value="{{ $customizations['appearance_description_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_description_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor da etapa de compra ativa <span class="text-gray-400">(computador)</span></label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_steps_color" type="color" value="{{ $customizations['appearance_steps_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_steps_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do valor total</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_totalvalue_color" type="color" value="{{ $customizations['appearance_totalvalue_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_totalvalue_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <hr class="mt-4 border-gray-300 w-full">

                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Tag de etapas</h3>
                                 
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor Da Tag</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_tag_color" type="color" value="{{ $customizations['appearance_tag_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_tag_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div> 
                        
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do número</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_number_color" type="color" value="{{ $customizations['appearance_number_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_number_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>    
                
        
                        <hr class="mt-4 border-gray-300 w-full">
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Tag de desconto</h3>

                                 
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor Da Tag</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_tag_color_second" type="color" value="{{ $customizations['appearance_tag_color_second'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_tag_color_second'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div> 
                        
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do número</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_number_color_second" type="color" value="{{ $customizations['appearance_number_color_second'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_number_color_second'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>    

                        <hr class="mt-4 border-gray-300 w-full">
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Barra de progresso <span class="font-normal">(celular)</span></h3>

                                 
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor da barra de progresso</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_progress_bar_color" type="color" value="{{ $customizations['appearance_progress_bar_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_progress_bar_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div> 
                        
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do número</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_number_color_third" type="color" value="{{ $customizations['appearance_number_color_third'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_number_color_third'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>  

                    </div>

                    <div class="w-full bg-white p-6 rounded-lg mt-4 border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Botão</h3>
                            <button class="text-highlighted font-medium hover:underline">Resetar cor padrão</button>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Botão primário</h3>
                        <span class="text-sm text-gray-600">Os botões primários são aqueles em que o cliente caminha de um bloco para o outro, por exemplo, quando ele confirma seus dados pessoais e vai para a parte de preenchimento dos dados de endereço.</span>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do botão</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_button_color" type="color" value="{{ $customizations['appearance_button_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_button_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do texto</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_text_color" type="color" value="{{ $customizations['appearance_text_color'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_text_color'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>


                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Botão secundário</h3>
                        <span class="text-sm text-gray-600">Os botões secundários são aqueles em que o consumidor realiza ações dentro do bloco em que ele está, como por exemplo, no formulário de CEP quando o cliente clica no botão de calcular frete.</span>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do botão</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_button_color_second"  type="color" value="{{ $customizations['appearance_button_color_second'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_button_color_second'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do texto</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_text_color_second" type="color" value="{{ $customizations['appearance_text_color_second'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_text_color_second'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>
                
        
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Botão terciário</h3>
                        <span class="text-sm text-gray-600">Os botões terciários, são links de ações menos prioritárias no Checkout, como o botão de remover no formulário de Cupom de Desconto.</span>

                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do texto</label>
                            <div class="flex items-center mt-1">
                              <input type="color" name="appearance_text_color_third" value="{{ $customizations['appearance_text_color_third'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_text_color_third'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>


                        <hr class="mt-4 border-gray-300 w-full">
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Barra de progresso <span class="font-normal">(celular)</span></h3>

                                 
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor Da Tag</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_tag_color_third" type="color" value="{{ $customizations['appearance_tag_color_third'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_tag_color_third'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div> 
                        
                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-medium">Cor do número</label>
                            <div class="flex items-center mt-1">
                                <input name="appearance_number_color_fourth" type="color" value="{{ $customizations['appearance_number_color_fourth'] }}" class="w-12 h-12 rounded-md cursor-pointer">
                                <input type="text" value="{{ $customizations['appearance_number_color_fourth'] }}" class="ml-2 w-28 px-2 py-1 text-gray-900 rounded-md focus:ring-2 focus:ring-purple-500">
                            </div>
                        </div>  

                    </div>    
                    
                    <div class="w-full bg-white p-6 rounded-lg mt-4 border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Tipografia</h3>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Títulos</h3>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">Fonte:</label>
                            <select name="appearance_tipografy_primary" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="work_sans" {{ $customizations['appearance_tipografy_primary'] == 'work_sans' ? 'selected' : '' }}>Work Sans</option>
                                <option value="rubik" {{ $customizations['appearance_tipografy_primary'] == 'rubik' ? 'selected' : '' }}>Rubik</option>
                                <option value="montserrat" {{ $customizations['appearance_tipografy_primary'] == 'montserrat' ? 'selected' : '' }}>Montserrat</option>
                                <option value="nunito" {{ $customizations['appearance_tipografy_primary'] == 'nunito' ? 'selected' : '' }}>Nunito</option>
                                <option value="taviraj" {{ $customizations['appearance_tipografy_primary'] == 'taviraj' ? 'selected' : '' }}>Taviraj</option>
                            </select>
                        </div>
                        
                        <div class="mt-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="appearance_use_product_logo" type="checkbox" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                                <span class="text-gray-900 text-sm">Usar logotipo da marca dos produtos.</span>
                            </label>
                        </div>

                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Textos</h3>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">Fonte:</label>
                            <select name="appearance_tipografy_second" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="work_sans" {{ $customizations['appearance_tipografy_second'] == 'work_sans' ? 'selected' : '' }}>Work Sans</option>
                                <option value="rubik" {{ $customizations['appearance_tipografy_second'] == 'rubik' ? 'selected' : '' }}>Rubik</option>
                                <option value="montserrat" {{ $customizations['appearance_tipografy_second'] == 'montserrat' ? 'selected' : '' }}>Montserrat</option>
                                <option value="nunito" {{ $customizations['appearance_tipografy_second'] == 'nunito' ? 'selected' : '' }}>Nunito</option>
                                <option value="taviraj" {{ $customizations['appearance_tipografy_second'] == 'taviraj' ? 'selected' : '' }}>Taviraj</option>
                            </select>
                        </div>
                        
                        
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <h3 class="text-sm font-semibold text-gray-900 mt-4">Botões</h3>
                        <div class="mt-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input name="appearance_button_text_uppercase" type="checkbox" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                                <span class="text-gray-900 text-sm">Letras em caixa alta</span>
                            </label>
                        </div>
                    </div>  

                    <div class="w-full bg-white p-6 rounded-lg mt-4 border">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900">Visual e botões</h3>
                        </div>
            
                        <hr class="mt-4 border-gray-300 w-full">
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-900">Formato:</label>
                            <select name="appearance_formats" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md text-gray-900 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                                <option value="arredondado" {{ $customizations['appearance_formats'] == 'arredondado' ? 'selected' : '' }}>Arredondado</option>
                                <option value="retangular" {{ $customizations['appearance_formats'] == 'retangular' ? 'selected' : '' }}>Retangular</option>
                                <option value="oval" {{ $customizations['appearance_formats'] == 'oval' ? 'selected' : '' }}>Oval</option>
                            </select>
                        </div>                        
                        
                    </div>  



                </div>
            </div> <!-- FIM Aparência -->
            


    <!-- OrderBump -->
    <div x-data="{ 
        bgColor: '{{ $customizations['orderbump_bg_color'] ?? '#ffffd1' }}', 
        borderColor: '{{ $customizations['orderbump_border_color'] ?? '#d0d0d0' }}', 
        buttonColor: '{{ $customizations['orderbump_button_color'] ?? '#000000' }}' 
    }" 
    x-show="activeTab === 'orderbump'" 
    class="max-w-4xl mx-auto mt-6 flex gap-8">

    <!-- Seção de Configuração -->
    <div class="w-2/3 bg-white p-6 rounded-lg shadow-md border">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold">Cores</h2>
            <a href="#" class="text-[#ff0071] font-medium" @click="bgColor = '#ffffd1'; borderColor = '#d0d0d0'; buttonColor = '#000000'">Resetar cor padrão</a>
        </div>

        <!-- Área da Oferta -->
        <div class="mb-6">
            <h3 class="text-sm font-medium text-gray-600">ÁREA DA OFERTA</h3>
            <div class="mt-2 space-y-3">
                <label class="block">
                    <span class="text-gray-500">Cor do fundo</span>
                    <div class="flex items-center mt-1">
                        <input name="orderbump_bg_color" value="{{ $customizations['orderbump_bg_color'] ?? '#ffffd1' }}" type="color" x-model="bgColor" class="w-10 h-10 rounded-md border cursor-pointer">
                        <input type="text" x-model="bgColor" class="ml-2 w-24 p-2 border rounded-md text-gray-700 text-sm">
                    </div>
                </label>

                <label class="block">
                    <span class="text-gray-500">Cor da borda</span>
                    <div class="flex items-center mt-1">
                        <input name="orderbump_border_color" value="{{ $customizations['orderbump_border_color'] ?? '#d0d0d0' }}" type="color" x-model="borderColor" class="w-10 h-10 rounded-md border cursor-pointer">
                        <input type="text" x-model="borderColor" class="ml-2 w-24 p-2 border rounded-md text-gray-700 text-sm">
                    </div>
                </label>
            </div>
        </div>

        <!-- Botão -->
        <div>
            <h3 class="text-sm font-medium text-gray-600">BOTÃO</h3>
            <label class="block mt-2">
                <span class="text-gray-500">Cor do botão</span>
                <div class="flex items-center mt-1">
                    <input name="orderbump_button_color" value="{{ $customizations['orderbump_button_color'] ?? '#000000' }}" type="color" x-model="buttonColor" class="w-10 h-10 rounded-md border cursor-pointer">
                    <input type="text" x-model="buttonColor" class="ml-2 w-24 p-2 border rounded-md text-gray-700 text-sm">
                </div>
            </label>
        </div>
    </div>

    <!-- Prévia do Order Bump -->
    <div class="w-2/3 bg-gray-100 p-5 rounded-lg border border-dashed">
        <p class="text-sm font-medium text-gray-500 mb-3">Prévia do order bump</p>

        <div class="relative w-full overflow-hidden mt-4">
            <div class="p-2 rounded-full text-center w-48 mx-auto mb-4 flex items-center animate-shake" :style="'background-color: ' + bgColor">
                <span class="text-[12px] font-bold text-highlighted">🎉 VOCÊ TEM UMA OFERTA!</span>
            </div>

            <div class="w-full p-4 space-y-3 rounded border-dotted border" :style="'background-color: ' + bgColor + '; border-color: ' + borderColor">
                <div class="flex justify-between items-center gap-4 xl:flex-row flex-col">
                    <img src="https://placehold.co/600x400" class="h-24 w-24 rounded-md object-cover max-sm:h-20 max-sm:w-20">
                    <div class="flex flex-col space-y-2 text-center xl:text-left">
                        <span class="text-xs font-bold text-gray-600 max-w-48">Nome da Oferta</span>
                        <div class="flex gap-1 items-center">
                            <span class="text-xs line-through text-gray-400">R$ 199,90</span>
                            <span class="text-lg font-bold text-highlighted">R$ 149,90</span>
                        </div>
                    </div>
                </div>
                <hr class="border-t-2 border-dotted" :style="'border-color: ' + borderColor">

                <div class="space-y-2 text-gray-600">
                    <h2 class="text-sm font-bold">Título da Oferta</h2>
                    <p class="text-xs">Descrição breve da oferta para incentivar a compra.</p>
                </div>

                <!-- Checkbox clicável -->
                <label for="ofertaImperdivel" class="flex items-center gap-2 text-white text-xs font-bold rounded-lg p-3 sm:p-4 w-full sm:w-auto cursor-pointer hover:opacity-80 transition" :style="'background-color: ' + buttonColor">
                    <input type="checkbox" id="ofertaImperdivel" class="hidden peer" x-model="orderSelected">
                    
                    <div class="w-4 h-4 border-2 border-white rounded-md flex items-center justify-center peer-checked:bg-white peer-checked:border-white">
                        <!-- A diretiva x-show oculta o SVG quando o order não está selecionado -->
                        <svg x-show="orderSelected" class="w-3 h-3 text-pink-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    
                    + Adicionar oferta Imperdível
                </label>                
            </div>
        </div>
    </div>
</div>
<!-- FIM OrderBump -->


          </div>
          
          <div class="mt-4 mb-8">
            <hr class="border-gray-300 w-full">
            <div class="flex justify-end gap-4 mt-4">
                <button class="px-4 py-2 border border-gray-400 text-gray-700 rounded-sm hover:bg-gray-100 transition">
                    Cancelar
                </button>
                <button class="px-4 py-2 bg-[#ff0071] text-white font-medium rounded-sm transition">
                    Salvar
                </button>
            </div>
        </div>
        

      </div>
    </form>
  </x-app-layout>
  
      