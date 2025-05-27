<?php

namespace App\Http;

/**
 * Request -> Resposável por pegar o método enviado na requisição -[GET, POST, PUT, DELETE];
 * @return string -> O método capturado;
 * 
 */
class Request{
   public static function method(){
      return $_SERVER['REQUEST_METHOD'];
   }

   public static function body(){
      $json = json_decode(file_get_contents('php://input'), true) ?? [];

      $data = match (self::method()) {
         'GET' => $_GET,
         'POST', 'PUT', 'DELETE' => $json
      };

      return $data;
   }

   public static function authorization(){
      $authorization = getallheaders();

      if(!isset($authorization['Authorization'])) return ['error' => 'No authorization header provided.'];

      $authorizationPartials = explode(' ', $authorization['Authorization']);

      if(count($authorizationPartials) != 2) return ['error' => 'Invalid authorization header.'];

      return $authorizationPartials[1] ?? '';
   }
}