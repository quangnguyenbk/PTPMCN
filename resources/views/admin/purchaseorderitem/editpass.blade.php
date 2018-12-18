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
                        <small>Kiểm tra thông tin</small>
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

                        <form action="admin/purchaseorderitem/editpass/<?= $purchaseorderitem->id ?>" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Mã đơn hàng : <?= $purchaseorderitem->purchase_order_id ?></label>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm: </label>
                                    <?php foreach ($products as $product):
                                    if($purchaseorderitem->product_id == $product->id){ ?>
                                        <?= $product->laptop_name ?>
                                    <?php }
                                    endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label>Mô tả: </label>
                                <?= $purchaseorderitem->comment ?>
                            </div>
                            <div class="form-group">
                                <label>Đơn giá: </label>
                               <?= $purchaseorderitem->price ?>
                            </div>
                            <div class="form-group">
                                <label>Số lượng nhập: </label>
                                <?= $purchaseorderitem->quantity ?>
                            </div>
                            <div class="form-group">
                                <label>Số lượng trả lại: </label>
                                <input class="form-control" name="quantity_return" placeholder="Số lượng trả lại" value="<?= $purchaseorderitem->quantity_return ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Lí do trả lại</label>
                                <textarea class="form-control" rows="3" name="reason" ><?= $purchaseorderitem->reason ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Kiểm tra hoành thành</button>
                        </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
