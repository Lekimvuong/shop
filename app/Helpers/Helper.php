<?php

namespace app\Helpers;

class Helper
{
    public $count;
    public static function postCat($postCats, $parent_id = 0, $char = '')
    {
        global $count;
        $html = '';
        foreach ($postCats as $key => $postCat) {
            if ($postCat->parent_id == $parent_id) {
                $count++;
                $html .= '<tr>
        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
        <td><span class="tbody-text">' . $count . '</h3></span>
        <td class="clearfix">
            <div class="tb-title fl-left">
                <a href="" title="">' . $char . $postCat->name . '</a>
            </div>
            <ul class="list-operation fl-right">
                <li><a href="'.route('postCats.edit', ['postCat' => $postCat->id]).'" title="Sửa" data-id="'. $postCat->id .'class="edit"><i class="fa fa-pencil"
                            aria-hidden="true"></i></a></li>
                <li><a url-delete="'.route('postCats.delete').'" title="Xóa" data-id="'. $postCat->id .'" class="delete remove-row"><i class="fa fa-trash"
                            aria-hidden="true"></i></a></li>
            </ul>
        </td>
        <td><span class="tbody-text">' . $postCat->id . '</span></td>
        <td><span class="tbody-text">'. self::active($postCat->active) .'</span></td>
        <td><span class="tbody-text">' . $postCat->parent_id . '</span></td>
        <td><span class="tbody-text">' . $postCat->updated_at . '</span></td>
    </tr>';
                unset($postCats[$key]);
                $html .= self::postCat($postCats, $postCat->id, $char . '--');
                
            }

        }
        return $html;
    }
    public static function active($active = 0) :string
    {
        return $active == 0 ? '<span>Không</span>' : '<span>Có</span>';
    }

    public static function productCat($productCats, $parent_id = 0, $char = '')
    {
        global $count;
        $html = '';
        foreach ($productCats as $key => $productCat) {
            if ($productCat->parent_id == $parent_id) {
                $count++;
                $html .= '<tr>
        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
        <td><span class="tbody-text">' . $count . '</h3></span>
        <td class="clearfix">
            <div class="tb-title fl-left">
                <a href="" title="">' . $char . $productCat->name . '</a>
            </div>
            <ul class="list-operation fl-right">
                <li><a href="'.route('productCat.show', ['productCat' => $productCat->id]).'" title="Sửa" data-id="'. $productCat->id .'class="edit"><i class="fa fa-pencil"
                            aria-hidden="true"></i></a></li>
                <li><a url-delete="'.route('productCat.delete').'" title="Xóa" data-id="'. $productCat->id .'" class="delete remove-row"><i class="fa fa-trash"
                            aria-hidden="true"></i></a></li>
            </ul>
        </td>
        <td><span class="tbody-text">' . $productCat->id . '</span></td>
        <td><span class="tbody-text">'. self::active($productCat->active) .'</span></td>
        <td><span class="tbody-text">' . $productCat->parent_id . '</span></td>
        <td><span class="tbody-text">' . $productCat->updated_at . '</span></td>
    </tr>';
                unset($productCats[$key]);
                $html .= self::productCat($productCats, $productCat->id, $char . '--');
                
            }

        }
        return $html;
    }
}
