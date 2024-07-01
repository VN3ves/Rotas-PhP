<?php
namespace App\Http;

class Response
{
    public static function json(array $data = [], $status = 200, $headers = [])
    {
        http_response_code($status);
        header('Content-Type: application/json');
        foreach($headers as $key => $value) {
            header("{$key}: {$value}");
        }
        echo json_encode($data);
    }
}