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
                        <th>Nhà cung cấp</th>
                        <th>Người tạo</th>
                        <th>Tổng tiền</th>
                        <th>Thuế</th>
                        <th>Ngày lập</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Sửa</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listOrders as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td><a href="admin/purchaseorderitem/detail/{{$item->id}}">{{$item->name}}</a></td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->total_money}}</td>
                            <td>{{$item->tax}}</td>
                            <td>{{$item->create_date}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->comment}}</td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/pucharseoder/update">Sửa</a></td>
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