<?php

namespace App\Utils;

use Exception;

/**
 * Validators: Valida os dados de acordo o tipo de dado necessário. 
 */

class Validators{
   public static function checkEmptyFields(array $fields):array{
      foreach($fields AS $field => $value){
         if(empty(trim($value))){
            throw new Exception("The field ($field) is required.");
         }
      }
      return $fields;
   }

   public static function validateString($string, int $min, int $max):bool{
      if(!is_string($string)) return false;
      if(strlen($string) < $min || strlen($string) > $max) return false;

      return true;
   }

   public static function validateBool($bool):bool{
      if(!is_bool($bool)) return false;

      return true;
   }

   public static function validateNumeric($num, $mustBeingIntOrFloat = false){
      if(!is_numeric($num)) return false;

      if($mustBeingIntOrFloat){
         if(!is_int($num) || !is_float($num)) return false;
      }

      return true;
   }
}