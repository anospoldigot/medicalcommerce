<a href={{ route('coupons.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Coupon"><i data-feather='eye'></i></a>
<a href="{{ route('coupons.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Coupon"><i data-feather='edit'></i></a>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('coupons.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Coupon" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>