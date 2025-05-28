<?php

namespace App\Utils;

class DatabaseErrorMessage{

   public static $message;
   public static function getMessageBasedOnError(string $errorInfo){
      match ($errorInfo) {
         '23000' => self::$message = ['error' => 'This email alreay exists.', 'code' => 400],
         default => self::$message = ['error' => 'Sorry, we could not complete this action.', 'code' => 500],
      };

      return self::$message;
   }
}