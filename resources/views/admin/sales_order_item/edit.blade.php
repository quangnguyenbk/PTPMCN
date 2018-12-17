@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chỉnh sửa chi tiết đơn hàng
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
                <form action="admin/sales_order_item/update/{{$sales_order_item->id}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Mã đơn hàng</label>
                        <input class="form-control" name="sales_order_id" value="{{$sales_order_item->sales_order_id}}" />
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <select class="form-control" name="product">
                            <?php foreach ($products as $product):
                            if($sales_order_item->product_id == $product->id){ ?>
                            <option value="<?= $product->id ?>" selected ><?= $product->laptop_name ?> </option>

                            <?php }
                            else { ?>
                            <option value="<?= $product->id ?>"  ><?= $product->laptop_name ?> </option>
                            <?php }
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giá</label>
                        <input class="form-control" name="price" value="{{$sales_order_item->price}}" />
                    </div>
                    <div class="form-group">
                        <label>Khuyến mại</label>
                        <input class="form-control" name="promotion"  value="{{$sales_order_item->discount}}"/>
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input class="form-control" name="quantity" value="{{$sales_order_item->quantity}}" />
                    </div>
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <input class="form-control" name="status" value="{{$sales_order_item->status}}" />
                    </div>
                    <div class="form-group">
                        <label>Comment</label>
                        <textarea class="form-control" rows="3" name="comment" value="{{$sales_order_item->comment}}"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Số lượng trả lại</label>
                        <input class="form-control" name="return_number" value="{{$sales_order_item->quantity_return}}" />
                    </div>
                    <div class="form-group">
                        <label>Lý do</label>
                        <input class="form-control" name="reason" value="{{$sales_order_item->reason}}" />
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