<style>
    th::after {
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
                <h1 class="page-header">Đơn hàng xuất
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                <tr align="center">
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Tên nhân viên</th>
                    <th>Thuế</th>
                    <th>Ngày tạo</th>
                    <th>Tổng tiền</th>
                    <th>Comment</th>
                    <th>Trạng thái</th>
                    <th>Địa chỉ</th>
                    <th>Ngày ship</th>
                    <th>Shipper</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales_orders as $item)
                    <tr class="odd gradeX" align="center">
                        <td><a href="admin/sales_order_item/detail/{{$item->id}}}">{{$item->id}}</a></td>
                        <td>{{$item->customer_name}}</td>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->tax}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->total_money}}</td>
                        <td>{{$item->comment}}</td>
                        <td>{{$item->status}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->date_ship}}</td>
                        <td>
                            <form action="admin/sales_order/choose_shipper/{{$item->id}}/{{$item->date_ship}}"
                                  method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <?php if($item->status == "Đã chọn shipper"):?>
                                    <?php foreach ($shippeds as $shipped):?>
                                        <?php if($shipped->order_id == $item->id):?>
                                            <p>{{$shipped->name}}</p>
                                        <?php endif ;?>
                                    <?php endforeach; ?>
                                <?php else :?>
                                <select name="shipper_id">
                                    <option value="0">Chọn shipper</option>
                                    <?php foreach ($shippers as $shipper):?>
                                    <option value="<?=  $shipper->id ?>"><?= $shipper->name ?> </option>

                                    <?php endforeach; ?>
                                </select>
                                <button style="margin-top: 20px" class="btn btn-default">Save</button>
                                <?php endif ;?>


                            </form>
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