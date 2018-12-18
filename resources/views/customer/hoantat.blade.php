    @extends('customer.layout.index')
    @section('content') 
<div class="main">
        <div class="container">
            <div class="row">
                    <div class="col-md-12">
<div class="payment-end">
    <div class="">
            <div class="alert alert-success fade in">
                <i class="fa-fw fa fa-check"></i>
                <strong>Success! </strong>
                <span>Đơn hàng của bạn đã được mua thành công</span>
            </div>
                            </div>
    <div class="payment-order clearfix">
        <h3>Mã đơn hàng của bạn: <b>#{{$id}}</b></h3>
        <p><b>Ngày đặt:</b> <i>19/12/2018</i></p>
        <h1>Thông tin đơn hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phâm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $item)
                    <tr>
                        <td>
                            <span>  {{$item->name}}</span>
                            <p class="note"></p>
                        </td>
                        <td>{{number_format($item->price)}} VNĐ</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{number_format($item->total)}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-right label-payment"><b>Tổng thanh toán:</b></td>
                    <td class="total-payment">{{number_format($total)}} đ</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="clearfix col-md-12">
        <div class="button text-right">
            <a class="btn btn-default" href="customer/main">Tiếp tục mua hàng</a>
        </div>
    </div>
</div>
                    </div>
            </div>
        </div>
    </div>
@endsection