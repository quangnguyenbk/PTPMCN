@extends('admin.layout.index')

@section('content')

 <!-- Page Content -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mặt hàng Laptop
                            <small>Thêm mới</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/laptop/update/{{$laptop->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input type="hidden" name="laptop_id" value="{{$laptop->id}}">
                            <div class="form-group">
                                <label>Tên Laptop</label>
                                <input class="form-control" name="laptop_name" value="{{$laptop->laptop_name}}" />
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="quantity" value="{{$laptop->quantity}}" />
                            </div>
                            <div class="form-group">
                                <label>Tình trạng</label>
                                <input class="form-control" name="status" value="{{$laptop->laptop_status}}" />
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="3" name="comment" value="{{$laptop->comment}}"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ram">RAM</label>
                                <select class="form-control" id="ram" name="ram" >
                                    <?php foreach($rams as $ram):
                                        if($laptop->ram == $ram->id){ ?>
                                            <option value="<?= $ram->id ?>" selected ><?= $ram->description ?> </option>

                                        <?php }
                                        else { ?>
                                            <option value="<?= $ram->id ?>"  ><?= $ram->description ?> </option>
                                        <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>VGA</label>
                                <select class="form-control" id="vga" name="vga" value="{{$laptop->vga}}">
                                    <?php foreach($vgas as $vga):
                                        if($laptop->vga == $vga->id){ ?>
                                            <option value="<?= $vga->id ?>" selected ><?= $vga->description ?> </option>

                                        <?php }
                                        else { ?>
                                            <option value="<?= $vga->id ?>"  ><?= $vga->description ?> </option>
                                        <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>CPU</label>
                                <select class="form-control" id="cpu" name="cpu" value="{{$laptop->cpu}}">
                                    <?php foreach($cpus as $cpu):
                                        if($laptop->cpu == $cpu->id){ ?>
                                            <option value="<?= $cpu->id ?>" selected ><?= $cpu->description ?> </option>

                                        <?php }
                                        else { ?>
                                            <option value="<?= $cpu->id ?>"  ><?= $cpu->description ?> </option>
                                        <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="form-control" id="brand" name="brand" value="{{$laptop->brand}}">
                                    <?php foreach($brands as $brand):
                                        if($laptop->brand == $brand->id){ ?>
                                            <option value="<?= $brand->id ?>" selected ><?= $brand->description ?> </option>

                                        <?php }
                                        else { ?>
                                            <option value="<?= $brand->id ?>"  ><?= $brand->description ?> </option>
                                        <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Monitor</label>
                                <select class="form-control" id="monitor" name="monitor" value="{{$laptop->monitor}}">
                                    <?php foreach($monitors as $monitor):
                                        if($laptop->monitor == $monitor->id){ ?>
                                            <option value="<?= $monitor->id ?>" selected ><?= $monitor->description ?> </option>

                                        <?php }
                                        else { ?>
                                            <option value="<?= $monitor->id ?>"  ><?= $monitor->description ?> </option>
                                        <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Color</label>
                                <input class="form-control" name="color" value="{{$laptop->color}}" />
                            </div>
                            <div class="form-group">
                                <label>Harddrive</label>
                                <input class="form-control" name="harddrive" value="{{$laptop->harddrive}}" />
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input class="form-control" name="image" value="{{$laptop->image}}" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" value="{{$laptop->price}}" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" name="desciption" value="{{$laptop->desciption}}" />
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection