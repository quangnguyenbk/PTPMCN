@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Đơn hàng nhập
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
                    <form action="admin/purchaseorders/add" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">
                            <label>Tên nhà cung cấp</label>
                            <select class="form-control" name="supplier">
                                <?php foreach ($suppliers as $supplier):?>
                                <option value="<?= $supplier->id ?>">Tên: <?= $supplier->name ?> / ID : <?= $supplier->id?> </option>
                                    <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mã số thuế</label>
                            <input class="form-control" name="address" placeholder="Mã số thuế" />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" rows="3" name="comment"></textarea>
                        </div>

                        <label>Chi tiết đơn hàng :</label>
                        <div><p></p></div>
                        <div class="foreground">
                            <label>Sản phẩm đơn hàng: </label>
                            <label id="themsp" class="btn btn-default">+</label>
                            <label id="xoasp" class="btn btn-default">-</label>
                        </div>
                        <div id="detailproduct">

                        </div>
                        <div><p></p></div>
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
@section('script')
    <script>
        $(document).ready(function() {
            $('#themsp').click(function () {
                $('#detailproduct').append('<div id="product" class="productdetail" name="productdetail"><input type="checkbox" name="record"><label>Sản phẩm</label>' +
                    '<select name="product_id[]">' +
                    '<?php foreach ($products as $product) :?>'+
                        '<option value="<?= $product->id ?>">Tên: <?= $product->laptop_name ?></option>'+
                    '<?php endforeach;?>'+
                    '</select>' +
                    '<label>Số lượng:</label><input name="soLuong[]" placeholder="Số lượng">'+
                    '<label>Số lượng trả lại:</label><input name="soLuongTraLai[]" placeholder="Số lượng trả lại"><br>' +
                    '<label>Lý do</label><textarea class="form-control" rows="3" name="lydo[]"></textarea></label></div><p></p>');
            });
            $("#xoasp").click(function(){
                $("#detailproduct").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("#product").remove();
                    }
                });
            });
        });
    </script>
@endsection