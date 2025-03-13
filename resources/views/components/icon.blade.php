@props(['name', 'class' => '', 'size' => '6', 'color' => 'currentColor'])

<svg class="h-{{ $size }} w-{{ $size }} {{ $class }}" xmlns="http://www.w3.org/2000/svg" fill="{{ $color }}" viewBox="0 0 20 20" aria-hidden="true">
    <use xlink:href="#{{ $name }}"></use>
</svg>
