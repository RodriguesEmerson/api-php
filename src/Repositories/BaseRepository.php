<?php

namespace App\Repositories;
use App\Config\Database;

/**
 * BaseRepository é a classe que fornece as outras classes, que precisam se comunicar o
 * Database, o $pdo, ou seja, a conexão com o Database. Dessa forma não e necessário 
 * recriar este código, apenas Herdar sua propriedade e método;
 */

abstract class BaseRepository{
   protected ?\PDO $pdo = null;

   public function __construct() {
      $this->pdo = Database::getConnection();
   }
}