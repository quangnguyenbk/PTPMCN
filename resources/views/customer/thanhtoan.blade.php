    @extends('customer.layout.index')
    @section('content') 
<div class="main">
        <div class="container">
            <div class="row">
                    <div class="col-md-12">
<div class="payment-content" ng-controller="orderController" ng-init="initCheckoutController()">
    <h1 class="title"><span>Thanh toán</span></h1>
    <div class="steps clearfix">
        <ul class="clearfix">
            <li class="cart active col-md-2 col-xs-12 col-sm-4 col-md-offset-3 col-sm-offset-0 col-xs-offset-0"><span><i class="glyphicon glyphicon-shopping-cart"></i></span><span>Giỏ hàng của tôi</span><span class="step-number"><a>1</a></span></li>
            <li class="payment active col-md-2 col-xs-12 col-sm-4"><span><i class="glyphicon glyphicon-usd"></i></span><span>Thanh toán</span><span class="step-number"><a>2</a></span></li>
            <li class="finish col-md-2 col-xs-12 col-sm-4"><span><i class="glyphicon glyphicon-ok"></i></span><span>Hoàn tất</span><span class="step-number"><a>3</a></span></li>
        </ul>
    </div>
    <form class="payment-block clearfix" id="checkout-container" action="customer/dathang" method="POST">
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="col-md-6 col-sm-12 col-xs-12 payment-step step2">
            <h4>1. Địa chỉ thanh toán và giao hàng</h4>
            <div class="step-preview clearfix">
                <h2 class="title">Thông tin thanh toán</h2>
                <div class="form-block">
                    <label>Mua hàng không cần tài khoản</label>
                    <div class="form-group"><input class="form-control" placeholder="Họ & Tên" type="text" name="name" required /></div>
                    <div class="form-group"><input class="form-control" placeholder="Số điện thoại" name="phone" type="text"  required /></div>
                    <div class="form-group"><input class="form-control" placeholder="Email" name="email" type="email"  required /></div>
                    <div class="form-group"><input class="form-control" placeholder="Địa chỉ" name="address" type="text"  required /></div>
                    <textarea class="form-control" rows="4" placeholder="Ghi chú đơn hàng" name="" ></textarea>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 payment-step step1">
            <h4>2. Thông tin đơn hàng</h4>
            <div class="step-preview">
                <div class="cart-info">
                	@foreach($carts as $item)
                    <div class="cart-items">
                        <div class="cart-item clearfix" ng-repeat="item in OrderDetails">
                            <span class="image pull-left" style="margin-right:10px;">
                                <a href="/san-pham/{{$item->id}}.html">
                                    <img src="{{$item->image}}" class="img-responsive" />
                                </a>
                            </span>
                            <div class="product-info pull-left">
                                <span class="product-name">
                                    <a href="/san-pham/{{$item->id}}.html">{{$item->name}}</a> x <span>{{$item->quantity}}</span>
                                </span>
                            </div>
                            <span class="price">{{number_format($item->price)}}</span>
                        </div>
                    </div>
                    @endforeach
                    <div class="total-price">
                        Thành tiền  <label> {{number_format($total)}} ₫</label>
                    </div>
                    <div class="shiping-price">
                        Phí vận chuyển  <label>0 ₫</label>
                    </div>
                    <div class="total-payment">
                        Thanh toán <span> {{number_format($total)}} ₫</span>
                    </div>
                    <div class="button-submit">
                        <button class="btn btn-default" type="submit">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

                    </div>
            </div>
        </div>
    </div>
@endsection