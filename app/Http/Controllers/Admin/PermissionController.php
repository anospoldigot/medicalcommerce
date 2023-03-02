<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            return DataTables::of(Permission::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', 'admin.permission._action')
                ->toJson();
        }

        return view('admin.permission.index');
    }

    public function store()
    {
        $attr = request()->validate([
            'name' => 'required'
        ]);


        try {
            Permission::create($attr);
            return response()->json([
                'message' => 'Berhasil menambah permission',
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => false
            ]);
        }
    }

    public function update(Permission $permission)
    {
        $attr = request()->validate([
            'name' => 'required'
        ]);

        try {
            $permission->update($attr);
            return response()->json([
                'message' => 'Berhasil menambah permission',
                'success' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'success' => false
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            session()->flash('success', 'Berhasil menghapus permission');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
        }

        return redirect()->route('permissions.index');
    }
}
