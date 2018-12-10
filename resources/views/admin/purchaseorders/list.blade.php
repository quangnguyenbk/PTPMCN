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
                        <th>Xác nhận</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listOrders as $item)
                        <tr class="odd gradeX" align="center">
                            <td>{{$item->id}}</td>
                            <td><a href="admin/purchaseorderitem/detail/{{$item->id}}">{{$item->name}}</a></td>
                            <td>{{$item->username}}</td>
                            <?php
                                $items = DB::table('purchase_order_items')->select('price','quantity')->where('purchase_order_id', '=',$item->id)->get();
                                $totalMoney= 0;
                                if($items){
                                    foreach ($items as $itemMoney){
                                    $totalMoney = $totalMoney + (int)$itemMoney->price * (int)$itemMoney->quantity;
                                    }
                                }
                            ?>
                            <td>{{number_format($totalMoney)}} VNĐ</td>
                            <td>{{$item->tax}}</td>
                            <td>{{$item->create_date}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->comment}}</td>
                            <td class="center">
                                <?php if($item->status != "Đã xác nhận") {?>
                                <a class="btn btn-default" href="admin/purchaseorders/update/{{$item->id}}">Xác nhận</a>
                                <?php } ?>
                            </td>
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