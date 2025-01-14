<?php

namespace App\Api;

trait ResponseTrait
{
    public function ok($statusCode = 200, $message, $data = [])
    {
        return response()->json([
            'statusCode' => $statusCode,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public function error($statusCode = 400, $message)
    {
        return response()->json([
            'statusCode' => $statusCode,
            'message' => $message,
        ], $statusCode);
    }
}
