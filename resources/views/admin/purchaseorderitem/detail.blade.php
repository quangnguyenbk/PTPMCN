@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
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
                <h1 class="page-header">Thông tin đơn hàng
                </h1>
                <form action="admin/purchaseorders/edit/<?= $purchase_detail->id ?>" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Tên nhà cung cấp</label>
                        <select class="form-control" name="supplier">
                            <?php foreach ($suppliers as $supplier):
                            if($purchase_detail->supplier_id == $supplier->id){ ?>
                            <option value="<?= $supplier->id ?>" selected ><?= $supplier->name ?> </option>

                            <?php }
                            else { ?>
                            <option value="<?= $supplier->id ?>"  ><?= $supplier->name ?> </option>
                            <?php }
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mã số thuế</label>
                        <input class="form-control" name="tax" placeholder="Mã số thuế" value="<?= $purchase_detail->tax ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="comment_purchaseoders"><?= $purchase_detail->comment ?></textarea>
                    </div>
                    <?php if($purchase_detail->status != "Đã duyệt" && $purchase_detail->status != "Đã hủy đơn hàng") {?>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <?php } ?>
                </form>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Đơn hàng nhập
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th class="text-center">ID</th>
                        <th class="text-center">Mã đơn hàng</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Tiền</th>
                        <th class="text-center">Ghi chú</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Số lượng</th>
                        <?php if($purchase_detail->status != "Đã duyệt" && $purchase_detail->status != "Đã hủy đơn hàng") {?>
                        <th class="text-center">Sửa</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_order_items as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->purchase_order_id}}</td>
                            <?php foreach ($laptops as $laptop) :
                                if($laptop->id == $item->product_id){ ?>
                                    <td>{{$laptop->laptop_name}}</td>
                                <?php }
                                endforeach;?>
                            <td>{{number_format($item->price)}} VNĐ</td>
                            <td>{{$item->comment}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->quantity}}</td>
                            <?php if($purchase_detail->status != "Đã duyệt" && $purchase_detail->status != "Đã hủy đơn hàng" && $item->status != "Đã hủy") {?>
                            <td class="center">
                                <a class="btn btn-default" href="admin/purchaseorderitem/update/{{$item->id}}">Sửa sản phẩm</a>
                            </td>
                            <?php
                            }
                            if($item->status == "Đã hủy" && $purchase_detail->status != "Đã hủy đơn hàng"){ ?>
                                <td>
                                </td>
                            <?php }?>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <div>
                    <?php
                    if( $purchase_detail->status != "Đã duyệt" && $purchase_detail->status != "Đã hủy đơn hàng" ){ ?>
                    <form action="admin/purchaseorderitem/add/<?= $purchase_detail->id ?>" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <label>Thêm chi tiết đơn hàng :</label>
                        <div><p></p></div>
                        <div class="foreground">
                            <label>Sản phẩm đơn hàng: </label>
                            <label id="themsp" class="btn btn-default">+</label>
                            <label id="xoasp" class="btn btn-default">-</label>
                        </div>
                        <div><p></p></div>
                        <div id="detailproduct">

                        </div>
                        <div><p></p></div>
                        <div id="showbtn">

                        </div>

                    </form>
                        <?php } ?>
                </div>
                <div>
                    <br>
                </div>
                <div>
                    <div class="form-group">
                            <?php if($purchase_detail->status != "Đã duyệt" && $purchase_detail->status != "Đã hủy đơn hàng") {?>
                            <label>Xác nhận/Hủy đơn hàng:</label>
                                <?php $user = Auth::user();
                                if( $user->hasRole('kho') ){ ?>
                            <a class="btn btn-primary" href="admin/purchaseorders/update/{{$purchase_detail->id}}">Gửi đề xuất</a>
                                <?php } ?>
                                <?php $user = Auth::user();
                                if( $user->hasRole('quanly')&& $purchase_detail->status == "Đã đề xuất"){ ?>
                                <a class="btn btn-success" href="admin/purchaseorders/approve/{{$purchase_detail->id}}">Duyệt đơn hàng</a>
                                <?php } ?>
                            <a class="btn btn-danger" href="admin/purchaseorders/cancelrequest/{{$purchase_detail->id}}">Hủy đơn hàng</a>
                            <?php } ?>
                    </div>
                </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    <style>

        .prod{
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-left: 5px;
            margin-right: 10px;
        }
        .product_id{
            height: 24px;
        }
        .margin {
            margin: 2px;
        }
    </style>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $('#themsp').click(function () {
                if($('#showbtn1').length){

                }
                else {
                    $('#showbtn').append('<div id="showbtn1"><button type="submit" class="btn btn-default margin">Thêm</button>' +
                        '<button type="reset" class="btn btn-default margin">Làm mới</button></div>');
                }
                $('#detailproduct').append('<div id="product" class="productdetail" name="productdetail"><input type="checkbox" name="record"><label>Sản phẩm: </label>' +
                    '<select class="product_id prod" name="product_id[]">' +
                    '<?php foreach ($products as $product) :?>'+
                    '<option value="<?= $product->id ?>">Tên: <?= $product->laptop_name ?></option>'+
                    '<?php endforeach;?>'+
                    '</select>' +
                    '<label > Số lượng</label><input class="prod" name="quantity[]" placeholder="Số lượng nhập" require>'+
                    '<label > Đơn giá </label><input class="prod" name="price[]" placeholder="Đơn giá"><br>'+
                    '<label>Mô tả:</label><textarea class="form-control" rows="3" name="comment[]"></textarea></label></div><p></p>');
            });
            $("#xoasp").click(function(){
                $("#detailproduct").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("#product").remove();
                    }
                });
                if($('#product').length){

                }
                else {
                    $("#showbtn1").remove();
                }
            });
        });
    </script>
@endsection