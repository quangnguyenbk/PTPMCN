@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
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
                        <th>Mã sản phẩm</th>
                        <th>Tiền</th>
                        <th>Ghi chú</th>
                        <th>Trạng thái</th>
                        <th>Trả lại</th>
                        <th>Tiền trả lại</th>
                        <th>Lí do</th>
                        <th>Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_order_items as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->purchase_order_id}}</td>
                            <td>{{$item->product_id}}</td>
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