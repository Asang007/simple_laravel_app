<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Utils
{
    public static function responseReturn($status_code, $success, $message, $data = []) {
        return [
            'response' => $status_code,
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ];
    }
}