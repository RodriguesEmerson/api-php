<?php

namespace App\Services;

use App\Utils\Validator;
use App\Repositories\UserRepository;

class UserServices{

   public static function create(array $data){

      try{
         //Fazendo dessa forma, mesmo se o usuário enviar outros dados além dos necessário, 
         //Apans os dados requeridos serão passados a frente.
         $fields = Validator::validate([
            'id'         => $data['id']          ?? '',
            'name'       => $data['name']        ?? '',
            'email'      => $data['email']       ?? '',
            'password'   => $data['password']    ?? '',
            'lastname'   => $data['lastname']    ?? '',
            'start_date' => $data['start_date']  ?? '',
            'image'      => $data['image']       ?? ''
         ]);

         $userReopsitory = new UserRepository();
         $fields['password'] =  password_hash($data['password'], PASSWORD_DEFAULT);
         $user = $userReopsitory->save($fields);

         if(!$user) return ['error' => 'We could not create your account.'];

         return 'User created successfully!';

      }catch(\PDOException $e){
         return ['error' => $e->getMessage()];
      }catch(\Exception $e){
         return ['error' => $e->getMessage()];
      }
   }
}