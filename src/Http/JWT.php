<?php

namespace App\Http;

/**
 * Essa class é apenas para fins didádicos, pois não é tão completa quanto 
 * a class que o própria JWT fornece, dá para implementar, mas não é preciso.
 * Como instalar: rodar "composer require firebase/php-jwt" no terminal.
 */

class JWT{

   public static function generete(array $data){
      $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
      $payload = json_encode($data);

      $base64ulrHeader = self::base64_encode($header);
      $base64ulrPayload = self::base64_encode($payload);
      $signature = self::signature($base64ulrHeader, $base64ulrPayload);

      $jwt = $base64ulrHeader . "." . $base64ulrPayload . "." . $signature;
      return $jwt;
   }

   public static function verify(string $jwt){
      $tokenPartials = explode('.', $jwt);
      if(count($tokenPartials) != 3) return false;

      [$header, $payload, $signature] = $tokenPartials;

      if($signature !== self::signature($header, $payload)) return false;

      return self::base64url_decode($payload);
   }

   public static function signature(string $header, string $payload){
      $signature = hash_hmac('sha256', $header . "." . $payload, getenv('JWT_SECRET_KEY', true));
      return self::base64_encode($signature);
   }

   public static function base64_encode($data){
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
   }

   public static function base64url_decode($data) {
      $dataDecoded = base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
      return json_decode($dataDecoded, true);
   }
}