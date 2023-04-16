<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    public function index ()
    {
        if(request()->ajax()){
            return DataTables::of(Coupon::withCount('orders'))
                ->addIndexColumn()
                ->addColumn('action', 'admin.coupon._action')
                ->toJson();
        }
        
        return view('admin.coupon.index');
    }


    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store ()
    {
        $attr = request()->validate([
            'code'          => 'required',
            'discount_type' => 'required',
            'discount'      => 'required',
            'expire_at'     => 'required',
        ]);



        $attr['id'] = Uuid::uuid4();
        $attr['discount'] = str_replace(",", "", request('discount'));

        try{
            Coupon::create($attr);
            
            return redirect()->route('coupons.index')->with('success', 'Berhasil menyimpan data kupon');
        }catch(\Throwable $th){
            return redirect()->route('coupons.index')->with('error', $th->getMessage());
        }
        
    }

    public function destroy (Coupon $coupon)
    {
        try {
            $coupon->delete();
            return redirect()->route('coupons.index')->with('success', 'Berhasil menghapus data kupon');
        } catch (\Throwable $th) {
            return redirect()->route('coupons.index')->with('error', $th->getMessage());
        }
    }
}
