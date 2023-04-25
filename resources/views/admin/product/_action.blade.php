<a href={{ route('product.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Product"><i data-feather='eye'></i></a>
<a href="{{ route('product.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Product"><i data-feather='edit'></i></a>
<a href="{{ route('products.reviews.index', $model->id) }}" class="btn btn-sm btn-warning" title="Ulasan Product"><i data-feather='star'></i></a>
<a href="{{ route('products.items.index', $model->id) }}" class="btn btn-sm btn-warning" title="Stock Product"><i data-feather='plus'></i></a>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('product.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Product" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>