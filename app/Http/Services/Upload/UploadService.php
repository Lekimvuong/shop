<?php
namespace App\http\Services\Upload;

class UploadService
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                 $pathFull = 'uploads/' . date("Y/m/d");
                $name = $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs(
                  'public/' . $pathFull, $name
                 );

                return '/shop/public/storage/' . $pathFull . '/' . $name;
            } catch (\Exception  $error) {
                return false;
            }
        }

    }
}
