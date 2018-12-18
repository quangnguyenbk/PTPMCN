<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales_order;
use App\Sales_order_item;
use App\User;
use App\Laptop;
use Illuminate\Support\Facades\DB;
class SalesOrderController extends Controller
{
    public function getList(){

        $sales_orders = DB::table('sales_orders')
            ->join('users as u1', 'u1.id', '=', 'sales_orders.customer_id')
            ->join('users as u2', 'u2.id', '=', 'sales_orders.staff_confirm')
            ->select('sales_orders.*', 'u1.username as customer_name', 'u2.username as user_name')
            ->get();
        return view('admin.sales_order.list', ['sales_orders' => $sales_orders] );
    }

    public function getDetail($salesOrderId){

        $sales_order_items = DB::table('sales_order_items')
            ->join('sales_orders', 'sales_orders.id', '=', 'sales_order_items.sales_order_id')
            ->select('sales_order_items.*')
            ->where ('sales_orders.id',$salesOrderId)
            ->get();

        return view('admin.sales_order.detail', ['sales_order_items' => $sales_order_items] );
    }

    public  function getEditDetailOrder($id){
        $sales_order_item = Sales_order_item::where('id', $id)->first();
        return view('admin.sales_order.edit_order_detail', ['sales_order_item'=>$sales_order_item]);
    }

    public  function getEditOrder($id){
        $customers= User::where('role', 1)->get();
        $employees= User::where('role', 2)->get();
        $sales_order = Sales_order::where('id', $id)->first();
        return view('admin.sales_order.edit_order', ['sales_order'=>$sales_order,'customers'=>$customers, 'employees'=>$employees]);
    }

    public function getAdd(){
        $customers= User::where('role', 1)->get();
        $employees= User::where('role', 2)->get();
        return view('admin.sales_order.add',['customers'=>$customers, 'employees'=>$employees]);
    }

    public function getAddDetailOrder($id){
        $sales_order = Sales_order::where('id', $id)->first();
        $laptops = Laptop::all();
        return view('admin.sales_order.add_order_detail', ['sales_order'=>$sales_order, 'laptops'=>$laptops]);
    }

    public function postAdd( Request $request){
        $this->validate($request,
            [
                'total_money' => 'required',
                'address' => 'required',
            ],
            [
                'total_money.required' => 'Bạn chưa nhập tổng số tiền',
                'address.required' => 'Bạn chưa nhập địa chỉ',

            ]);
        $salesOrder = new Sales_order();
        $salesOrder->customer_id = $request->customer_id;
        $salesOrder->staff_confirm = $request->staff_confirm;
        $salesOrder->tax = $request->tax;
        $salesOrder->total_money = $request->total_money;
        $salesOrder->create_date = $request->create_date;
        $salesOrder->comment = $request->comment;
        $salesOrder->status = "mới tạo";
        $salesOrder->address = $request->address;
        $salesOrder->save();

        return redirect('admin/sales_order/add')->with('thongbao', 'Thêm thành công');
    }

    public function postEditOrder( Request $request, $id){
        $this->validate($request,
            [
                'total_money' => 'required',
                'address' => 'required',
            ],
            [
                'total_money.required' => 'Bạn chưa nhập tổng số tiền',
                'address.required' => 'Bạn chưa nhập địa chỉ',

            ]);
        $salesOrder = Sales_order::find($id);;
        $salesOrder->customer_id = $request->customer_id;
        $salesOrder->staff_confirm = $request->staff_confirm;
        $salesOrder->tax = $request->tax;
        $salesOrder->total_money = $request->total_money;
        $salesOrder->create_date = $request->create_date;
        $salesOrder->comment = $request->comment;
        $salesOrder->status = "mới tạo";
        $salesOrder->address = $request->address;
        $salesOrder->save();

        return redirect('admin/sales_order/edit_order/'.$id)->with('thongbao', 'Lưu thành công');
    }


    public function postEditDetailOrder(Request $request, $id){
        $this->validate($request,
            [
                'order_id' => 'required',
                'laptop_id' => 'required',
                'price' => 'required'
            ],
            [
                'order_id.required' => 'Bạn chưa nhập mã đơn hàng',
                'laptop_id.required' => 'Bạn chưa nhập mã sản phẩm',
                'price.required' => 'Bạn chưa nhập giá ',
            ]);
        $sales_order_item = Sales_order_item::find($id);
        $sales_order_item->sales_order_id = $request->order_id;
        $sales_order_item->product_id = $request->laptop_id;
        $sales_order_item->price = $request->price;
        $sales_order_item->discount = $request->promotion;
        $sales_order_item->quantity = $request->quantity;
        $sales_order_item->status = $request->status;
        $sales_order_item->comment = $request->comment;
        $sales_order_item->quantity_return = $request->return_number;
        $sales_order_item->reason = $request->reason;
        $sales_order_item->save();

        return redirect('admin/sales_order/edit_detail_order/'.$id)->with('thongbao', 'Sửa thành công');
    }

    public function postAddDetailOrder(Request $request, $id){
        $this->validate($request,
            [
                'order_id' => 'required',
                'laptop_id' => 'required',
                'price' => 'required'
            ],
            [
                'order_id.required' => 'Bạn chưa nhập mã đơn hàng',
                'laptop_id.required' => 'Bạn chưa nhập mã sản phẩm',
                'price.required' => 'Bạn chưa nhập giá ',
            ]);
        $sales_order_item = new Sales_order_item();
        $sales_order_item->sales_order_id = $id;
        $sales_order_item->product_id = $request->laptop_id;
        $sales_order_item->price = $request->price;
        $sales_order_item->discount = $request->promotion;
        $sales_order_item->quantity = $request->quantity;
        $sales_order_item->status = $request->status;
        $sales_order_item->comment = $request->comment;
        $sales_order_item->quantity_return = $request->return_number;
        $sales_order_item->reason = $request->reason;
        $sales_order_item->save();

        return redirect('admin/sales_order/add_detail_order/'.$id)->with('thongbao', 'Thêm thành công');
    }

    public function getUpdate(){

    }

}
