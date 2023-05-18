<?php
namespace App\Helpers;

class AlertMessage
{

    protected static $response = [
        'status' => 'success',
        'message' => 'OK'
    ];

    public static function success(string $message): array
    {
        self::$response['message'] = $message;
        return self::$response;
    }
    public static function danger(string $message): array
    {
        self::$response['status'] = 'danger';
        self::$response['message'] = $message;
        return self::$response;
    }
}
