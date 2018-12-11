@extends('admin.layout.index')

      @section('content') 

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mặt hàng Laptop
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Số lượng </th>
                                <th>Bình luận</th>
                                <th>RAM</th>
                                <th>VGA</th>
                                <th>CPU</th>
                                <th>Brand</th>
                                <th>Monitor</th>
                                <th>Color</th>
                                <th>Harddrive</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Desciption</th>
                                <th>Satus</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laptops as $item)
                            <tr class="odd gradeX" align="center">
                                <td>{{$item->laptop_id}}</td>
                                <td>{{$item->laptop_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->comment}}</td>
                                <td>{{$item->ram}}</td>
                                <td>{{$item->vga}}</td>
                                <td>{{$item->cpu}}</td>
                                <td>{{$item->brand}}</td>
                                <td>{{$item->monitor}}</td>
                                <td>{{$item->color}}</td>
                                <td>{{$item->harddrive}}</td>
                                <td>{{$item->image}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->desciption}}</td>
                                <td>
                                    <a href="admin/laptop/change/{{$item->id}}">
                                        <?php 
                                        if($item->status == 1){ ?>
                                            Còn bán
                                        <?php }
                                        else { ?>
                                            Ngừng bán
                                        <?php }
                                     
                                    ?>                                       
                                    </a>
                                </td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/laptop/update/{{$item->id}}">Edit</a></td>
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