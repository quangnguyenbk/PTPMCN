<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Purchase_order;
class PurchaseOrderController extends Controller
{
    public function getList(){
//        $listPuchaseOrder = Purchase_order::all();
        $listOrders = DB::table('purchase_orders')
            ->join('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->join('users', 'users.id', '=', 'purchase_orders.author')
            ->select('purchase_orders.*','suppliers.name','users.username')
            ->get();

        return view('admin.purchaseorders.list', ['listOrders' => $listOrders]);
    }

//    public function getAdd(){
//        return view('admin.purchaseorders.add');
//    }

//    public function postAdd( Request $request){
//        $this->validate($request,
//            [
//                'name' => 'required|min:3|max:100'
//            ],
//            [
//                'name.required' => 'Bạn chưa nhập tên nhà cung cấp',
//                'name.min' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
//                'name.max' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
//            ]);
//        $purchaseorders = new Purchaseorders;
//        $purchaseorders->name = $request->name;
//        $purchaseorders->tax_id = $request->tax_id;
//        $purchaseorders->address = $request->address;
//        $purchaseorders->phone = $request->phone;
//        $supplier->email = $request->email;
//        $supplier->comment = $request->comment;
//        $supplier->status = "mới tạo";
//        $supplier->save();
//
//        return redirect('admin/supplier/add')->with('thongbao', 'Thêm thành công');
//    }

//    public function getUpdate(){
//
//    }

}