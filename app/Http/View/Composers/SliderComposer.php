<?php


namespace App\Http\View\Composers;

use App\Models\Slider;
use Illuminate\View\View;
 
class SliderComposer
{
    protected $users;
 
   
    public function __construct()
    {
    } 
 
    
    public function compose(View $view)
    {
        $sliders = Slider::select('id', 'name', 'thumb')->where('active', 1)->get();
        $view->with('sliders', $sliders);
    }
}