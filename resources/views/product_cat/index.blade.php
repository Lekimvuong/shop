@extends('Main')
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <input type="hidden" name="productCat" id="productCat" data-value ="{{$productCat}}">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="/" title="">Trang chủ</a>
                    </li>
                    @if ($parentCat)
                    <li>
                        <a href="" title="">{{ $parentCat->name }}</a>
                    </li>
                    @endif
                    <li>
                        <a href="" title="">{{ $productCat->name }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">{{ $productCat->name }}</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị  sản phẩm</p>
                        <div class="form-filter">
                            <form method ="GET">
                                @csrf
                                <select name="sort" id ="sort_by">
                                    <option value="default">Sắp xếp theo</option>
                                    <option value="a-z">-- Từ A-Z --</a></option>
                                    <option value="z-a">-- Từ Z-A --</option>
                                    <option value="desc">Giá cao xuống thấp</option>
                                    <option value="asc">Giá thấp đến cao</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail" id ="products_list">
                    {{-- Load sản phẩm ở đây --}}
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            @include('home.productCat')
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form method="GET" action="" id ="sort_price">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price" value = "1"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value = "2"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value = "3"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value = "4"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price" value ="5"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Acer</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Apple</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Hp</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Lenovo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Samsung</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Toshiba</td>
                                </tr>
                            </tbody>
                        </table> --}}
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="/template/public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('template/public/js/productCatClient/productCat.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var categoryIds = "{{ $categoryIds }}"
            var instance = new productCatClass();
            instance.run({
                categoryIds : categoryIds,
            });
        }); 
    </script>
@endsection
