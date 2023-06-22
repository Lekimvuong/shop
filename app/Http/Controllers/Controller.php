<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function iRespond($status, $message = '', $data = [], $error = null)
    {
        return Response::json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'error' => $error
        ]);
    }
}
