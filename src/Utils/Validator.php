<?php

namespace App\Utils;

use Exception;

class Validator{
   public static function validate(array $fields):array{

      foreach($fields AS $field => $value){
         //Aqui deve ter uma validação mais forte;
         if(empty(trim($value))){
            throw new Exception("The field ($field) is required.");
         }
      }

      return $fields;
   }
}