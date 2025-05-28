<?php

namespace App\Repositories;

/**
 * UserRepository é responsável por se comunicar diretamente com o Database.
 * Herda $pdo de BaseRepository;
 * UserRepository->save: Cria um novo usuário no Database;
 *    @param array $data: Dados do novo usuário a ser criado.
 *    @return bool
 */

class UserRepository extends BaseRepository {

   public function save(array $data):bool{
      $stmt = $this->pdo->prepare(
         'INSERT INTO `users` (`id`, `name`, `email`, `lastname`, `start_date`, `password`, `image`)
          VAlUES (:id, :name, :email, :lastname, :start_date, :password, :image)'
      );

      return $stmt->execute([
         ':id'          => $data['id'],
         ':name'        => $data['name'],
         ':email'       => $data['email'],
         ':lastname'    => $data['lastname'],
         ':start_date'  => $data['start_date'],
         ':password'    => $data['password'],
         ':image'       => $data['image'],
      ]);

      //Se ocorrer tudo ok ao usuário, retornará true;
      //Usado quando o id é (int) autoincremet
       // return $this->pdo->lastInsertId() > 0 ? true : false;
   }

   public function auth(array $data){
      $stmt = $this->pdo->prepare(
         'SELECT * FROM `users` WHERE `email` = ?'
      );
      $stmt->execute([$data['email']]);

      if($stmt->rowCount() < 1) return false;

      $user = $stmt->fetch(\PDO::FETCH_ASSOC);

      if(!password_verify($data['password'], $user['password'])) return false;

      return [
         'id' => $user['id'],
         'name' => $user['name'],
         'email' => $user['email']
      ];
   }

   public function find(string $id){
      $stmt = $this->pdo->prepare(
         'SELECT `id`, `name`, `email` FROM `users` WHERE `id` = ?'
      );
      $stmt->execute([$id]);
      return $stmt->fetch(\PDO::FETCH_ASSOC);
   }

   public function update(int|string $id, string $name){
      $stmt = $this->pdo->prepare(
         'UPDATE `users` set `name` = :name WHERE `id` = :id'
      );
      return $stmt->execute([':id' => $id, ':name' => $name]);
   }

   public function delete(int|string $id){
      $stmt =  $this->pdo->prepare(
         'DELETE FROM `users` WHERE `id` = :id'
      );
      return $stmt->execute([':id' => $id]);
   }
   
}