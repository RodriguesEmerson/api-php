<?php

namespace App\Controllers;
Use App\Http\Request;
Use App\Http\Response;
use App\Middleware\Authorization;
Use App\Services\UserServices;
use App\Utils\Validators;

/**
 * Class UserController: Contém os métodos que manupulam as requisição ao endpoint user;
 * -UserController -> store|login|fetch|update|remove: Responsável por tratar os dados antes de mandá-los para os Repositories;    
 * @param class Request:
 *    $request -> method: Método da requisição feita;
 *    $request -> body: Corpo da requisição;
 * @param class Response $response -> json: Método responsável pela resposta ao frontend, em json; 
 */
class UserController{
   
   public function store(Request $request, Response $response){
      $data = $request::body();

      $hasEmptyField = Validators::checkEmptyFields($data);
      if($hasEmptyField) return $response::json($hasEmptyField['message'], 400, 'error');

      $serviceResponse = UserServices::create($data);

      if(isset($serviceResponse['error'])){
        return $response::json($serviceResponse['error'], $serviceResponse['code'], 'error');
      }

      $response::json($serviceResponse, 200, 'success');
   }

   public function login(Request $request, Response $response){
      $data = $request::body();

      $hasEmptyField = Validators::checkEmptyFields($data);
      if($hasEmptyField) return $response::json($hasEmptyField['message'], 400, 'error');

      $serviceResponse = UserServices::login($data);
      if(isset($serviceResponse['error'])){
         return $response::json($serviceResponse['error'], $serviceResponse['code'], 'error');
      }

      $response::json($serviceResponse, 200, 'success');
   }

   public function fetch(Request $request, Response $response){

      $authenticatedUser = Authorization::check();
      if(isset($authenticatedUser['error'])){
         return $response::json($authenticatedUser['error'], $authenticatedUser['code'], 'error');
      }

      $serviceResponse = UserServices::fetch($authenticatedUser['id']);
      if(isset($serviceResponse['error'])){
         return $response::json($serviceResponse['error'], $serviceResponse['code'], 'error');
      }

      $response::json($serviceResponse, 200, 'success');
   }

   public function update(Request $request, Response $response){

      $authenticatedUser = Authorization::check();
      if(isset($authenticatedUser['error'])){
         return $response::json($authenticatedUser['error'], $authenticatedUser['code'], 'error');
      }

      $data = $request::body();

      $hasEmptyField = Validators::checkEmptyFields($data);
      if($hasEmptyField) return $response::json($hasEmptyField['message'], 400, 'error');

      $serviceResponse = UserServices::update($data, $authenticatedUser['id']);

      if(isset($serviceResponse['error'])){
         return $response::json($serviceResponse['error'], $serviceResponse['code'], 'error');
      }

      $response::json($serviceResponse, 200, 'success');
   }

   public function remove(Request $request, Response $response){
      $authenticatedUser = Authorization::check();
      if(isset($authenticatedUser['error'])){
         return $response::json($authenticatedUser['error'], $authenticatedUser['code'], 'error');
      }

      $serviceResponse = UserServices::delete($authenticatedUser['id']);

      if(isset($serviceResponse['error'])){
         return $response::json($serviceResponse['error'], $serviceResponse['code'], 'error');
      }

      $response::json($serviceResponse, 200, 'success');

   }
}