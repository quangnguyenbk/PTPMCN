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
                <h1 class="page-header">Thông tin đơn hàng đã gửi đề xuất
                </h1>
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
                        <label>Mô tả:</label>
                        <?= $purchase_detail->comment ?>
                    </div>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

@endsection
