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
				'name' => 'required|min:3|max:100',
				'tax_id' => 'required'
			],
			[
				'name.required' => 'Bạn chưa nhập tên nhà cung cấp',
				'name.min' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
				'name.max' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
				'tax_id.required' => 'Bạn chưa nhập mã số thuế',
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

    public function getUpdate($id){
    	$supplier = Supplier::where('id', $id)->first();
    	return view('admin.supplier.edit', ['supplier'=>$supplier]);
    }

    public function postUpdate(Request $request, $id){
    	$this->validate($request,
			[
				'name' => 'required|min:3|max:100',
				'tax_id' => 'required'
			],
			[
				'name.required' => 'Bạn chưa nhập tên nhà cung cấp',
				'name.min' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
				'name.max' => 'Tên nhà cung cấp phải có độ dài từ 3 đến 100 kí tự',
				'tax_id.required' => 'Bạn chưa nhập mã số thuế',
			]);
		$supplier = Supplier::find($id);
		$supplier->name = $request->name;
		$supplier->tax_id = $request->tax_id;
		$supplier->address = $request->address;
		$supplier->phone = $request->phone;
		$supplier->email = $request->email;
		$supplier->comment = $request->comment;
		$supplier->save();

		return redirect('admin/supplier/update/'.$id)->with('thongbao', 'Sửa thành công');
    }

    public function getDelete($id){
    	$supplier = Supplier::find($id);
    	$supplier->status = 'đã hủy';
    	$supplier->save();
    	$suppliers = Supplier::all();
    	return view('admin.supplier.list', ['suppliers' => $suppliers])->with('thongbao', 'Bạn đã xóa thành công');;
    }
}
