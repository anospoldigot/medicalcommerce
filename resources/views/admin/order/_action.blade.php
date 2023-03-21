{{-- <a href={{ route('orders.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Coupon"><i
        data-feather='eye'></i></a> --}}
<form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.reject', $model->id) }}" method="POST"
    class="d-none" id="reject{{$model->id}}">
    @csrf
    @method('patch')
</form>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.confirmWithSend', $model->id) }}" method="POST"
    class="d-none" id="send{{$model->id}}">
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
            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#confirmModal{{$model->id}}">
                <i data-feather="check" class="mr-50"></i>
                <span>Confirm</span>
            </a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#reject{{$model->id}}').submit()">
                <i data-feather="x" class="mr-50"></i>
                <span>Reject</span>
            </a>
            <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#send{{$model->id}}').submit()">
                <i data-feather="truck" class="mr-50"></i>
                <span>Confirm & Kirim </span>
            </a>
        @endif
        @if ($model->status == 'PROCESS')
            <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#send{{$model->id}}').submit()">
                <i data-feather="truck" class="mr-50"></i>
                <span>Kirim</span>
            </a>
        @endif
        <a class="dropdown-item" href="javascript:void(0)" onclick="return $('form#send{{$model->id}}').submit()">
            <i data-feather="truck" class="mr-50"></i>
            <span>Confirm & Kirim </span>
        </a>
    </div>
</div>

<div class="modal fade" id="confirmModal{{$model->id}}" tabindex="-1" aria-labelledby="confirmModal{{$model->id}}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.process', $model->id) }}"
                method="POST" id="process{{$model->id}}" class="confirm-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModal{{$model->id}}Label">Order - {{ $model->transaction->invoice_number }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="delivery_datetime">Tanggal Pengiriman</label>
                        <input type="datetime-local" class="form-control" id="delivery_datetime" name="delivery_datetime" value="{{ date('Y-m-d H:i') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <a href="{{ route('orders.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Coupon"><i
        data-feather='edit'></i></a>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('orders.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Coupon" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form> --}}