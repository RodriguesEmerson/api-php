<?php

namespace App\Services;

use App\Http\JWT;
use App\Models\UserModels\UserCreateModel;
use App\Models\UserModels\UserAuthModel;
use App\Utils\Validator;
use App\Repositories\UserRepository;
use App\Utils\DatabaseErrorMessage;

/**
 * UserService é responsável pelas regras de negócio e se comunicar com o Repository;
 * UserService->create(): Verifica as regras de negócio e envia os dados para UserRepository.
 * @param array $data: Contém os dados enviados pelo usuário já validados por UserController.
 * @return message Mensagem de sucesso ou erro junto com o code do tipo do erro[400, 401, 500, etc...].
 */

class UserServices{

   public static function create(array $data){
      try{
         $userReopsitory = new UserRepository();

         $userModel = new UserCreateModel($data);
         $fields = Validator::validate($userModel->toArray());

         $fields['password'] =  password_hash($data['password'], PASSWORD_DEFAULT);
         $user = $userReopsitory->save($fields);

         if(!$user) return ['error' => 'We could not create your account.'];

         return 'User created successfully!';

      }catch(\PDOException $e){
         return  DatabaseErrorMessage::getMessageBasedOnError($e->errorInfo[0]);
      }catch(\Exception $e){
         return ['error' => $e->getMessage(), 'code' => 500];
      }
   }

   public static function login(array $data){
      try{
         $userReopsitory = new UserRepository();

         $userModel = new UserAuthModel($data);
         $fields = Validator::validate($userModel->toArray());

         $user = $userReopsitory->auth($fields);

         if(!$user) return ['error' => 'Email or password is incorrect.', 'code' => 400];

         return JWT::generete($user);

      }catch(\PDOException $e){
         return  DatabaseErrorMessage::getMessageBasedOnError($e->errorInfo[0]);
      }catch(\Exception $e){
         return ['error' => $e->getMessage(), 'code' => 500];
      }
   }

   public static function fetch(mixed $authorization){

      try{
         if(isset($authorization['error'])){
            return ['error' => $authorization['error'], 'code' => 400];
         }

         $userFromJWT = JWT::verify($authorization);

         if(!$userFromJWT) return ['error' => 'Please login to continue', 'code' => 401];

         return $userFromJWT;

      }catch(\PDOException $e){
         return  DatabaseErrorMessage::getMessageBasedOnError($e->errorInfo[0]);
      }catch(\Exception $e){
         return ['error' => $e->getMessage(), 'code' => 500];
      }
   }
}