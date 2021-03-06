@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
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
                    <h1 class="page-header">Chi tiết sản phẩm
                        <small>Sửa chi tiết</small>
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

                        <form action="admin/purchaseorderitem/update/<?= $purchaseorderitem->id ?>" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Mã hóa đơn : <?= $purchaseorderitem->purchase_order_id ?></label>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <select class="form-control" name="product">
                                    <?php foreach ($products as $product):
                                    if($purchaseorderitem->product_id == $product->id){ ?>
                                    <option value="<?= $product->id ?>" selected ><?= $product->laptop_name ?> </option>

                                    <?php }
                                    else { ?>
                                    <option value="<?= $product->id ?>"  ><?= $product->laptop_name ?> </option>
                                    <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" rows="3" name="comment" ><?= $purchaseorderitem->comment ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Đơn giá</label>
                                <input class="form-control" name="price" placeholder="Đơn giá" value="<?= $purchaseorderitem->price ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập</label>
                                <input class="form-control" name="quantity" placeholder="Số lượng nhập" value="<?= $purchaseorderitem->quantity ?>"/>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <a class="btn btn-danger" href="admin/purchaseorderitem/cancelrequest/{{$purchaseorderitem->id}}">Hủy mua sản phẩm</a>
                        </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
