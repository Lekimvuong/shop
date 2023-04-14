<?php

namespace app\Helpers;

class Helper
{
    public $count;
    public static function post($posts, $parent_id = 0, $char = '')
    {
        global $count;
        $html = '';
        foreach ($posts as $key => $post) {
            if ($post->parent_id == $parent_id) {
                $count++;
                $html .= '<tr>
        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
        <td><span class="tbody-text">' . $count . '</h3></span>
        <td class="clearfix">
            <div class="tb-title fl-left">
                <a href="" title="">' . $char . $post->name . '</a>
            </div>
            <ul class="list-operation fl-right">
                <li><a href="'.route('posts.edit', ['post' => $post->id]).'" title="Sửa" data-id="'. $post->id .'class="edit"><i class="fa fa-pencil"
                            aria-hidden="true"></i></a></li>
                <li><a url-delete="'.route('posts.delete').'" title="Xóa" data-id="'. $post->id .'" class="delete remove-row"><i class="fa fa-trash"
                            aria-hidden="true"></i></a></li>
            </ul>
        </td>
        <td><span class="tbody-text">' . $post->id . '</span></td>
        <td><span class="tbody-text">' . $post->active . '</span></td>
        <td><span class="tbody-text">' . $post->parent_id . '</span></td>
        <td><span class="tbody-text">' . $post->updated_at . '</span></td>
    </tr>';
                unset($posts[$key]);
                $html .= self::post($posts, $post->id, $char . '--');
                
            }

        }
        return $html;
    }
}
