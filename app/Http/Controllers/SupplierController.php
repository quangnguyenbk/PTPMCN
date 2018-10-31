<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
class SupplierController extends Controller
{
    public function getList(){
    	$suppliers = Supplier::all();
    	return view('admin.supplier.list', ['suppliers' => $suppliers] );
    }

	public function getAdd(){
		return view('admin.supplier.add');
    }

    public function postAdd( Request $request){
		$this->validate($request,
			[
				'name' => 'required|min:3|max:100'
			],
			[
				'name.required' => 'Bạn chưa nhập tên nhà cung cấp',
				'name.min' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
				'name.max' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
			]);
		$supplier = new Supplier;
		$supplier->name = $request->name;
		$supplier->tax_id = $request->tax_id;
		$supplier->address = $request->address;
		$supplier->phone = $request->phone;
		$supplier->email = $request->email;
		$supplier->comment = $request->comment;
		$supplier->status = "mới tạo";
		$supplier->save();

		return redirect('admin/supplier/add')->with('thongbao', 'Thêm thành công');
    }

    public function getUpdate(){

    }

}
