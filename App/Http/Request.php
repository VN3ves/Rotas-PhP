<?php
namespace App\Http;

class Request
{
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function body()
    {
        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $data = match(self::method()) {
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json
        };

        return $data;
  
    }

    public static function headerAuthorization()
    {
       $authorization = getallheaders();

       if(!isset($authorization['Authorization'])) 
           return ['error' => true, 'success' => false, 'message' => 'Sorry, Authorization not found.'];

       $authorizationParts = explode(' ', $authorization['Authorization']);
       
         if(count($authorizationParts) !== 2) 
              return ['error' => true, 'success' => false, 'message' => 'Sorry, Authorization invalid.'];

       return $authorizationParts[1] ?? '';       
       
    }
}
