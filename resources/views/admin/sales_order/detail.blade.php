<style>
    th::after{
        content: "" !important;
    }
</style>
@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết đơn hàng
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Mã đơn hàng</th>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Khuyến mại</th>
                    <th>Số lượng</th>
                    <th>Comment</th>
                    <th>Trạng thái</th>
                    <th>Số lượng trả lại</th>
                    <th>Lý do</th>
                    <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales_order_items as $key => $item)
                    <tr class="odd gradeX" align="center">
                        <td>{{$key+1}}</td>
                        <td>{{$item->sales_order_id}}</td>
                        <td>{{$item->product_id}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->discount}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->comment}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->quantity_return}}</td>
                        <td>{{$item->reason}}</td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sales_order/edit_detail_order/{{$item->id}}">Edit</a></td>
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