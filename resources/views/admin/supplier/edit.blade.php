@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nhà cung cấp
                            <small>{{$supplier->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                    	@if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}<br>
                            @endforeach
                        </div>
                    	@endif

                    	@if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                   		@endif
                        <form action="admin/supplier/update/{{$supplier->id}}" method="POST">
                        	<input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Tên nhà cung cấp</label>
                                <input class="form-control" name="name" placeholder="Nhập tên nhà cung cấp" value="{{$supplier->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Mã số thuế</label>
                                <input class="form-control" name="tax_id" placeholder="Nhập mã số thuế" value="{{$supplier->tax_id}}" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{$supplier->address}}"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập email" value="{{$supplier->email}}"/>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="form-control" name="phone" placeholder="Nhập số điện thoại" value="{{$supplier->phone}}" />
                            </div>
                            <div class="form-group">
                                <label class ="" required>Mô tả</label>
                                <textarea class="form-control" rows="3" name="comment" value="">{{$supplier->comment}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        @endsection