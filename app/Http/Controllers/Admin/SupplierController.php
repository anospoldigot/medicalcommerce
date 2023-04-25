<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    public function index ()
    {
        if (request()->ajax()) {
            $query = Supplier::query();

            return DataTables::of($query)
                ->addColumn('action', 'admin.supplier._action')
                ->toJson();
        }

        return view('admin.supplier.index');
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil menghapus Supplier'
            ];
        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           => 'Gagal menghapus Supplier'
            ];
        }

        return response()->json($message);
    }
}
