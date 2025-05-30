<?php

namespace App\Services;

use App\Enums\UserAction;
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
 * @return message Mensagem de sucesso ou erro junto com o code do tipo do erro[400, 401, 404, 500, etc...].
 */

class UserServices{

   public static function create(array $data):array|string{
      $data = new UserCreateModel($data);
      $data = $data->toArray();
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

      $user = self::runRepositoryAction($data, UserAction::SAVE);

      if(isset($user['error'])) return $user; //Exeption error
      if(!$user) return ['error' => 'This email is already taken.', 'code' => 400];

      return 'User created successfully!';
   }


   public static function login(array $data):array|string{

      $data = new UserAuthModel($data);
      $data = $data->toArray();
      $user = self::runRepositoryAction($data, UserAction::AUTH);
      
      if(isset($user['error'])) return $user; //Exeption error
      if(!$user) return ['error' => 'Email or password is incorrect.', 'code' => 400];

      return JWT::generete($user);
   }


   public static function fetch(string $id):array{
      
      $user = self::runRepositoryAction($id, UserAction::FIND);

      if(isset($user['error'])) return $user; //Expetion error
      if(!$user) return ['error' => 'User not found.', 'code' => 404];

      return $user;
   }


   public static function update(array $data, string $userId):array|string{

      $wasUserCreated = self::runRepositoryAction(['name' => $data['name'], 'id' => $userId], UserAction::UPDATE);

      if(isset($wasUserRemoved['error'])) return $wasUserCreated; //Expetion error
      if(!$wasUserCreated) return ['error' => 'Sorry, it was not possible updating your data, try again.', 'code' => 500];

      return 'Your data has been updated successfully';
   }


   public static function delete(string $userId):array|string{
      $wasUserRemoved = self::runRepositoryAction($userId, UserAction::DELETE);

      if(isset($wasUserRemoved['error'])) return $wasUserRemoved; //Exeption error
      if(!$wasUserRemoved) return ['error' => 'It was not possible delete the user. The user was not found.', 'code' => 400];

      return 'User deleted successfully';
   }


   public static function runRepositoryAction($data, UserAction $action):mixed{
      $userRepository = new UserRepository();
      try{  

         $allowedActions = [
            UserAction::SAVE->value => fn($data) => $userRepository->save($data),
            UserAction::AUTH->value => fn($data) => $userRepository->auth($data),
            UserAction::FIND->value => fn($data) => $userRepository->find($data),
            UserAction::UPDATE->value => fn($data) => $userRepository->update($data),
            UserAction::DELETE->value => fn($data) => $userRepository->delete($data),
         ];
         
         if  (!in_array($action->value, array_keys($allowedActions), true)) {
            throw new \Exception("Invalid repository action: {$action}");
         }

         $result = $allowedActions[$action->value]($data);
         return $result ?: false;

      }catch(\PDOException $e){
         return DatabaseErrorMessage::getMessageBasedOnError($e->errorInfo[0]);
      }catch (\Exception $e){
         return ['error' => $e->getMessage(), 'code' => 400];
      }

   }
}