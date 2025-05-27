<?php

namespace App\Models\UserModels;

/**
 * UserModel pega e formata os dados enviados;
 * @param array $data: Dados enviados;
 * UserModel->toArray: 
 *    @return array: Retorna os dados formatados;
 */

class UserAuthModel{
   public string $email;
   public string $password;

   public function __construct(array $data){
      $this->email      = strtolower(trim($data['email'] ?? ''));
      $this->password   = trim($data['password']         ?? '');
   }

   public function toArray():array {
      return [
         'email'       => $this->email,
         'password'    => $this->password,
      ];
   }
}