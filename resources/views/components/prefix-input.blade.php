@props([
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'prefix' => null,
    'suffix' => null,
    'class' => '',
    'xModel' => '', // Passar xModel como propriedade
    'xData' => '', // Passar xData como propriedade
    'value' => '',
])

<div class="flex items-center w-full border border-gray-300 rounded-md bg-white overflow-hidden" 
    x-data="{{ $xData ?? '{}' }}">
    
    <!-- Prefixo -->
    @if ($prefix)
        <span class="px-4 py-2 text-gray-600 bg-gray-100 border-r border-gray-300">
            {!! $prefix !!}
        </span>
    @endif

    <!-- Campo de entrada -->
    <input 
        type="{{ $type ?? 'text' }}" 
        name="{{ $name ?? '' }}" 
        id="{{ $id ?? '' }}" 
        value="{{ old($name, $value ?? '') }}" 
        placeholder="{{ $placeholder ?? '' }}" 
        class="w-full px-4 py-2 text-gray-900 bg-white border-none focus:outline-none focus:ring-0 focus:border-blue-500 text-sm"
        style="-moz-appearance: textfield; appearance: textfield;"
        x-bind:value="{{ $value ?? '' }}" 
        x-model="{{ $xModel }}"
    >

    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>

    <!-- Sufixo -->
    @if ($suffix)
        <span class="px-4 py-2 text-gray-600 bg-gray-100 border-l border-gray-300">
            {!! $suffix !!}
        </span>
    @endif
</div>
