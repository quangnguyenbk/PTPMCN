<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getLoginAdmin(){
    	return view('admin.login');
    }

    public function getLogout(){
        Auth::logout();
        return view('admin.login');
    }

    public function postLoginAdmin(Request $request){
    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required'
    	], [
    		'email.required'=>'Bạn chưa nhập email',
    		'password.required'=>'Bạn chưa nhập password'
    	]);

    	if (Auth::attempt(['email'=>$request->email, 'password'=>$request->password]))
    	{
    		return redirect('admin/supplier/list');
    	}
    	else {
    		return redirect('admin/login')->with('thongbao', 'Đăng nhập không thành công');
    	}
    }
}
