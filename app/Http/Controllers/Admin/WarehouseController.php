<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Transaction;
use App\Models\Warehouse;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    public function index ()
    {

        if(request()->ajax()){
            $query = Warehouse::query();

            return DataTables::of($query)
                        ->addColumn('action', 'admin.warehouse._action')
                        ->toJson();
        }

        return view('admin.warehouse.index');
    }

    public function create ()
    {
        $provinces = Province::get();


        return view('admin.warehouse.create', compact('provinces'));
    }


    public function store ()
    {
        $attr = request()->validate([
            'name'          => 'required',
            'description'   => 'nullable',
            'province_id'   => 'required',
            'regency_id'    => 'required',
            'district_id'   => 'required',
            'village_id'    => 'required',
            'postal_code'   => 'required',
            'latitude'      => 'required',
            'longitude'     => 'required'
        ]);


        $attr['id']             = Uuid::uuid4();
        $attr = collect($attr)->filter(fn ($value) => !is_null($value));

        try {
            Warehouse::create($attr->all());

            return redirect()
                ->route('warehouses.index')
                ->with('success', 'Berhasil membuat warehouse');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(Warehouse $warehouse)
    {
        $attr = request()->validate([
            
        ]);

        try {
            $warehouse->update($attr);
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil mengupdate warehouse'
            ];
        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           =>  'Gagal Mengupdate warehouse'
            ];
        }

        return response()->json($message);
    }

    public function destroy(Warehouse $warehouse)
    {
        try {
            $warehouse->delete();
            $message = [
                'status_code'       => 200,
                'success'           => true,
                'message'           => 'Berhasil menghapus warehouse'
            ];
        } catch (Exception $e) {
            $message = [
                'status_code'       => 500,
                'success'           => false,
                'message'           => 'Gagal menghapus warehouse'
            ];
        }

        return response()->json($message);
    } 
}
