<?php

namespace App\Controllers;
Use App\Http\Request;
Use App\Http\Response;
Use App\Services\UserServices;


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

      //O Userservices cuidará das regras de negócios;
      $userService = UserServices::create($body);

      if(isset($userService['error'])){
         return $response::json([
            'error' => true, 
            'success' => false,
            'data' => $userService['error']
         ]);
      }

      $response::json([
         'error' => false, 
         'success' => true,
         'data' => $userService
      ], 201);
   }

   public function login(Request $request, Response $response){

   }

   public function fetch(Request $request, Response $response){

   }

   public function update(Request $request, Response $response){

   }

   public function remove(Request $request, Response $response, array $id){

   }
}