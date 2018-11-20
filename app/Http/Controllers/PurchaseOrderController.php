<?php

namespace App\Http\Controllers;
use App\Laptop;
use App\Purchase_order_item;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Purchase_order;
use App\Supplier;
//use App\
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

    public function getAdd(){
        $suppliers = Supplier::all();
        //$arthour =
        $products= Laptop::all();
        return view('admin.purchaseorders.add',['suppliers'=>$suppliers,'products'=>$products]);
    }

    public function postAdd( Request $request){

        $this->validate($request,
            [
                'tax' => 'required'
            ],
            [
                'tax.required' => 'Bạn chưa nhập mã số thuế'
            ]);
        $purchaseorders = new Purchase_order();
        $purchaseorders->supplier_id = $request->supplier;
        $purchaseorders->tax = $request->tax;
        $purchaseorders->author = 1;
        $purchaseorders->status="Mới tạo";
        $purchaseorders->comment = $request->comment_purchaseoders;

        $purchaseorders->save();
        $id_max = DB::table('purchase_orders')->where('id', DB::raw("(select max(`id`) from purchase_orders)"))->get();
        $id = $id_max[0]->id;
        if($request->product_id) {
            for ($i = 0; $i < count($request->product_id); $i++) {
                $purchaseorder_item = new Purchase_order_item();
                $purchaseorder_item->purchase_order_id = $id;
                $purchaseorder_item->product_id = (int)$request->product_id[$i];
                $purchaseorder_item->price = $request->price[$i];
                $purchaseorder_item->status = "Mới tạo";
                $purchaseorder_item->quantity = $request->quantity[$i];
                $purchaseorder_item->comment = $request->comment[$i];
                $purchaseorder_item->save();
            }
        }
        return redirect('admin/purchaseorderitem/detail/'.$id)->with('thongbao', 'Thêm thành công');

    }

//    public function getUpdate(){
//
//    }

}