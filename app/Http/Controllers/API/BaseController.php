<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function sendResponse($result, $message = "OK", $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message'=> $message,
        ];

        if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}