<?php

namespace App\Http\Controllers;
use App\Laptop;
use App\Purchase_order;
use App\Supplier;
use Illuminate\Http\Request;
use App\Purchase_order_item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
class PurchaseOrderItemController extends Controller
{
     public function getItems($id){

         $purchase_order_items = DB::table('purchase_order_items')->where('purchase_order_id', '=',$id)->get();
         $purchase_detail = Purchase_order::where('id', $id)->first();
         $suppliers = Supplier::all();
         $laptops = Laptop::all();
         $products= Laptop::all();
         $user = Auth::user();
         if( $user->hasRole('kho') && $purchase_detail->status == "Đã đề xuất" ){
             return view('admin.purchaseorderitem.detailkho', ['purchase_order_items'=>$purchase_order_items,'purchase_detail'=>$purchase_detail,'suppliers'=>$suppliers
                 ,'laptops'=>$laptops,'products'=>$products]);
         }
         return view('admin.purchaseorderitem.detail', ['purchase_order_items'=>$purchase_order_items,'purchase_detail'=>$purchase_detail,'suppliers'=>$suppliers
         ,'laptops'=>$laptops,'products'=>$products]);
     }
    public function getItemsPass($id){

        $purchase_order_items = DB::table('purchase_order_items')->where('purchase_order_id', '=',$id)->get();
        $purchase_detail = Purchase_order::where('id', $id)->first();
        $suppliers = Supplier::all();
        $laptops = Laptop::all();
        $products= Laptop::all();
        $user = Auth::user();
        return view('admin.purchaseorderitem.detailpass', ['purchase_order_items'=>$purchase_order_items,'purchase_detail'=>$purchase_detail,'suppliers'=>$suppliers
            ,'laptops'=>$laptops,'products'=>$products]);
    }
    public function getUpdate($id){

        $products= Laptop::all();
        $purchaseorderitem = Purchase_order_item::where('id', $id)->first();
        return view('admin.purchaseorderitem.edit',['purchaseorderitem'=>$purchaseorderitem,'products'=>$products]);
    }
    public function getUpdatePass($id){

        $products= Laptop::all();
        $purchaseorderitem = Purchase_order_item::where('id', $id)->first();
        return view('admin.purchaseorderitem.editpass',['purchaseorderitem'=>$purchaseorderitem,'products'=>$products]);
    }
    public function postUpdate( Request $request){
        $this->validate($request,
            [

            ],
            [

            ]);
        $purchaseorders = Purchase_order_item::where('id', $request->id);
        $purchaseorders->update([
            'product_id' =>$request->product,
            'comment' =>$request->comment,
            'price' =>$request->price,
            'quantity' =>$request->quantity
        ]);
        $purchaseorder = Purchase_order_item::where('id', $request->id)->first();
        return redirect('admin/purchaseorderitem/detail/'.$purchaseorder->purchase_order_id)->with('thongbao', 'Sửa thành công');
    }
    public function postUpdatePass( Request $request){
        $this->validate($request,
            [

            ],
            [

            ]);
        $purchaseorders = Purchase_order_item::where('id', $request->id);
        $purchaseorders->update([
            'status' => "Đã kiểm tra",
            'quantity_return' =>$request->quantity_return,
            'reason' => $request->reason
        ]);
        $purchaseorder = Purchase_order_item::where('id', $request->id)->first();
        return redirect('admin/purchaseorderitem/detailpass/'.$purchaseorder->purchase_order_id)->with('thongbao', 'Sửa thành công');
    }
    public function postAdd( Request $request){
        $this->validate($request,
            [
                'price.*' => 'required'
            ],
            [
                'price.*.required' => 'Vui lòng nhập giá vào đầy đủ'
            ]);
        if($request->product_id) {
            for ($i = 0; $i < count($request->product_id); $i++) {
                $purchaseorder_item = new Purchase_order_item();
                $purchaseorder_item->purchase_order_id = $request->id;
                $purchaseorder_item->product_id = (int)$request->product_id[$i];
                $purchaseorder_item->price = $request->price[$i];
                $purchaseorder_item->status = "Mới tạo";
                $purchaseorder_item->quantity = $request->quantity[$i];
                $purchaseorder_item->quantity_return = 0;
                $purchaseorder_item->comment = $request->comment[$i];
                $purchaseorder_item->save();
            }
        }
        return redirect('admin/purchaseorderitem/detail/'.$request->id)->with('thongbao', 'Thêm thành công');

    }
    public function change($id){
        $purchaseorders = Purchase_order_item::where('id', $id);
        $status = "Đã xác nhận";
        $purchaseorders->update([
            'status' => $status
        ]);
        $purchaseorder = Purchase_order_item::where('id', $id)->first();
        return redirect('admin/purchaseorderitem/detail/'.$purchaseorder->purchase_order_id)->with('thongbao', 'Xác nhận thành công');

    }
    public function cancelrequest($id){
        $purchaseorders = Purchase_order_item::where('id', $id);
        $status = "Đã hủy";
        $purchaseorders->update([
            'status' => $status
        ]);
        $purchaseorder = Purchase_order_item::where('id', $id)->first();
        return redirect('admin/purchaseorderitem/detail/'.$purchaseorder->purchase_order_id)->with('thongbao', 'Hủy thành công');

    }
}