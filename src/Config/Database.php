<?php

namespace App\Config;

//Como está sendo usando 'namespace' é necessario usar '\' antes de PDO e PDOExeption.
//A '\' informa ao PHP que elas são Classes Globais.
//Ou então chamá-las (Use PDO, use PDOException)

class Database{
   private static $pdo;

   public static function getConnection(){
      if(!self::$pdo){
         $db = $_ENV['DB_NAME']        ?? '';
         $host = $_ENV['DB_HOST']      ?? '';
         $user = $_ENV['DB_USER']      ?? '';
         $password = $_ENV['DB_PASS']  ?? '';

         try{
               self::$pdo = new \PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", "$user", "$password");
               self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
            }catch(\PDOException $e){
               header('Content-Type: application/json');
               echo json_encode(['message' => 'It was not possible conneting to the database, try again.']);
               die();
            }
      }
      return self::$pdo;
   }
}
