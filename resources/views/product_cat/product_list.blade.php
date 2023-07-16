<ul class="list-item clearfix">
                        @foreach ($products as $product)
                        <li>
                            <a href="/san-pham/{{ $product->id }}-{{ \Str::slug($product->name) }}.html" title="" class="thumb">
                                <img src="{{ $product->media[0]->thumb}}">
                            </a>
                            <a href="/san-pham/{{ $product->id }}-{{ \Str::slug($product->name) }}.html" title="" class="product-name" style ="
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">{{ $product->name }}</a>
                            <div class="price">
                                <span class="new">{{ \App\Helpers\Helper::currencyFormat($product->price_sale) }}</span>
                                <span class="old">{{ \App\Helpers\Helper::currencyFormat($product->price) }}</span>
                            </div>
                            <div class="action clearfix">
                                <a href="/add-cart/{{$product->id}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="/checkout/{{$product->id}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
