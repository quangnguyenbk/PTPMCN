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
                <form action="admin/sales_order/edit/<?= $sales_detail->id ?>" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="form-group">
                        <label>Tên khách hàng</label>
                        <select class="form-control" name="customer_id">
                            <?php foreach ($customers as $customer):
                            if($sales_detail->customer_id == $customer->id){ ?>
                            <option value="<?=  $customer->id ?>" selected ><?= $customer->name ?> </option>

                            <?php }
                            else { ?>
                            <option value="<?= $customer->id ?>"  ><?= $customer->name ?> </option>
                            <?php }
                            endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên nhân viên xác nhận</label>
                        <div class="form-control" name="staff_confirm">
                            <?php foreach ($staffs as $staff):
                            if($sales_detail->staff_confirm == $staff->id){ ?>
                            <div value="<?=  $staff->id ?>" selected ><?= $staff->name ?> </div>

                            <?php }

                            endforeach; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mã số thuế</label>
                        <input class="form-control" name="tax" placeholder="Mã số thuế" value="<?= $sales_detail->tax ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="address" placeholder="Địa chỉ" value="<?= $sales_detail->address ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Ngày ship</label>
                        <input class="form-control" name="date_ship" placeholder="Ngày ship" value="<?= $sales_detail->date_ship ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="comment_purchaseoders"><?= $sales_detail->comment ?></textarea>
                    </div>
                    <?php if($sales_detail->status =="mới tạo"):?>
                        <button type="submit" class="btn btn-default">Sửa</button>
                    <?php endif; ?>
                </form>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Đơn hàng xuất
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
                        <th class="text-center">Giá</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Số lượng tồn kho</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Comment</th>
                        <th class="text-center">Xác nhận/Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales_order_items as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->sales_order_id}}</td>
                            <?php foreach ($laptops as $laptop) :?>
                                <?php if($laptop->id == $item->product_id) :?>
                                <?php $quantity = $laptop->quantity - $item->quantity ?>
                                <td>{{$laptop->laptop_name}}</td>
                                <?php endif ;?>
                            <?php endforeach;?>
                            <td>{{number_format($item->price)}} VNĐ</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$quantity}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->comment}}</td>
                            <td class="center">
                                <?php if($item->status != "Đã xác nhận") :?>
                                    <a class="btn btn-default" href="admin/sales_order_item/update/{{$item->id}}">Sửa đơn hàng</a>
                                <?php endif ;?>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <div>
                    <form action="admin/sales_order_item/add/<?= $sales_detail->id ?>" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <?php if($sales_detail->status =="mới tạo") :?>
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
                        <?php endif; ?>

                    </form>
                </div>
                <div>
                    <br>
                </div>
                <div>
                    <div class="form-group">
                        <?php $user = Auth::user(); ?>
                        <?php if($sales_detail->status =="mới tạo"&& $user->hasRole('quanly')) :?>
                            <label>Xác nhận/Hủy đơn hàng:</label>
                            <a class="btn btn-success" href="admin/sales_order/update/{{$sales_detail->id}}">Xác nhận</a>
                            <a class="btn btn-danger" href="admin/sales_order/cancelrequest/{{$sales_detail->id}}">Hủy đơn hàng</a>
                            <?php elseif($sales_detail->status =="Đã chọn shipper" && $user->hasRole('kho') ) :?>
                            <a class="btn btn-success" href="admin/sales_order/xuat_hang/{{$sales_detail->id}}">Xuất hàng</a>
                            <a class="btn btn-success" href="admin/sales_order/shipper_not_go/{{$sales_detail->id}}">Shipper không đến</a>
                            <?php elseif($sales_detail->status =="Đã xuất hàng" || $sales_detail->status =="Đã hủy đơn hàng" ) :?>
                            <p> </p>
                            <?php else :?>
                            <a class="btn btn-danger" href="admin/sales_order/cancelrequest/{{$sales_detail->id}}">Hủy đơn hàng</a>
                        <?php endif ;?>
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