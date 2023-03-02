<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $permissions = Permission::get();
            $permissions = $permissions->groupBy(function ($item) {
                return explode('.', $item->name)[0];
            });
            return DataTables::of(Role::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', function ($model) use ($permissions) {
                    return view('admin.role._action', compact('model', 'permissions'));
                })
                ->toJson();
        }

        return view('admin.role.index');
    }

    public function store()
    {
        $attr = request()->validate([
            'name' => 'required'
        ]);


        try {
            Role::create($attr);
            return response()->json([
                'message' => 'Berhasil menambah role',
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => false
            ]);
        }
    }

    public function update(Role $role)
    {
        $attr = request()->validate([
            'name' => 'required'
        ]);

        try {
            $role->update($attr);
            return response()->json([
                'message' => 'Berhasil mengupdate role',
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => false
            ]);
        }
    }

    public function updatePermission(Role $role)
    {
        

        try {
            $role->syncPermissions(request('permissions'));
            return response()->json([
                'message' => 'Berhasil menyesuaikan permission untuk role ' . $role->name,
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => false
            ]);
        }
    }


    public function destroy(Role $role)
    {
        try {
            $role->delete();
            session()->flash('success', 'Berhasil menghapus role');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }

        return redirect()->route('roles.index');
    }
}
