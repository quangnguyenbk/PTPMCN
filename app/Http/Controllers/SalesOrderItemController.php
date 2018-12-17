<?php

namespace App\Http\Controllers;
use App\Laptop;
use App\Sales_order;
use App\Sales_order_item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SalesOrderItemController extends Controller
{
    public function getItems($id){

        $sale_order_items = DB::table('sales_order_items')->where('sales_order_id', '=',$id)->get();
        $sales_detail = Sales_order::where('id', $id)->first();
        $customers = User::all();
        $staffs = User::all();
        $products= Laptop::all();
        return view('admin.sales_order_item.detail', ['sales_order_items'=>$sale_order_items,'sales_detail'=>$sales_detail,'customers'=>$customers
            ,'staffs'=>$staffs,'products'=>$products]);
    }
    public function getUpdate($id){

        $products= Laptop::all();
        $sales_order_item = Sales_order_item::where('id', $id)->first();
        return view('admin.sales_order_item.edit',['sales_order_item'=>$sales_order_item,'products'=>$products]);
    }
    public function postUpdate( Request $request){
        $this->validate($request,
            [

            ],
            [

            ]);
        $sales_orders = Sales_order_item::where('id', $request->id);
        $sales_orders->update([
            'product_id' =>$request->product,
            'comment' =>$request->comment,
            'price' =>$request->price,
            'quantity' =>$request->quantity,
            'quantity_return' =>$request->quantity_return,
            'reason' =>$request->reason
        ]);
        $sales_orders = Sales_order_item::where('id', $request->id)->first();
        return redirect('admin/sales_order_item/detail/'.$sales_orders->sales_order_id)->with('thongbao', 'Sửa thành công');
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
                $sales_order_item = new Sales_order_item();
                $sales_order_item->sales_order_id = $request->id;
                $sales_order_item->product_id = (int)$request->product_id[$i];
                $sales_order_item->price = $request->price[$i];
                $sales_order_item->status = "Mới tạo";
                $sales_order_item->quantity = $request->quantity[$i];
                $sales_order_item->quantity_return = 0;
                $sales_order_item->comment = $request->comment[$i];
                $sales_order_item->save();
            }
        }
        return redirect('admin/sales_order_item/detail/'.$request->id)->with('thongbao', 'Thêm thành công');

    }
    public function change($id){
        $sales_order_items = Sales_order_item::where('id', $id);
        $status = "Đã xác nhận";
        $sales_order_items->update([
            'status' => $status
        ]);
        $sales_order_item = Sales_order_item::where('id', $id)->first();
        return redirect('admin/sales_order_item/detail/'.$sales_order_item->sales_order_id)->with('thongbao', 'Xác nhận thành công');

    }
}