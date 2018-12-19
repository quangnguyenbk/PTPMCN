    @extends('customer.layout.index')
    @section('content') 
    <script> 
        var laptop = {};
        laptop.price = {{$laptop->price}}; 
        function addtoCart( id , name, quantity ){
            console.log(id);
        }

    </script>
    <script type="text/javascript" src="/PTPMCN/resources/js/Utilities.js""></script>
    <script type="text/javascript" src="/PTPMCN/resources/js/productDetail.js""></script>
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
                        <a href="{{$laptop->image}}" ><img src="{{$laptop->image}}"></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 clearfix">
                    <h2>{{$laptop->laptop_name}}</h2>
                    <div class="price" >
                        <div ><span class="price-new" id ="price"></span></div>
                        <span class="product-code">Mã sản phẩm : {{$laptop->id}}</span>
                    </div>
                    <div class="des ng-binding" ng-bind-html="Summary|unsafe">
                        <ul class="ul">
          
                            <li><i class="before"></i><span>- CPU: {{$cpu->description}} - RAM/ HDD: {{$harddrive->description}}
                                </span></li>
                            <li><i class="before"></i><span>- Màn hình: {{$monitor->description}}
                                </span></li>
                            <li><i class="before"></i><span>- VGA: VGA rời, {{$vga->description}}
                                </span></li>
                            <li><i class="before"></i><span>- Hệ điều hành: Win 10 bản quyền
                                </span></li>
                            <li><i class="before"></i><span>- Màu sắc/ Chất liệu: {{$laptop->color}}</span></li>
        
                        </ul>
                    <br>
                    @if( $laptop->quantity > 0)
                    <div class="quantity clearfix">
                        <label>Số lượng</label>
                        <div class="quantity-input">
                            <input type="number" value="1" class="text" ng-model="InputQuantity" ng-init="InputQuantity=1" />
                        </div>
                    </div>
                    <div class="action">
                        <a href="customer/addToCart/{{$laptop->id}}/1" class="btn-add-cart" ><i class="glyphicon glyphicon-shopping-cart"></i> Thêm giỏ hàng</a>
                    </div>
                    @else
                    <div class="action" >
                        <button class="btn btn-primary" <i class="glyphicon glyphicon-shopping-cart"></i> Hết hàng</button>
                    </div>
                    @endif
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
