<?php

namespace App\Http\Controllers;

use Hamcrest\Core\IsNull;
use Illuminate\Http\Request;
use App\Sales_order;
use App\Sales_order_item;
use App\User;
use App\Ship_schedule;
use App\Laptop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SalesOrderController extends Controller
{
    public function getList(){

        $sales_orders = DB::table('sales_orders')
            ->join('users as u1', 'u1.id', '=', 'sales_orders.customer_id')
            ->where('sales_orders.status', "mới tạo")
            ->orWhere('sales_orders.status', "Đã hủy đơn hàng")
            ->select('sales_orders.*', 'u1.name as customer_name')
            ->get();
        $users = User::all();
        return view('admin.sales_order.list', ['sales_orders' => $sales_orders,'users'=>$users, ] );
    }

    public function getShiper(){

        $sales_orders = DB::table('sales_orders')
            ->join('users as u1', 'u1.id', '=', 'sales_orders.customer_id')
            ->join('users as u2', 'u2.id', '=', 'sales_orders.staff_confirm')
            ->where('sales_orders.status', "Đã xác nhận")
            ->orWhere('sales_orders.status', "Đã chọn shipper")
            ->select('sales_orders.*', 'u1.name as customer_name', 'u2.name as user_name')
            ->get();
        $shippeds = DB::table('ship_schedules')
            ->join('users', 'users.id', '=', 'ship_schedules.shipper_id')
            ->select('ship_schedules.*', 'users.name')
            ->get();
        $shippers = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 7)
            ->select('users.*', 'role_user.role_id')
            ->get();
        return view('admin.sales_order.shipper', ['sales_orders' => $sales_orders, 'shippers'=>$shippers , 'shippeds'=>$shippeds] );
    }

    public function getSalesOrder(){

        $sales_orders = DB::table('sales_orders')
            ->join('users as u1', 'u1.id', '=', 'sales_orders.customer_id')
            ->join('users as u2', 'u2.id', '=', 'sales_orders.staff_confirm')
            ->where('sales_orders.status', "Đã chọn shipper")
            ->orWhere('sales_orders.status', "Đã xuất hàng")
            ->select('sales_orders.*', 'u1.name as customer_name', 'u2.name as user_name')
            ->get();
        return view('admin.sales_order.sale', ['sales_orders' => $sales_orders] );
    }

    public function postShipper(Request $request, $order_id, $date_ship){
        $ship_schedule = new Ship_schedule();
        $ship_schedule->shipper_id = $request->shipper_id;
        $ship_schedule->order_id = $order_id;
        $ship_schedule->date_ship = $date_ship;
        $ship_schedule->save();

        $sales_order = Sales_order::where('id', $order_id)->first();
        $sales_order->status = "Đã chọn shipper";
        $sales_order->save();
        return redirect('admin/sales_order/shiper')->with('thongbao', 'Thêm thành công');
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
        $customers = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 8)
            ->select('users.*', 'role_user.role_id')
            ->get();
        $employees = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 5)
            ->select('users.*', 'role_user.role_id')
            ->get();
        $sales_order = Sales_order::where('id', $id)->first();
        return view('admin.sales_order.edit_order', ['sales_order'=>$sales_order,'customers'=>$customers, 'employees'=>$employees]);
    }

    public function getAdd(){
        $customers = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 8)
            ->select('users.*', 'role_user.role_id')
            ->get();
        $employees = DB::table('users')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->where('role_user.role_id', 5)
            ->select('users.*', 'role_user.role_id')
            ->get();
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

    public function getUpdate(){

    }

    public function postUpdate(Request $request){
        $this->validate($request,
            [
                'tax' => 'required',
                'date_ship' =>'required'
            ],
            [
                'tax.required' => 'Bạn chưa nhập số thuế',
                'date_ship.required'=> 'Bạn chưa nhập ngày ship'
            ]);
        $sales_orders = Sales_order::where('id', $request->id);
        $sales_orders->update([
            'customer_id' =>$request->customer_id,
            'staff_confirm'=>$request->staff_confirm,
            'address'=>$request->address,
            'date_ship'=>$request->date_ship,
            'tax' =>$request->tax,
            'comment' =>$request->comment
        ]);

        return redirect('admin/sales_order_item/detail/'.$request->id)->with('thongbao', 'Sửa thành công');

    }
    public function postEdit($id){
        $user_id = Auth::id();
        $sales_orders = Sales_order::where('id', $id);
        $status = "Đã xác nhận";
        $sales_orders->update([
            'status' => $status,
            'staff_confirm' => $user_id

        ]);
        $sales_order_items = DB::table('sales_order_items')->where('sales_order_id', '=',$id)->get();
        foreach ($sales_order_items as $item){
            $laptopitem = Laptop::where('id', $item->product_id)->first();
            $addproduct = $laptopitem->quantity - $item->quantity + $item->quantity_return;
            $laptop = Laptop::where('id', $item->product_id);
            $laptop->update([
                'quantity' => $addproduct
            ]);
            $sales_order_item = Sales_order_item::where('id', $item->id)->first();
            $sales_order_item->status = "Đã xác nhận";
            $sales_order_item->save();

        }
        return redirect('admin/sales_order/list')->with('thongbao', 'Xác nhận thành công đơn hàng mã '.$id);

    }
    public function cancelRequest($id){
        $sales_orders = Sales_order::where('id', $id);
        $status = "Đã hủy đơn hàng";
        $sales_orders->update([
            'status' => $status
        ]);
        $sales_order_items = DB::table('sales_order_items')->where('sales_order_id', '=',$id)->get();
        foreach ($sales_order_items as $item){
            $laptopitem = Laptop::where('id', $item->product_id)->first();
            $addproduct = $laptopitem->quantity + $item->quantity ;
            $laptop = Laptop::where('id', $item->product_id);
            $laptop->update([
                'quantity' => $addproduct
            ]);
        }
        return redirect('admin/sales_order/list')->with('thongbao', 'Hủy thành công đơn hàng mã '.$id);

    }

    public function xuatHang($id){
        $sales_orders = Sales_order::where('id', $id);
        $status = "Đã xuất hàng";
        $sales_orders->update([
            'status' => $status
        ]);
        return redirect('admin/sales_order/sale')->with('thongbao', 'Xuất thành công đơn hàng mã '.$id);
    }

    public function shipperNotGo($id){
        $sales_orders = Sales_order::where('id', $id);
        $status = "Đã xác nhận";
        $sales_orders->update([
            'status' => $status
        ]);
        return redirect('admin/sales_order/list')->with('thongbao', 'Cập nhật thành công trạng thái đơn hàng mã '.$id);
    }

}
