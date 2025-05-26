<?php

namespace App\Models;

/**
 * UserModel pega e formata os dados enviados;
 * @param array $data: Dados enviados;
 * UserModel->toArray: 
 *    @return array: Retorna os dados formatados;
 */

class UserModel{
   public string $id;
   public string $name;
   public string $lastname;
   public string $email;
   public string $password;
   public string $image;
   public string $start_date;

   public function __construct(array $data){
      $this->id         = trim($data['id']               ?? '');
      $this->name       = trim($data['name']             ?? '');
      $this->lastname   = trim($data['lastname']         ?? '');
      $this->email      = strtolower(trim($data['email'] ?? ''));
      $this->password   = trim($data['password']         ?? '');
      $this->image      = trim($data['image']            ?? '');
      $this->start_date = trim($data['start_date']       ?? '');
   }

   public function toArray(): array {
      return [
         'id'          => $this->id,
         'name'        => $this->name,
         'lastname'    => $this->lastname,
         'email'       => $this->email,
         'password'    => $this->password,
         'image'       => $this->image,
         'start_date'  => $this->start_date,
      ];
}
}