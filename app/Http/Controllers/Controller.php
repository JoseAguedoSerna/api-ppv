<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function errorResponse($message)
    {
        $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
        return response()->json([
            'success' => false,
            'title' => 'Validation errors',
            'msg' => $message
        ], $statusCode);
    }
}
