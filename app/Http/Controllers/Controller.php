<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function sendJson($status, $message, $data = [])
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }


    public function successResponse($data = [], $message = "OK")
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function failedResponse($message)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ]);
    }
    public function okResponse($message)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }
}
