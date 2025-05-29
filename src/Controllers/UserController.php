<?php

namespace App\Controllers;
Use App\Http\Request;
Use App\Http\Response;
use App\Middleware\Authorization;
Use App\Services\UserServices;
use App\Utils\Validator;

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
      $body = $request::body();

      //Userservices cuidará das regras de negócios;
      $userService = UserServices::create($body);

      if(isset($userService['error'])){
        return $response::json($userService['error'], $userService['code'], 'error');
      }

      $response::json($userService, 200, 'success');
   }

   public function login(Request $request, Response $response){
      $body = $request::body();

      $userService = UserServices::login($body);
      if(isset($userService['error'])){
         return $response::json($userService['error'], $userService['code'], 'error');
      }

      $response::json($userService, 200, 'success');
   }

   public function fetch(Request $request, Response $response){

      $authenticatedUser = Authorization::check();
      if(isset($authenticatedUser['error'])){
         return $response::json($authenticatedUser['error'], $authenticatedUser['code'], 'error');
      }

      $userService = UserServices::fetch($authenticatedUser['id']);
      if(isset($userService['error'])){
         return $response::json($userService['error'], $userService['code'], 'error');
      }

      $response::json($userService, 200, 'success');
   }

   public function update(Request $request, Response $response){

      $authenticatedUser = Authorization::check();
      if(isset($authenticatedUser['error'])){
         return $response::json($authenticatedUser['error'], $authenticatedUser['code'], 'error');
      }

      $data = $request::body();
      $userService = UserServices::update($data, $authenticatedUser['id']);

      if(isset($userService['error'])){
         return $response::json($userService['error'], $userService['code'], 'error');
      }

      $response::json($userService, 200, 'success');
   }

   public function remove(Request $request, Response $response){
      $authenticatedUser = Authorization::check();
      if(isset($authenticatedUser['error'])){
         return $response::json($authenticatedUser['error'], $authenticatedUser['code'], 'error');
      }

      $userService = UserServices::delete($authenticatedUser['id']);

      if(isset($userService['error'])){
         return $response::json($userService['error'], $userService['code'], 'error');
      }

      $response::json($userService, 200, 'success');

   }
}