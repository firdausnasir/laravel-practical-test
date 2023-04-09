<?php

namespace App\Helpers;

class ApiResponseHelper
{
    public static function common(string $message, ?\Throwable $exception = null, int $code = 500)
    {
        $data = [
            'message' => $message,
        ];

        if (config('app.debug')) {
            $data = array_merge($data, [
                'error' => $exception?->getMessage(),
                'file'  => $exception?->getFile(),
                'line'  => $exception?->getLine(),
            ]);
        }

        return response($data, $code);
    }
}