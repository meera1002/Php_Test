<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * Build success response
     * @param string/array $data
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function successResponse($message, $code = Response::HTTP_OK)
    {
        return  response()->json(['success' => $message, 'code' => $code ], $code);
    }

    /**
     * Build error response
     * @param string/array $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */
    public function errorResponse($message, $code) 
    {
        if(is_string($message)){
            return response()->json(['error' => $message, 'code' => $code ], $code);
        }
        return response($message, $code);
    }

    /**
     * Build error message
     * @param string/array $data
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function errorMessage($data, $code = Response::HTTP_OK) 
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }


}

