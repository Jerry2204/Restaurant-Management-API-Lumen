<?php

namespace App\Http\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{

    /**
     * Return a success response.
     *
     * @param mixed $data
     * @param string $message
     * @param integer $code
     * @return JsonResponse
     */
    public static function success($data, $message = 'Request was successful', $code = 200) : JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return a failure response.
     *
     * @param string $message
     * @param integer $code
     * @param mixed $errors
     * @return JsonResponse
     */
    public static function error($message = 'Something went wrong', $code = 500, $errors = null) : JsonResponse
    {
        return response()->json([
            'code' => $code,
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
