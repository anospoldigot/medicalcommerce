<a href={{ route('warehouses.show', $model->id) }} class="btn btn-sm btn-primary" title="Detail Product"><i data-feather='eye'></i></a>
<a href="{{ route('warehouses.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Product"><i data-feather='edit'></i></a>
{{-- <a href="{{ route('products.reviews.index', $model->id) }}" class="btn btn-sm btn-warning" title="Ulasan Product"><i data-feather='star'></i></a> --}}
<form  action="{{ route('warehouses.destroy', $model->id) }}" method="POST"
    class="d-inline delete">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Product" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>