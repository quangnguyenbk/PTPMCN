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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales_orders as $item)
                            <tr class="odd gradeX" align="center">
                                <td><a href="admin/sales_order_item/detail/{{$item->id}}}">{{$item->id}}</a></td>
                                <td>{{$item->customer_name}}</td>
                                <?php if($item->staff_confirm):?>
                                    <?php foreach ($users as $user) :
                                        if($user->id == $item->staff_confirm){ ?>
                                            <td>{{$user->name}}</td>
                                        <?php }
                                    endforeach;?>
                                <?php else :?>
                                    <td></td>
                                <?php  endif; ?>
                                <td>{{$item->tax}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->total_money}}</td>
                                <td>{{$item->comment}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->date_ship}}</td>
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