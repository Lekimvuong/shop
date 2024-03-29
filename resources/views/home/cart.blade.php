<a href="{{ route('cart.show') }}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    <span
        id="num">{{ !is_null($carts)?count($carts):''}}</span>
</a>
<div id="cart-wp" class="fl-right">
    <div id="btn-cart">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <span
            id="num">{{ !is_null($carts)?count($carts):''}}</span>
    </div>
    @php
        $sumPrice = 0;
    @endphp
    <div id="dropdown">
        <p class="desc">Có
            <span>{{ !is_null($carts)?count($carts):'0'}}
                sản phẩm</span> trong giỏ hàng</p>
        @if (!empty($carts))
            <ul class="list-cart">
                @if (count($products) > 0)
                    @foreach ($products as $key => $product)
                        @php
                            $price = $product->price_sale;
                            $qty = $carts[$product->id];
                            $priceEnd = $price * $qty;
                            $sumPrice += $priceEnd;
                        @endphp
                        <li class="clearfix">
                            <a href="{{ route('cart.show') }}" title="" class="thumb fl-left">
                                <img src="{{ $product->media[0]->thumb}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{ route('cart.show') }}" title="" style="
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;" class="product-name">{{$product->name}}</a>
                                <p class="price">{{ App\Helpers\Helper::currencyFormat($product->price_sale) }}</p>
                                <p class="qty">Số lượng: <span>{{$qty}}</span></p>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="total-price clearfix">
                <p class="title fl-left">Tổng:</p>
                <p class="price fl-right">{{ App\Helpers\Helper::currencyFormat($sumPrice) }}</p>
            </div>
        @else
            <div class="clearfix total-price empty-cart">
                <span>Giỏ hàng trống</span>
            </div>
        @endif
        <div class="action-cart clearfix">
            <a href="{{ route('cart.show') }}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
            <a href="{{ route('checkout') }}" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
        </div>
    </div>
</div>
