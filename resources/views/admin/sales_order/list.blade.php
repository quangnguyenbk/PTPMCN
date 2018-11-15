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
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales_orders as $item)
                            <tr class="odd gradeX" align="center">
                                <td><a href="admin/sales_order/detail/{{$item->id}}}">{{$item->id}}</a></td>
                                <td>{{$item->customer_name}}</td>
                                <td>{{$item->user_name}}</td>
                                <td>{{$item->tax}}</td>
                                <td>{{$item->create_date}}</td>
                                <td>{{$item->total_money}}</td>
                                <td>{{$item->comment}}</td>
                                <td>{{$item->status}}</td>
                                <td>{{$item->address}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/sales_order/delete"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sales_order/edit_order/{{$item->id}}">Edit</a></td>
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