@props(['type' => 'button', 'class' => '', 'route' => '', 'icon' => '', 'text' => ''])

<a href="{{ $route ? route($route) : '#' }}" 
   class="btn {{ $class }}" 
   type="{{ $type }}">
    @if($icon)
        <i class="bi bi-{{ $icon }} me-1"></i>
    @endif
    {{ $text }}
</a>
