<?php

    namespace App\Traits;

    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Response;

    trait ApiResponder
    {
        /**
         * Build Success Response
         * @param string|array $data
         * @param int $code
         * @return JsonResponse
         */
        public function successResponse($data, int $code = Response::HTTP_OK)
        {
            return response()->json($data);
        }

        /**
         * Build Error Response
         * @param string|array $message
         * @param int $code
         * @return JsonResponse
         */
        public function errorResponse($message, $code)
        {
            return response()->json([
                'error' => $message,
                'code' => $code
            ], $code);
        }

        /**
         * Send a server error API response
         * @param $message
         * @param $code
         * @return JsonResponse
         */
        public function serverErrorResponse($message, $code)
        {
            return response()->json([
                'error' => [
                    'Server Error' => $message
                ],
                'code' => $code
            ], $code);
        }

    }
