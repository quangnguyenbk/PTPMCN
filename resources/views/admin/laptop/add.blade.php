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
                        <form action="admin/laptop/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Tên Laptop</label>
                                <input class="form-control" name="laptop_name" placeholder="Nhập tên Laptop" />
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input class="form-control" name="quantity" placeholder="Nhập số lượng" />
                            </div>
                            <div class="form-group">
                                <label>Tình trạng</label>
                                <input class="form-control" name="status" placeholder="Nhập tình trạng" />
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="3" name="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ram">RAM</label>
                                <select class="form-control" id="ram" name="ram">
                                    <option></option>
                                    @foreach($rams as $rams)
                                        <option value="{{$rams->ram_id}}">{{$rams->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>VGA</label>
                                <select class="form-control" id="vga" name="vga">
                                    <option></option>
                                    @foreach($vgas as $vgas)
                                        <option value="{{$vgas->vga_id}}">{{$vgas->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>CPU</label>
                                <select class="form-control" id="cpu" name="cpu">
                                    <option></option>
                                    @foreach($cpus as $cpus)
                                        <option value="{{$cpus->cpu_id}}">{{$cpus->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Brand</label>
                                <select class="form-control" id="brand" name="brand">
                                    <option></option>
                                    @foreach($brands as $brands)
                                        <option value="{{$brands->brand_id}}">{{$brands->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Monitor</label>
                                <select class="form-control" id="monitor" name="monitor">
                                    <option></option>
                                    @foreach($monitors as $monitors)
                                        <option value="{{$monitors->ram_id}}">{{$monitors->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Color</label>
                                <input class="form-control" name="color" placeholder="Nhập màu" />
                            </div>
                            <div class="form-group">
                                <label>Harddrive</label>
                                <input class="form-control" name="harddrive" placeholder="Nhập Harddrive" />
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input class="form-control" name="image" placeholder="Nhập ảnh" />
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" placeholder="Nhập giá" />
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input class="form-control" name="desciption" placeholder="Nhập mô tả" />
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