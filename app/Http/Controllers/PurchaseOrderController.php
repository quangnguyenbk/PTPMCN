<?php

namespace App\Http\Controllers;
use App\Laptop;
use App\Purchase_order_item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Purchase_order;
use App\Supplier;
use App\User;

//use App\
class PurchaseOrderController extends Controller
{
    public function getList(){
//        $listPuchaseOrder = Purchase_order::all();
        $listOrders = DB::table('purchase_orders')
            ->join('suppliers', 'suppliers.id', '=', 'purchase_orders.supplier_id')
            ->join('users', 'users.id', '=', 'purchase_orders.author')
            ->select('purchase_orders.*','suppliers.name as sup','users.name as  auth')
            ->get('purchase_orders');
        return view('admin.purchaseorders.list', ['listOrders' => $listOrders]);
    }

    public function getAdd(){
        $suppliers = Supplier::all();
        //$arthour =
        $products= Laptop::all();
        $user = Auth::user();
        if( $user->hasRole('kho') ){
            return view('admin.purchaseorders.add',['suppliers'=>$suppliers,'products'=>$products,'user'=>$user]);
        }

    }

    public function postAdd( Request $request){

        $this->validate($request,
            [
                'tax' => 'required',
                 'price.*' => 'required'
            ],
            [
                'tax.required' => 'Bạn chưa nhập mã số thuế',

                'price.*.required' => 'Vui lòng nhập giá vào đầy đủ'
            ]);
        $purchaseorders = new Purchase_order();
        $purchaseorders->supplier_id = $request->supplier;
        $purchaseorders->tax = $request->tax;
        $purchaseorders->author = Auth::id();
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
                $purchaseorder_item->quantity_return = 0;
                $purchaseorder_item->comment = $request->comment[$i];
                $purchaseorder_item->save();
            }
        }
        return redirect('admin/purchaseorderitem/detail/'.$id)->with('thongbao', 'Thêm thành công');

    }

    public function postUpdate(Request $request){
        $this->validate($request,
            [
                'tax' => 'required',
            ],
            [
                'tax.required' => 'Bạn chưa nhập số thuế',
            ]);
            $purchaseorders = Purchase_order::where('id', $request->id);
            $purchaseorders->update([
                'supplier_id' =>$request->supplier,
                'tax' =>$request->tax,
                'comment' =>$request->comment_purchaseoders
            ]);

            return redirect('admin/purchaseorderitem/detail/'.$request->id)->with('thongbao', 'Sửa thành công');

    }
    public function postEdit($id){
        $purchaseorders = Purchase_order::where('id', $id);
        $status = "Đã xác nhận";
        $purchaseorders->update([
            'status' => $status
        ]);
        return redirect('admin/purchaseorders/list')->with('thongbao', 'Xác nhận thành công đơn hàng mã '.$id);

    }
    public function cancelRequest($id){
        $purchaseorders = Purchase_order::where('id', $id);
        $status = "Đã hủy đơn hàng";
        $purchaseorders->update([
            'status' => $status
        ]);
        return redirect('admin/purchaseorders/list')->with('thongbao', 'Hủy thành công đơn hàng mã '.$id);

    }

}