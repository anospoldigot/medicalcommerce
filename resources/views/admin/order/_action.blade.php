{{-- <a href={{ route('orders.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Coupon"><i data-feather='eye'></i></a> --}}

<form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.process', $model->id) }}"
    method="POST" class="d-none" id="process{{$model->id}}">
    @csrf
    @method('patch')
</form> 
<form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.reject', $model->id) }}"
    method="POST" class="d-none" id="reject{{$model->id}}">
    @csrf
    @method('patch')
</form> 
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


{{-- <a href="{{ route('orders.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Coupon"><i data-feather='edit'></i></a>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Coupon" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form> --}}