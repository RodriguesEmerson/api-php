<?php

namespace App\Repositories;
use App\Config\Database;

abstract class BaseRepository{
   protected ?\PDO $pdo = null;

   public function __construct() {
      $this->pdo = Database::getConnection();
   }
}