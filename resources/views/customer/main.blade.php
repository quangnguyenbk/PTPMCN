
    @extends('customer.layout.index')
    @section('content') 
    
    <script type="text/javascript">
        function addtoCart( id , name, quantity ){
            console.log(id);
        }
    </script>
    <div class="main">
        <div class="container">
            <div class="row">
                    <div class="col-md-12">

    <section class="product-content">
    <h1 class="title">
        <span>
            Sản phẩm
        </span>
    </h1>
    <nav class="product-filter clearfix">
        <ul class="display">
            <li id="grid" class="active grid"><a href="#" title="Grid"><i class="fa fa-th-large"></i></a></li>
            <li id="list" class="list"><a href="#" title="List"><i class="fa fa-th-list"></i></a></li>
        </ul>
        <div class="limit">
            <span>Sản phẩm/trang</span>
            <select id="lblimit" name="lblimit" class="nb_item" onchange="window.location.href = this.options[this.selectedIndex].value">
                        <option value="?limit=10">10</option>
                        <option selected="selected" value="?limit=12">12</option>
                        <option value="?limit=20">20</option>
                        <option value="?limit=50">50</option>
                        <option value="?limit=100">100</option>
                        <option value="?limit=250">250</option>
                        <option value="?limit=500">500</option>
            </select>
        </div>
        <div class="sort">
            <span>Sắp xếp</span>
            <select class="selectProductSort" id="lbsort" onchange="window.location.href = this.options[this.selectedIndex].value">
                        <option selected="selected" value="?sort=index&amp;order=asc">Mặc định</option>
                        <option value="?sort=price&amp;order=asc">Gi&#225; tăng dần</option>
                        <option value="?sort=price&amp;order=desc">Gi&#225; giảm dần</option>
                        <option value="?sort=name&amp;order=asc">T&#234;n sản phẩm: A to Z</option>
                        <option value="?sort=name&amp;order=desc">T&#234;n sản phẩm: Z to A</option>
            </select>
        </div>
    </nav>
    <div class="product-block clearfix">
        <div class="product-list row">
            @foreach($laptops as $item)
                <div class="col-md-2 col-sm-2 col-xs-12 product-resize product-item-box">
                    <div class="product-item wow pulse">
                        <div class="image image-resize">
                            <a href="customer/productDetail/{{$item->id}}" title="{{$item->laptop_name}}">
                                <img src="{{$item->image}}" data-original="{{$item->image}}" alt="{{$item->laptop_name}}" class="img-responsive lazy-img" />
                            </a>
                                
                        </div>
                        <div class="right-block">
                            <h2 class="name">
                                <a href="customer/productDetail/{{$item->id}}" title="{{$item->laptop_name}}">{{$item->laptop_name}}</a>
                            </h2>
                            <div class="rating">
                                <div class="rating-1">
                                    <span class="rating-img">
                                    </span>
                                </div>
                            </div>
                                    <div class="price">
                                            <span class="price">{{$item->price}}&nbsp;₫</span>
                                    </div>
                                                            <div class="action">
                                    <a class="btn-add-cart" href="customer/addToCart/{{$item->id}}/1" >Thêm vào giỏ</a>
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
        <div class="navigation">
            <ul class="pagination">
                <li>
                    <a href="?page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                        <li class="active"><a href="?page=1">1</a></li>
                        <li><a href="?page=2">2</a></li>
                        <li><a href="?page=3">3</a></li>
                <li>
                    <a href="?page=3" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
                        </section>
<!--Template--
--End-->
                    </div>
            </div>
        </div>
    </div>


    


    
    <div style="display: none;" id="loading-mask">
        <div id="loading_mask_loader" class="loader">
            <img alt="Loading..." src="/Images/ajax-loader-main.gif" />
            <div>
                Please wait...
            </div>
        </div>
    </div>
    <a class="back-to-top" href="#" style="display: inline;">
        <i class="fa fa-angle-up">
        </i>
    </a>
    
@endsection