@extends('main')
@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
           @include('slider')
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="template/public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="template/public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="template/public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="template/public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="template/public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
         @include('product_hot')
         @foreach ($productCats as $productCat)
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{ $productCat->name }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @php
                        $t = 0;
                        @endphp
                        @foreach ($products as $product)
                        @if ($t < 8)
                        @if (in_array($product->cat_id, \App\Helpers\Helper::getArrayCatId($allProductCats, $productCat->id)))
                        @php
                        $t++;
                        @endphp
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{ $product->media[1]->thumb }}">
                            </a>
                            <a href="" title="" class="product-name">{{ $product->name }}</a>
                            <div class="price">
                                <span class="new">{{ \App\Helpers\Helper::currencyFormat($product->price_sale) }}</span>
                                <span class="old">{{ \App\Helpers\Helper::currencyFormat($product->price) }}</span>
                            </div>
                            <div class="action clearfix">
                                <a href="/add-cart/{{$product->id}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="/checkout/{{$product->id}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endif
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
            {{-- <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{ $productCat->name }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-17.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Asus X441NA</a>
                            <div class="price">
                                <span class="new">7.690.000đ</span>
                                <span class="old">8.690.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-18.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Lenovo IdeaPad 110</a>
                            <div class="price">
                                <span class="new">9.490.000đ</span>
                                <span class="old">10.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-19.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Acer ES1 533</a>
                            <div class="price">
                                <span class="new">7.490.000đ</span>
                                <span class="old">9.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-20.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Lenovo IdeaPad 110</a>
                            <div class="price">
                                <span class="new">6.990.000đ</span>
                                <span class="old">7.990.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-21.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Asus X441NA</a>
                            <div class="price">
                                <span class="new">6.490.000đ</span>
                                <span class="old">8.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-22.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Acer Aspire ES1</a>
                            <div class="price">
                                <span class="new">6.390.000đ</span>
                                <span class="old">7.390.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-05.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Lenovo IdeaPad 120S</a>
                            <div class="price">
                                <span class="new">5.190.000đ</span>
                                <span class="old">7.190.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="template/public/images/img-pro-23.png">
                            </a>
                            <a href="" title="" class="product-name">Laptop Asus A540UP I5</a>
                            <div class="price">
                                <span class="new">14.490.000đ</span>
                                <span class="old">16.490.000đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> --}}
            
        </div>
        <div class="sidebar fl-left">
            @include('productCat')
           @include('product_new')
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="template/public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
  
@endsection