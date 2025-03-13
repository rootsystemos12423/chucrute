@props([
    'id' => null, // ID do select
    'name' => null, // Nome do select
    'options' => [], // Opções do select (array de ['value' => '', 'label' => ''])
    'selected' => null, // Valor selecionado
    'placeholder' => 'Selecione uma opção', // Placeholder
    'prefixIcon' => false, // Exibir ícone de prefixo (ponto verde)
    'prefixIconColor' => 'bg-green-500', // Cor do ícone de prefixo
])

<div class="flex flex-col items-start justify-start gap-2 w-full">
    <div class="el-select el-select--large w-full text-primary relative">
        <!-- Container do Select -->
        <div class="el-select__wrapper p-2 flex items-center w-full rounded-md border border-gray-300 bg-white cursor-pointer">
            <!-- Ícone de Prefixo (Ponto Verde ou Vermelho) -->
            @if ($selected)
                @php
                    // Encontra a opção selecionada no array de opções
                    $selectedOption = collect($options)->firstWhere('value', $selected);

                    // Define se a opção selecionada é "ativo"
                    $isAtivo = $selectedOption && $selectedOption['value'] === 'active';
                @endphp
                <div class="el-select__prefix flex items-center mr-3">
                    <div class="relative w-5 h-5 flex items-center justify-center">
                        <!-- Círculo maior com opacidade -->
                        <div class="absolute inset-0 w-5 h-5 rounded-full {{ $isAtivo ? 'bg-green-600 bg-opacity-40' : 'bg-red-600 bg-opacity-40' }}"></div>
                        <!-- Círculo sólido menor -->
                        <div class="absolute inset-0 w-3 h-3 m-auto rounded-full {{ $isAtivo ? 'bg-green-600' : 'bg-red-600' }}"></div>
                    </div>
                </div>
            @endif

            <!-- Texto Selecionado ou Placeholder -->
            <div class="el-select__selection flex-grow">
                <div class="el-select__selected-item">
                    <span class="text-gray-700">
                        {{ $selectedOption ? $selectedOption['label'] : $placeholder }}
                    </span>
                </div>
            </div>

            <!-- Ícone de Sufixo (Seta para Baixo) -->
            <div class="el-select__suffix flex items-center ml-3">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>

        <!-- Dropdown de Opções (Aberto ao clicar) -->
        <div class="el-select__dropdown hidden absolute w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10">
            @foreach ($options as $option)
                <div
                    class="el-select__option px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer flex items-center space-x-2"
                    data-value="{{ $option['value'] }}"
                >
                    <div class="relative w-5 h-5 flex items-center justify-center">
                        <!-- Círculo maior com opacidade -->
                        <div class="absolute inset-0 w-5 h-5 rounded-full {{ $option['value'] === 'active' ? 'bg-green-600 bg-opacity-40' : 'bg-red-600 bg-opacity-40' }}"></div>
                        <!-- Círculo sólido menor -->
                        <div class="absolute inset-0 w-3 h-3 m-auto rounded-full {{ $option['value'] === 'active' ? 'bg-green-600' : 'bg-red-600' }}"></div>
                    </div>
                    <span>{{ $option['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Script para Abrir/Fechar o Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectWrapper = document.querySelector('.el-select__wrapper');
        const dropdown = document.querySelector('.el-select__dropdown');

        selectWrapper.addEventListener('click', function () {
            dropdown.classList.toggle('hidden');
        });

        // Fechar o dropdown ao clicar fora
        document.addEventListener('click', function (event) {
            if (!selectWrapper.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Selecionar uma opção
        dropdown.querySelectorAll('.el-select__option').forEach(option => {
            option.addEventListener('click', function () {
                const selectedValue = this.getAttribute('data-value');
                const selectedLabel = this.querySelector('span').textContent;

                // Atualizar o texto exibido
                selectWrapper.querySelector('.el-select__selected-item span').textContent = selectedLabel;

                // Atualizar o ícone de prefixo
                const prefixIcon = selectWrapper.querySelector('.el-select__prefix');
                if (prefixIcon) {
                    const isAtivo = selectedValue === 'active';
                    prefixIcon.querySelector('.w-3.h-3').classList.toggle('bg-green-600', isAtivo);
                    prefixIcon.querySelector('.w-3.h-3').classList.toggle('bg-red-600', !isAtivo);
                    prefixIcon.querySelector('.w-5.h-5').classList.toggle('bg-green-600', isAtivo);
                    prefixIcon.querySelector('.w-5.h-5').classList.toggle('bg-red-600', !isAtivo);
                }

                // Fechar o dropdown
                dropdown.classList.add('hidden');

                // Disparar evento personalizado (opcional)
                const event = new CustomEvent('select-change', {
                    detail: { value: selectedValue, label: selectedLabel }
                });
                selectWrapper.dispatchEvent(event);
            });
        });
    });
</script>