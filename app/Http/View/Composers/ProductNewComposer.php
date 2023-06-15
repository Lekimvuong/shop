<?php


namespace App\Http\View\Composers;

use App\Models\Product;
use Illuminate\View\View;
use DB;
 
class ProductNewComposer
{
    protected $users;
 
   
    public function __construct()
    {
    } 
 
    
    public function compose(View $view)
    {
        $products = Product::with('media')  //with() dùng để gọi relation đã khai báo trong model. Đây là gọi relation media()
            ->select('id', 'name', 'price', 'price_sale')
            ->where('active', 1)
            ->limit(6)
            ->orderByDesc('updated_at')
            ->get();
        // Ví dụ join()
        // $products = DB::table('products', 'A')
        //     ->select('A.id', 'A.name', 'A.price', 'A.price_sale', 'B.thumb')
        //     ->join('media as B', 'A.id', '=', 'B.product_id')
        //     ->where('active', 1)
        //     ->limit(8)
        //     ->orderByDesc('id')
        //     ->get();
        $view->with('products', $products);
    }
}//Cái sản phẩm nổi bật, đáng ra phải thêm 1 trường hoặc 1 bảng kiểu đếm số lượt view cho product. Như t đợt trc gà đ làm. M dừ mà làm thì thêm 1 bảng riêng lưu số lượt view là đc.
//Cứ user nhấp vào xem 1 lần thì tăng thêm 1 view.Rồi lấy mấy tk nhiều view nhất thôi. Làm js như tk Click buy nớ cx hay. Mỗi khi hover vào item naoif nó load ra thông tin cơ bản cho user cou 