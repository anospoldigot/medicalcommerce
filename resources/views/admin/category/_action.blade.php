<button class="btn btn-sm btn-success" title="Edit data" data-toggle="modal" data-target="#editModal{{ $model->id }}">
    <i data-feather='edit'></i>
</button>
<div class="modal fade" id="editModal{{ $model->id }}" tabindex="-1" aria-labelledby="editModal{{ $model->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("category.update", $model->id) }}" method="post" class="edit">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $model->id }}Label">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Category</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Category" value="{{ $model->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $model->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('category.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Data" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>
