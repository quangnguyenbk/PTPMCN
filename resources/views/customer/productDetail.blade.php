    @extends('customer.layout.index')
    @section('content') 
    <div class="main">
        <div class="container">
            <div class="row">
                    <div class="col-md-9">

<div class="product-detail clearfix relative " >
    <span us-spinner="{radius:5, width:3, length: 3}"></span>
        <!--Begin-->
        <div class="product-block clearfix">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 product-image clearfix">
                    <div class="sp-wrap">
                        <a href="/PTPMCN/resources/views/image/acer_1.jpg" ng-repeat="item in ProductImages"><img src="/PTPMCN/resources/views/image/acer_1.jpg"></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 clearfix">
                    <h2>Sản phẩm 1</h2>
                    <div class="price" >
                        <div ><span class="price-new">0đ</span></div>
                        <span class="product-code">Mã SP: 123</span>
                    </div>
                    <div class="price" ng-if="IsTrackingInventory==true&&AllowPurchaseWhenSoldOut==false&&Quantity<=0">
                        <span class="product-code">Không có hàng</span>
                    </div>
                    <div class="des" ng-bind-html="Summary|unsafe">
                    </div>
                    <div class="quantity clearfix">
                        <label>Số lượng</label>
                        <div class="quantity-input">
                            <input type="number" value="1" class="text" ng-model="InputQuantity" ng-init="InputQuantity=1" />
                        </div>
                    </div>
                    <div class="action" ng-if="IsTrackingInventory==false||AllowPurchaseWhenSoldOut==true || (IsTrackingInventory&&AllowPurchaseWhenSoldOut==false&&Quantity>0)">
                        <a href="javascript:void(0)" ng-click="addToCard()" class="btn-add-cart"><i class="glyphicon glyphicon-shopping-cart"></i> Thêm giỏ hàng</a>
                        <a href="javascript:void(0)" ng-click="addToCardBuy()" class="btn-payment"><i class="glyphicon glyphicon-ok"></i> Mua ngay</a>
                    </div>
                    <div class="action" >
                        <button class="btn btn-primary" disabled="disabled"><i class="glyphicon glyphicon-shopping-cart"></i> Hết hàng</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="product-tabs">
            <ul class="nav nav-tabs">
                <li role="presentation" >
                    <a data-toggle="tab" href="#tab">Thông số kỹ thuật</a>
                </li>
            </ul>
        </div> --}}
        <!--End-->
    <div class="modal fade" id="modalCallMe" tabindex="-1" role="dialog" aria-labelledby="modalCallMeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Cám ơn Qúy Khách đã liên hệ đặt hàng</h2>
                    <p>Shop sẽ gọi lại để tư vấn cho Quý khách hàng trong thời gian sớm nhất</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


                    </div>

            </div>
        </div>
    </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
