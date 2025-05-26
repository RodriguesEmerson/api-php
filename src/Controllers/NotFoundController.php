<?php

namespace App\Controllers;
Use App\Http\Request;
Use App\Http\Response;

/**
 * Casso o usuário passe um endpoint incorreto, esssa class será chamada;
 * @param class Request $request -> method Método da request feita;
 * @param class Response $response -> Método responsável pela resposta ao frontend;
 */
class NotFoundController{
   //Em casdos de injeção de dependências, os parâmtros devem ser recebidos dessa forma, não esquecendo de importá-las;
   public function index(Request $request, Response $response){
      $response::json([
         'error' => true,
         'success' => false,
         'message' => 'Route not found.'
      ], 404);
      return;
   }
}