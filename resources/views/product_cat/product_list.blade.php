<ul class="list-item d-flex clearfix">
    @foreach ($products as $product)
        <li>
            <a href="{{route('product.index', ['id' =>  $product->id, 'slug'=>$product->product_cat->slug])}}" title="" class="thumb">
                <img src="{{ $product->media[0]->thumb }}">
            </a>
            <a href="{{route('product.index', ['id' =>  $product->id, 'slug'=>$product->product_cat->slug])}}" title=""
                class="product-name" style="
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">{{ $product->name }}</a>
            <div class="price">
                <span class="new">{{ \App\Helpers\Helper::currencyFormat($product->price_sale) }}</span>
                <span class="old">{{ \App\Helpers\Helper::currencyFormat($product->price) }}</span>
            </div>
            <div class="action clearfix">
                <a href="/add-cart/{{ $product->id }}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                <a href="/checkout/{{ $product->id }}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
            </div>
        </li>
    @endforeach
</ul>
<div class="d-flex mt-4 justify-content-center">
    {!! $products->appends(request()->all())->links('pagination') !!}
</div>
