<?php

namespace App\Helpers;


class Message
{
    public static function Message($data = null, $is_success = true)
    {
        if ($is_success === true) {
            $data = ['error' => 0, 'message' => 'عملیات انجام شد', 'data' => $data];
            return response($data)->header('Access-Control-Allow-Origin', "*")
                ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, HEAD')
                ->header('Access-Control-Allow-Headers', 'X-Requested-With');
        } else {
            $data = ['error' => 1, 'message' => 'عملیات انجام نشد', 'data' => $data === null ? 0 : $data];
            return response($data)->header('Access-Control-Allow-Origin', "*")
                ->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, HEAD')
                ->header('Access-Control-Allow-Headers', 'X-Requested-With');
        }
    }
}
