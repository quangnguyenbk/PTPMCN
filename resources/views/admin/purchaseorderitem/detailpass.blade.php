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
                </h1><form action="admin/purchaseorders/edit/<?= $purchase_detail->id ?>" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-group">
                    <label>Tên nhà cung cấp:</label>
                    <?php foreach ($suppliers as $supplier):
                        if($purchase_detail->supplier_id == $supplier->id){ ?>
                           <?= $supplier->name ?>

                            <?php }
                    endforeach; ?>
                </div>
                <div class="form-group">
                    <label>Số thuế:</label>
                    <?= $purchase_detail->tax ?>
                </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="comment_purchaseoders"><?= $purchase_detail->comment ?></textarea>
                    </div>
                    <?php  $user = Auth::user();
                    if($purchase_detail->status != "Hoàn thành" && $purchase_detail->status != "Đã duyệt" &&   $user->hasRole('kho')) {?>
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
                        <th class="text-center">Mã hóa đơn</th>
                        <th class="text-center">Tên sản phẩm</th>
                        <th class="text-center">Tiền</th>
                        <th class="text-center">Ghi chú</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">Số lượng trả lại</th>
                        <th class="text-center">Lí do</th>
                        <th class="text-center">Kiểm tra</th>
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
                            <td>{{$item->quantity_return}}</td>
                            <td>{{$item->reason}}</td>
                            <?php if($item->status != "Đã kiểm tra" && $purchase_detail->status != "Đã duyệt" &&  $user->hasRole('kho')){ ?>
                            <td class="center">
                                <a class="btn btn-primary" href="admin/purchaseorderitem/editpass/{{$item->id}}">Kiểm tra</a>
                            </td>
                            <?php }
                            else{ ?>
                            <td class="center">
                            </td>
                            <?php }?>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                    <div class="form-group">
                        <?php $check = 0 ;
                                    foreach($purchase_order_items as $item) :
                                     if($item->status != "Đã kiểm tra"){
                                         $check = $check+1;
                                     }
                                     endforeach;
                                if($check>0){?>
                                    <label>Bạn còn <?= $check ?> sản phẩm chưa kiểm tra </label>
                                <?php }
                            if($purchase_detail->status == "Đã nhận hàng" && $check==0) {?>
                            <label>Hoàn thành đơn hàng:</label>
                            <a class="btn btn-success" href="admin/purchaseorders/updatefinish/{{$purchase_detail->id}}">Xác nhận hoàn thành đơn hàng</a>
                            <?php } ?>
                    </div>
                </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
