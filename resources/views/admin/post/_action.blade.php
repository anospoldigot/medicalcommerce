<a href={{ route('post.show', $model->id) }} class="btn btn-sm btn-primary" title="Lihat Artikel"><i data-feather='eye'></i></a>
<a href="{{ route('post.edit', $model->id) }}" class="btn btn-sm btn-success" title="Edit Artikel"><i data-feather='edit'></i></a>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('post.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Artikel" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>