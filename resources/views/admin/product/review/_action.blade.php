<form onsubmit="return confirm('Are you sure?');" action="{{ route('products.reviews.destroy', [$product->id, $model->id]) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Category" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>