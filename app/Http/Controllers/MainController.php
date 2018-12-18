<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Laptop;
use App\Cpu;
use App\Brand;
use App\Ram;
use App\Monitor;
use App\Vga;
use App\Harddrive;
use App\ShoppingCart;
use App\Sales_order;
use App\Sales_order_item;
use App\Role;
class MainController extends Controller
{
    public function getListLaptop($page = 15, $col = null, $sort = null){
    	if ($col != null && $sort !=null)
    		$laptops = DB::table('laptops')->orderBy($col, $sort)->paginate($page);
    	else $laptops = Laptop::paginate($page);
    	return view('customer.main', ['laptops' => $laptops]);
    }

    public function getListCart(){
    	$carts = ShoppingCart::all();
    	$total = 0 ;
    	foreach ($carts as $item) {
    		$total = $total + $item->total;
    	}
    	return view('customer.giohang', ['carts' => $carts, 'total'=> $total]);
    }
    public function getDetail($id){
    	$laptop = Laptop:: find($id);
    	$cpu = Cpu::find($laptop->cpu);
    	$brand = Brand::find($laptop->brand);
    	$ram = Ram::find($laptop->ram);
    	$monitor = Monitor::find($laptop->monitor);
    	$vga = Vga::find($laptop->vga);
    	$harddrive = Harddrive::find($laptop->harddrive);
    	return view('customer.productDetail', [
    		'laptop'=>$laptop , 
    		'cpu'=>$cpu, 
    		'brand'=>$brand,
    		'ram'=>$ram,
    		'monitor'=>$monitor,
    		'vga'=>$vga,
    		'harddrive'=>$harddrive,
    	]);
    }

    public function addToCart($id, $quantity){
    	$Cart = ShoppingCart::all(); 
    	$laptop = Laptop:: find($id);
    	$found = false;
    	foreach ($Cart as $item) //vòng lặp mảng SESSION 
            {
                if($item->id == $id){ //sản phẩm đã tồn tại trong mảng
                	$item->quantity += $quantity;
                	$item->total  = $item->quantity * $item->price;
                	$item->save();
                $found = true; 

                }
            }
        if (!$found){
        	$cart = new ShoppingCart();
        	$cart->id = $id;
        	$cart->quantity = $quantity;
        	$cart->name = $laptop->laptop_name;
        	$cart->price = $laptop->price;
        	$cart->image = $laptop->image;
        	$total =  $laptop->price;
        	$total = $total * $quantity;
        	$cart->total = $total;
        	$cart->save();
        } 
        return redirect('customer/giohang'); 
    }

    public function removeFromCart($id){
    	 $cart = ShoppingCart::find($id);
    	 $cart->delete();
    	 return redirect('customer/giohang');
    }

    public function thanhtoan(){
    	 
    	 $carts = ShoppingCart::all();
    	 $total = 0 ;
    	foreach ($carts as $item) {
    		$total = $total + $item->total;
    	}
    	return view('customer.thanhtoan', ['carts' => $carts, 'total'=> $total]);
    }

    public function dathang(Request $request){
        $salesOrder = new Sales_order();
        $carts = ShoppingCart::all();
		$total = 0 ;
    	foreach ($carts as $item) {
    		$total = $total + $item->total;
    	}
        //tạo customer
        $role_customer = Role::where('name', 'khachhang')->first();
		$customer = new User();
        $customer->name = $request->name;;
        $customer->email = $request->email;
        $customer->password = bcrypt('12345678');
        $customer->save();
        $customer->roles()->attach($role_customer);
        //tạo saleorder

        $salesOrder->customer_id = User::where('email',$request->email )->first()->id;
        $salesOrder->tax = "10%";
        $salesOrder->total_money = $total;
        $salesOrder->comment = $request->comment;
        $salesOrder->status = "mới tạo";
        $salesOrder->address = $request->address;
        $salesOrder->save();

        
		// tạo order item
		$id_max = DB::table('sales_orders')->where('id', DB::raw("(select max(`id`) from sales_orders)"))->get();
        $id = $id_max[0]->id;
        
        foreach ($carts as $item) //vòng lặp mảng SESSION 
            {
                $saleItem = new Sales_order_item();
                $saleItem->sales_order_id = $id;
                $saleItem->product_id = $item->id;
                $saleItem->price = $item->price;
                $saleItem->quantity = $item->quantity;
                $saleItem->status = "mới tạo";
                $saleItem->save();
                $item->delete();
            }

        
         return view('customer.hoantat', ['carts' => $carts, 'id'=> $id, 'salesOrder'=> $salesOrder, 'total'=>$total]);
    	
    }


}

