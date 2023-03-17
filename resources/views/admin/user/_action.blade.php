{{-- <a href={{ route('product.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Product"><i data-feather='eye'></i></a>
<a href="{{ route('product.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Product"><i data-feather='edit'></i></a>
--}}
<form onsubmit="return confirm('Are you sure?');" action="{{ route('users.destroy', $model->id) }}" method="POST" id="delete{{$model->id}}">
    @csrf
    @method('DELETE')
</form> 

<div class="dropdown">
    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
        <i data-feather="more-vertical"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('users.show', $model->id) }}">
            <i data-feather="eye" class="mr-50"></i>
            <span>Lihat</span>
        </a>
        @can('users.edit')
            <a class="dropdown-item" href="{{ route('users.edit', $model->id) }}">
                <i data-feather='edit' class="mr-50"></i>
                <span>Edit</span>
            </a>
        @endcan
        {{-- @can('users.destroy') --}}
           <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#delete{{$model->id}}').submit()">
                <i data-feather='trash' class="mr-50"></i>
                <span>Delete</span>
            </a>
        {{-- @endcan --}}

        
    </div>
</div>
