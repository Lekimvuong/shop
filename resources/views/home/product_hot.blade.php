<div class="section" id="feature-product-wp">
    <div class="section-head">
        <h3 class="section-title">Sản phẩm HOT</h3>
    </div>
    <div class="section-detail">
        <ul class="list-item">
            @php
            @endphp
            @foreach ($products as $product)
            <li>
                <a href="/san-pham/{{$product->id}}-{{\Str::slug($product->name)}}.html" title="" class="thumb">
                    <img src="{{ $product->media[0]->thumb }}">
                </a>
                <a href="/san-pham/{{$product->id}}-{{\Str::slug($product->name)}}.html" title="" style ="
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;" class="product-name">{{ $product->name }}</a>
                <div class="price">
                    <span class="new">{{ \App\Helpers\Helper::currencyFormat($product->price_sale) }}</span>
                    <span class="old">{{ \App\Helpers\Helper::currencyFormat($product->price) }}</span>
                </div>
                <div class="action clearfix">
                    <a href="#" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                    <a href="#" title="" class="buy-now fl-right">Mua ngay</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>