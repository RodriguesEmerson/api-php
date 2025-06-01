<?php

namespace App\Core;
Use App\Http\Request;
Use App\Http\Response;

/**
 * Core.php -> dispatch -> Responsável por despachar para o Controller responsável pela Rota enviada.
 * @param array $routes -> Rotas com seus métodos ['path', 'action' => 'Controller @ method', 'HTTP method']
 */
class Core{

   public static function dispatch(array $routes){
      //url = http://localhost/api-php/app -> 'app' está depois da barra;
      //Se na url for passado algo depois da barra, é porque existe uma url
      //e então cocatena a barra com a url;
      $url = '/';
      isset($_GET['url']) && $url .= $_GET['url'];

      //Retira a barra da direita caso seja diference de Home('/');
      $url !== '/' && $url = rtrim($url, '/');

      $prefixController = 'App\\Controllers\\';
      $routeFound = false;

      foreach ($routes as $route) {
         //Pega o id enviado, se for enviado, e o transforma em alfanumérico;
         $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

         if(preg_match($pattern, $url, $matches)){
            array_shift($matches);
            
            $routeFound = true;
            //Se o método enviado for dirente do método permitido na rota, retorna um erro 405;
            if($route['method'] !== Request::method()){
               Response::json([
                  'error' => true,
                  'success' => false,
                  'message' => 'Method not allowed.'
               ], 405);
               return;
            }

            //Ex: $route['action'] = 'HomeController@fetch';
            [$controller, $action] = explode('@', $route['action']); 

            // App\\Controllers\\HomeController->fetch()
            $controller = $prefixController . $controller; 
            $extendController = new $controller();

            try{
               $extendController->$action(new Request, new Response, $matches);
            }catch(\Throwable $e){
               Response::json('Internal server error.', 500, 'error');
            }
         }
      }

      if(!$routeFound){
         $controller = $prefixController . 'NotFoundController';
         $extendController = new $controller();
         $extendController->index(new Request, new Response); //Injeção de dependências;
      }
   }
}