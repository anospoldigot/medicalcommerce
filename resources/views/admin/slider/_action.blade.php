{{-- <a href={{ route('orders.show', $model-></a>id) }} class="btn btn-sm btn-primary" title="Detail Coupon"><i
        data-feather='eye'></i></a> --}}
<form action="{{ route('sliders.destroy', $model->encrypt_link) }}" method="POST"
    class="d-inline delete">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Coupon" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>
{{-- <a href="{{ route('orders.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Coupon"><i
        data-feather='edit'></i></a>
 --}}