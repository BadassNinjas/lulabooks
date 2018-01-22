<?php

namespace App\Helpers;

class Response
{
    public static function build($data = [], $code = 200)
    {
        if ($code == 200) {
            return [
              'success' => true,
              'payload' => $data,
            ];
        } else {
            return [
              'success' => false,
              'error'   => [
                'code' => $code,
                'desc' => $data
              ]
            ];
        }
    }
}
