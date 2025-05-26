<?php

namespace App\Models;

class UserModel{
   public string $name;
   public string $email;
   public string $image;

   public function __construct(array $data){
      $this->name = $data['name'];
      $this->email = $data['email'];
      $this->image = $data['image'];
   }
}