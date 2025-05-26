<?php

namespace App\Http;

/**
 * Response -> É responsável por enviar a resposta, seja erro, bool e dados. 
 *    -json -> Envia a resposta no formato json
 * Poderia haver outros métodos para responder em outros formatos com XML por exemplo.
 * @param array $data -> Dados que serão enviados para o frontend;
 * @param int $status -> Status code da resposta
 */
class Response{
   public static function json(array $data = [], int $status = 200){
      http_response_code($status);
      header('Content-Type: application/json');

      echo json_encode($data);
   }
}