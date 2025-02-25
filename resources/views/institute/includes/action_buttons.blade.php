<div class="btn-group" role="group" aria-label="Button group">
    @foreach ($menuItems as $menuItem)
        @php
            $parameterArray = isset($menuItem['params']) ? $menuItem['params'] : [];
            if (!isset($menuItem['routeName']) || $menuItem['routeName'] == '' || $menuItem['routeName'] == null) {
                $check = false;
            } elseif ($menuItem['routeName'] == 'javascript:void(0)') {
                $check = true;
                $route = 'javascript:void(0)';
            } else {
                $check = true;
                $route = route($menuItem['routeName'], $parameterArray);
            }
            $delete = false;
            $div_id = '';

            if (isset($menuItem['delete']) && isset($menuItem['params'][0]) && $menuItem['delete'] == true) {
                $div_id = 'delete-form-' . $menuItem['params'][0];
                $delete = true;
            }
        @endphp
        @if ($check)
            <a target="{{ isset($menuItem['target']) ? $menuItem['target'] : '' }}"
                title="{{ isset($menuItem['title']) ? $menuItem['title'] : '' }}"
                href="{{ $delete == true ? 'javascript:void(0)' : $route }}"
                @if ($delete == true) onclick="confirmDelete(() => document.getElementById('{{ $div_id }}').submit())" @endif
                class="btn btn-sm {{ isset($menuItem['className']) ? $menuItem['className'] : '' }}"
                @if (isset($menuItem['data-id'])) data-id="{{ $menuItem['data-id'] }}" @endif>
                <i
                    class="bi {{ isset($menuItem['icon']) ? $menuItem['icon'] : '' }} me-2"></i>{{ __($menuItem['label']) }}
            </a>
        @endif
        @if ($delete == true)
            <form id="delete-form-{{ $menuItem['params'][0] }}" action="{{ $route }}" method="POST">
                @csrf
                @method('DELETE')
            </form>
        @endif
    @endforeach
</div>
