@extends('shipper.layout.index')

      @section('content') 

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Shipper
                            <small>Danh sách đơn hàng</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Id đơn</th>
                                <th>Ngày ship </th>
                                <th>Thời gian dự tính</th>
                                <th>Thời gian thực tế</th>
                                <th>Nhận xét</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->id}}</td>
                                <td>{{$item->order_id}}</td>
                                <td>{{$item->date_ship}}</td>
                                <td>{{$item->estimate_time}}</td>
                                <td>{{$item->actual_time}}</td>
                                <td>{{$item->comment}}</td>
                                <td>                               
                                    <?php 
                                        if($item->status == 0){ ?>
                                            <button type="button" class="btn btn-info active" onclick="window.location='shipper/done/{{$item->id}}'" >Giao hàng</button>
                                        <?php }
                                        else { ?>
                                            <button type="button" class="btn btn-info disabled">Đã giao</button>
                                        <?php }
                                    ?>                                       
                                    </button>
                                </td>
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