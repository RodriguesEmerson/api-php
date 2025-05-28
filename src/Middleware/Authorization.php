<?php

namespace App\Middleware;
use App\Http\JWT;
use App\Http\Request;

/**
 * Esta classe cuida do tratamento do token.
 * @return array Se for um token inválido, retorna a mensagem e o código de erro.
 * @return array Se for um token válido, retorna os dados do usuário que está contido nele, se não retona false.
 */

class Authorization{
   public static function check(){
      $authorization = Request::authorization();

      if(isset($authorization['error'])) return ['error' => $authorization['error'], 'code' => 401]; 

      $authenticatedUser = JWT::verify($authorization);

      if(!$authenticatedUser) return ['error' => 'Please login to continue', 'code' => 401]; 

      return $authenticatedUser;
   }
}