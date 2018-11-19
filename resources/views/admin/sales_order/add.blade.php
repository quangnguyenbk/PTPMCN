@extends('admin.layout.index')

@section('content')

 <!-- Page Content -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Đơn hàng xuất
                            <small>Thêm mới</small>
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
                        <form action="admin/sales_order/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Mã khách hàng</label>
                                <input class="form-control" name="customer_id" placeholder="Nhập mã khách hàng" />
                            </div>
                            <div class="form-group">
                                <label>Mã nhân viên xác nhân</label>
                                <input class="form-control" name="staff_confirm" placeholder="Nhập mã nhân viên xác nhận" />
                            </div>
                            <div class="form-group">
                                <label>Số thuế</label>
                                <input class="form-control" name="tax" placeholder="Nhập số thuế" />
                            </div>
                            <div class="form-group">
                                <label>Ngày tạo</label>
                                <input class="form-control" type="datetime" name="create_date" placeholder="Nhập ngày tạo" />
                            </div>
                            <div class="form-group">
                                <label>Tổng tiền</label>
                                <input class="form-control" name="total_money" placeholder="Nhập tổng số tiền" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input class="form-control" name="address" placeholder="Nhập địa chỉ" />
                            </div>
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea class="form-control" rows="3" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection