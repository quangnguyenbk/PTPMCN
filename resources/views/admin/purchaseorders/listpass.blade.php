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
                    <h1 class="page-header">Danh sách nhận hàng</a>
                        </li>
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
                        <th>Xác nhận nhận hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listOrders as $item)
                        <?php if($item->status == "Đã nhận hàng" || $item->status == "Hoàn thành" || $item->status == "Đã duyệt") { ?>
                        <tr class="odd gradeX" align="center">
                            <td><a href="admin/purchaseorderitem/detailpass/{{$item->id}}">{{$item->id}}</a></td>
                            <td>{{$item->sup}}</td>
                            <td>{{$item->auth}}</td>
                            <?php
                                $items = DB::table('purchase_order_items')->select('price','quantity','quantity_return','status')->where('purchase_order_id', '=',$item->id)->get();
                                $totalMoney= 0;
                                if($items){
                                    foreach ($items as $itemMoney){
                                        if($itemMoney->status != "Đã hủy"){
                                            $totalMoney = $totalMoney + (int)$itemMoney->price * ((int)$itemMoney->quantity - (int)$itemMoney->quantity_return);
                                        }
                                    }
                                }
                            ?>
                            <td>{{number_format($totalMoney)}} VNĐ</td>
                            <td>{{$item->tax}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->status}}</td>
                            <td>{{$item->comment}}</td>
                            <?php if($item->status == "Đã duyệt"){ ?>
                                <td><a class="btn btn-success" href="admin/purchaseorders/updatepass/{{$item->id}}">Xác nhận đã nhận hàng</a></td>
                            <?php }
                            else { ?>
                                <td></td>
                            <?php } ?>

                        </tr>
                        <?php } ?>
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