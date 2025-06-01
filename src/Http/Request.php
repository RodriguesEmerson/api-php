<?php

namespace App\Http;

/**
 * Request->method: Pega o método enviado na requisição -[GET, POST, PUT, DELETE];
 * @return string O método capturado;
 * Request->authorization: Pega o token enviado.
 * @return array|string Retorna um erro, se o token não ter o formato correto ou não for fornecido, ou o token pré-validado.
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