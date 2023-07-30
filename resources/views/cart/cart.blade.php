@extends('Main')
@section('content')
    <div id="main-content-wp" class="cart-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="/" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Giỏ hàng của tôi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>@php
            $total = 0;
        @endphp
        <form action ="{{route('cart.update')}}" method="POST">
            <div id="wrapper" class="wp-inner clearfix">
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        @if (count($products) != 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Mã sản phẩm</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        @php
                                            $price = $product->price_sale;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr>
                                            <td>{{ $product->code }}</td>
                                            <td>
                                                <a href="" title="" class="thumb">
                                                    <img src="{{ $product->media[0]->thumb }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" title=""
                                                class="name-product">{{ $product->name }}</a>
                                            </td>
                                            <td>{{ App\Helpers\Helper::currencyFormat($product->price_sale) }}</td>
                                            <td>
                                                <div class="form-outline" style="width: 4rem;">
                                                    <input name ="num-product[{{$product->id}}]" value="{{ $carts[$product->id] }}" type="number" class="form-control" />
                                                </div>
                                            </td>
                                            <td>{{ App\Helpers\Helper::currencyFormat($priceEnd) }}</td>
                                            <td>
                                                <a href="{{route('cart.remove', ['id' =>  $product->id])}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span>{{ App\Helpers\Helper::currencyFormat($total) }}</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="clearfix">
                                                <div class="fl-right">
                                                    <input type="submit" style ="cursor:pointer" title="" value="Cập nhật giỏ hàng" id="update-cart" />
                                                    @csrf
                                                    <a href="?page=checkout" title="" id="checkout-cart">Thanh
                                                        toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng
                            <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.
                        </p>
                        <a href="/" title="" id="buy-more">Mua tiếp</a><br />
                        <a href="{{route('cart.removeAll')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@else
    <div class="text-center">
        <h1>Giỏ hàng trống</h1>
    </div>
    @endif
@endsection
@section('script')
@endsection
