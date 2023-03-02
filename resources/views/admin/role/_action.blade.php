<button class="btn btn-sm btn-success" title="Edit Role" data-toggle="modal" data-target="#editModal{{ $model->id }}">
    <i data-feather='edit'></i>
</button>
<button class="btn btn-sm btn-primary" title="Edit Permission" data-toggle="modal"
    data-target="#permissionModal{{ $model->id }}">
    <i data-feather='lock'></i>
</button>
<div class="modal fade" id="permissionModal{{ $model->id }}" tabindex="-1"
    aria-labelledby="permissionModal{{ $model->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
           <form action="{{ route('roles.updatePermission', $model->id) }}" method="post" class="edit">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $model->id }}Label">Update Permission For {{ $model->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-2">
                        @foreach ($permissions as $permission_name_group => $permission)
                        <label for="">{{ $permission_name_group }}</label>
                        <div class="row">
                            @foreach ($permission as $p)
                            <div class="col-12 col-sm-6 col-lg-3 mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="permissions[]" value="{{ $p->name }}" class="custom-control-input"
                                        id="permissionCheck{{$p->id}}" {{ $model->permissions->contains(function ($value, $key) use($p) {
                                    return $value->id == $p->id;
                                    }) ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="permissionCheck{{$p->id}}">
                                        {{ $p->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal{{ $model->id }}" tabindex="-1" aria-labelledby="editModal{{ $model->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route("roles.update", $model->id) }}" method="post" class="edit">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal{{ $model->id }}Label">Update Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Role</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Role"
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
<form onsubmit="return confirm('Are you sure?');" action="{{ route('roles.destroy', $model->id) }}" method="POST"
    class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" title="Hapus Role" type="submit">
        <i data-feather='trash-2'></i>
    </button>
</form>