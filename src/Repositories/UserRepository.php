<?php

namespace App\Repositories;

class UserRepository extends BaseRepository {

   public function save(array $data):bool{
      $stmt = $this->pdo->prepare(
         'INSERT INTO `users` (`id`, `name`, `email`, `lastname`, `start_date`, `password`, `image`)
          VAlUES (:id, :name, :email, :lastname, :start_date, :password, :image)'
      );
      
      return $stmt->execute([
         ':id' => $data['id'],
         ':name' => $data['name'],
         ':email' => $data['email'],
         ':lastname' => $data['lastname'],
         ':start_date' => $data['start_date'],
         ':password' => $data['password'],
         ':image' => $data['image'],
      ]);

      //Se ocorrer tudo ok ao usuário, retornará true;
      //Usado quando o id é (int) autoincremet
       // return $this->pdo->lastInsertId() > 0 ? true : false;
   }
   
}