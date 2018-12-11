@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng xuất
                    <small>Chỉnh sửa đơn hàng</small>
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
                <form action="admin/sales_order/edit_order/{{$sales_order->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Mã khách hàng</label>
                        <select class="form-control" name="customer_id" >
                            <?php foreach ($customers as $customer):?>
                                <?php if($sales_order->customer_id == $customer->id):?>
                                    <option value="<?= $customer->id ?>" selected="selected">Tên: <?= $customer->username ?>  </option>
                                <?php else :?>
                                    <option value="<?= $customer->id ?>">Tên: <?= $customer->username ?> </option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mã nhân viên xác nhân</label>
                        <select class="form-control" name="staff_confirm" value="<?= $sales_order->staff_confirm ?>">
                            <?php foreach ($employees as $employee):?>
                                <?php if($sales_order->staff_confirm == $employee->id):?>
                                    <option value="<?= $employee->id ?>" selected="selected">Tên: <?= $employee->username ?>  </option>
                                <?php else :?>
                                    <option value="<?= $employee->id ?>">Tên: <?= $employee->username ?> </option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Số thuế</label>
                        <input class="form-control" name="tax" value="{{$sales_order->tax}}" />
                    </div>
                    <div class="form-group">
                        <label>Ngày tạo</label>
                        <input class="form-control" type="datetime" name="create_date" value="{{$sales_order->create_date}} "/>
                    </div>
                    <div class="form-group">
                        <label>Tổng tiền</label>
                        <input class="form-control" name="total_money" value="{{$sales_order->total_money}}" />
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="address" value="{{$sales_order->address}}"/>
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" rows="3" name="comment" value="{{$sales_order->comment}}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Save</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection