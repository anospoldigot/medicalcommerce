{{-- <a href={{ route('product.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Product"><i data-feather='eye'></i></a>
<a href="{{ route('product.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Product"><i data-feather='edit'></i></a>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('product.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Product" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form> --}}

<div class="dropdown">
    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
        <i data-feather="more-vertical"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('orders.show', $model->id) }}">
            <i data-feather="eye" class="mr-50"></i>
            <span>Lihat</span>
        </a>
        @if ($model->status == 'ISSUED')
        <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#process{{$model->id}}').submit()">
            <i data-feather="check" class="mr-50"></i>
            <span>Confirm</span>
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#reject{{$model->id}}').submit()">
            <i data-feather="x" class="mr-50"></i>
            <span>Reject</span>
        </a>
        @endif
    </div>
</div>
