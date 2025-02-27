@props(['route' => '', 'id' => '', 'class' => ''])

<div class="btn-group {{ $class }}">
    @if(isset($view) && $view)
        <a href="{{ route($route.'.show', $id) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="View">
            <i class="bi bi-eye"></i>
        </a>
    @endif
    
    @if(isset($edit) && $edit)
        <a href="{{ route($route.'.edit', $id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Edit">
            <i class="bi bi-pencil"></i>
        </a>
    @endif
    
    @if(isset($delete) && $delete)
        <form action="{{ route($route.'.destroy', $id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Delete" 
                    onclick="return confirm('Are you sure you want to delete this item?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    @endif
</div>
