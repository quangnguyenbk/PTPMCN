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
                        <textarea class="form-control" rows="3" name="comment_purchaseoders" value="<?= $purchase_detail->comment ?>"></textarea>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
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
                        <th>ID</th>
                        <th>Mã hóa đơn</th>
                        <th>Tên sản phẩm</th>
                        <th>Tiền</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                        <th>Số lượng</th>
                        <th>Số lượng trả lại</th>
                        <th>Lí do</th>
                        <th>Sửa</th>
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
                            <td>{{$item->price}}</td>
                            <td>{{$item->comment}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->quantity_return}}</td>
                            <td>{{$item->reason}}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/purchaseorderitem/update">Sửa</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection