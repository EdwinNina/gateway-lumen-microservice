<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Build a success response
     * @param string|array $data
     * @param int $code
     * @return Response
    */
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build a valid response
     * @param string|array $data
     * @param int $code
     * @return Response
    */
    public function validResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build am error response
     * @param string $message
     * @param int $code
     * @return JsonResponse
    */
    public function errorResponse($message, $code = Response::HTTP_OK)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Build an error message
     * @param string $message
     * @param int $code
     * @return JsonResponse
    */
    public function errorMessage($message, $code = Response::HTTP_OK)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
