@extends('Main')
@section('content')
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="/" title="">Trang chủ</a>
                    </li>
                    @if ($parentCat)
                    <li>
                        <a href="{{route('productCat.index', ['id' =>  $parentCat->id, 'slug'=>$parentCat->slug])}}" title="">{{ $parentCat->name }}</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{route('productCat.index', ['id' =>  $productCat->id, 'slug'=>$productCat->slug])}}" title="">{{ $productCat->name }}</a>
                    </li>
                    <li>
                        <a href="" title="">{{ $product->name }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="{{$Images[0]->thumb }}" data-zoom-image="{{ $Images[1]->thumb }}"/>
                        </a>
                        <div id="list-thumb">
                       @foreach($Images as $image)
                            <a href="" data-image="{{$image->thumb}}" data-zoom-image="{{$image->thumb}}">
                                <img id="zoom" src="{{$image->thumb}}"/>
                            </a>
                        @endforeach
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="public/images/img-pro-01.png" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name">{{$product->name}}</h3>
                        <div class="desc">
                            {!!$product->description!!}
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status">Còn hàng</span>
                        </div>
                        <p class="price">{{ \App\Helpers\Helper::currencyFormat($product->price)}}</p>
                        <div id="num-order-wp">
                            <a title="" id="minus"><i class="fa fa-minus"></i></a>
                            <input type="text" name="num-order" value="1" id="num-order">
                            <a title="" id="plus"><i class="fa fa-plus"></i></a>
                        </div>
                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    {!!$product->content!!}
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($products as $item)
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="{{ $item->media[0]->thumb }}">
                            </a>
                            <a href="" title=""  style ="
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;"class="product-name">{{$item->name}}</a>
                            <div class="price">
                                <span class="new">{{ \App\Helpers\Helper::currencyFormat($item->price) }}</span>
                                <span class="old">{{ \App\Helpers\Helper::currencyFormat($item->price_sale) }}</span>
                            </div>
                            <div class="action clearfix">
                                <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('home.productCat')
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="/template/public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    
@endsection