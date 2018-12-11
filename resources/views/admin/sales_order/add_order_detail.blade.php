@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết đơn hàng
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
                <form action="admin/sales_order/add_detail_order/{{$sales_order->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Mã đơn hàng</label>
                        <input class="form-control" name="order_id" value="{{$sales_order->id}}" />
                    </div>
                    <div class="form-group">
                        <label>Mã sản phẩm</label>
                        {{--<input class="form-control" name="laptop_id"  />--}}
                        <select class="form-control" name="laptop_id">
                            <?php foreach ($laptops as $laptop):?>
                            <option value="<?= $laptop->id ?>">Tên: <?= $laptop->laptop_name ?> </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giá</label>
                        <input class="form-control" name="price"  />
                    </div>
                    <div class="form-group">
                        <label>Khuyến mại</label>
                        <input class="form-control" name="promotion" />
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input class="form-control" name="quantity" />
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <input class="form-control" name="status" />
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" rows="3" name="comment" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Số lượng trả lại</label>
                        <input class="form-control" name="return_number"  />
                    </div>
                    <div class="form-group">
                        <label>Lý do</label>
                        <input class="form-control" name="reason"  />
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