<?php

namespace Application\Helpers;

class Response
{
    public static function success($message = null, $data = [], $code = 200)
    {
        self::mountResponse($message, $data, $code, true);
    }

    public static function fail($message = null, $data = [], $code = 400)
    {
        self::mountResponse($message, $data, $code, false);
    }

    private static function mountResponse($message = null, $data = [], $code = 200, $success = true)
    {
        http_response_code($code);

        $response = [
            'success' => $success,
            'code' => $code
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        if (!empty($data)) {
            $response['data'] = $data;
        }

        echo json_encode($response);
        exit();
    }
}