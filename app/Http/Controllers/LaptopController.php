<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laptop;
use App\Brand;
use App\Ram;
use App\Cpu;
use App\Monitor;
use App\Vga;

class LaptopController extends Controller
{
    //
    public function getList(){
    	$laptops = Laptop::all();
    	$brands = Brand::all();
    	$cpus = Cpu::all();
    	$monitors = Monitor::all();
    	$rams = Ram::all();
    	$vgas = Vga::all();
    	return view('admin.laptop.list', ['laptops' => $laptops]);
    }

    public function getAdd(){
    	$brands = Brand::all();
    	$cpus = Cpu::all();
    	$monitors = Monitor::all();
    	$rams = Ram::all();
    	$vgas = Vga::all();
		return view('admin.laptop.add', ['brands' => $brands, 'cpus' => $cpus, 'monitors' => $monitors, 'rams' => $rams, 'vgas' => $vgas] );
    }

    public function postAdd( Request $request){
		// $this->validate($request,
		// 	[
		// 		'name' => 'required|min:3|max:100'
		// 	],
		// 	[
		// 		'name.required' => 'Bạn chưa nhập tên nhà cung đcấp',
		// 		'name.min' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
		// 		'name.max' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
		// 	]);
		$laptop = new Laptop;
		$laptop->laptop_name = $request->laptop_name;
		$laptop->quantity = $request->quantity;
		$laptop->status = $request->status;
		$laptop->comment = $request->comment;
		$laptop->ram = $request->ram;
		$laptop->vga = $request->vga;
		$laptop->cpu = $request->cpu;
		$laptop->brand = $request->brand;
		$laptop->monitor = $request->monitor;
		$laptop->color = $request->color;
		$laptop->harddrive = $request->harddrive;
		$laptop->image= $request->image;
		$laptop->price = $request->price;
		$laptop->desciption = $request->desciption;
		$laptop->save();

		return redirect('admin/laptop/add')->with('thongbao', 'Thêm thành công');
    }

    public function delete($id){
    	Laptop::where('id', $id)->delete();
    	return back();
    }

    public function getUpdate($id){
    	$laptop = Laptop::where('id', $id)->first();
    	$brands = Brand::all();
    	$cpus = Cpu::all();
    	$monitors = Monitor::all();
    	$rams = Ram::all();
    	$vgas = Vga::all();
    
		return view('admin.laptop.update', ['laptop'=>$laptop,'brands' => $brands, 'cpus' => $cpus, 'monitors' => $monitors, 'rams' => $rams, 'vgas' => $vgas] );
    }
     
    public function postUpdate(Request $request){
    	$laptop = Laptop::where('id', $request->id);
    	$laptop->update([
	    	'laptop_name' =>$request->laptop_name,
			'quantity' =>$request->quantity,
			'status' =>$request->status,
			'comment' =>$request->comment,
			'ram' =>$request->ram,
			'vga' =>$request->vga,
			'cpu' =>$request->cpu,
			'brand' =>$request->brand,
			'monitor'=>$request->monitor,
			'color' =>$request->color,
			'harddrive' =>$request->harddrive,
			'image' =>$request->image,
			'price' => $request->price,
			'desciption' => $request->desciption
		]);
	    	
		return redirect('admin/laptop/list')->with('thongbao', 'Sửa thành công');
    }

    public function getChange($id){
    	$laptop = Laptop:: find($id);
    	if ($laptop->status=='1') {
    		$laptop->update(['status'=>'0']);
    	}
    	else $laptop->update(['status'=>'1']);
    	return back();
    }


}
