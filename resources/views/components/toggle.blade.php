@props([
    'label' => '', // Rótulo do toggle
    'id' => null, // ID único para o input
    'checked' => false, // Estado inicial (true/false)
    'wireModel' => null, // Suporte para Livewire (wire:model)
    'disabled' => false, // Desabilitar o toggle
    'onColor' => 'bg-green-500', // Cor quando ativo
    'offColor' => 'bg-gray-300', // Cor quando inativo
    'circleColor' => 'bg-white', // Cor do círculo
])

<div class="flex items-center space-x-3">
    <!-- Label do Toggle -->
    @if ($label)
        <label for="{{ $id }}" class="text-regular text-primary cursor-pointer">
            {{ $label }}
        </label>
    @endif

    <!-- Container do Toggle -->
    <div class="relative inline-block w-14 h-8 cursor-pointer">
      <!-- Input Checkbox -->
      <input
          type="checkbox"
          id="{{ $id }}"
          {{ $attributes->merge(['class' => 'toggle-checkbox absolute inset-0 w-full h-full opacity-0 cursor-pointer']) }}
          {{ $checked ? 'checked' : '' }}
          {{ $disabled ? 'disabled' : '' }}
          @if ($wireModel) wire:model="{{ $wireModel }}" @endif
      />
  
      <!-- Fundo do Toggle -->
      <label for="{{ $id }}" class="toggle-label block w-full h-full rounded-full transition-all duration-300 ease-in-out {{ $offColor }}"></label>
  
      <!-- Círculo do Toggle -->
      <label for="{{ $id }}" class="toggle-circle absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/4 w-6 h-6 rounded-full transition-all duration-300 ease-in-out {{ $circleColor }}"></label>
  </div>
</div>

<!-- Estilos Personalizados -->
<style>
    .toggle-checkbox:checked + .toggle-label {
        background-color: #ff0071;
    }

    .toggle-checkbox:checked + .toggle-label + .toggle-circle {
        transform: translateX(50%) translateY(-25%);
    }
</style>