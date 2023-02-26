<button class="btn btn-sm btn-success" title="Edit Category" data-toggle="modal"
    data-target="#editModal{{ $model->id }}">
    <i data-feather='edit'></i>
</button>
<div class="modal fade" id="editModal{{ $model->id }}" tabindex="-1" aria-labelledby="editModal{{ $model->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("tags.update", $model->id) }}" method="post" class="edit">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $model->id }}Label">Update Tag</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Tag</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tag"
                            value="{{ $model->name }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<form onsubmit="return confirm('Are you sure?');" action="{{ route('tags.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Category" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>