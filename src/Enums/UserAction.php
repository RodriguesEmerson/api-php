<?php

namespace App\Enums;
/**
 * Métodos permitidos em UserRepository.
 */
enum UserAction: string {
   case SAVE = 'save';
   case FIND = 'find';
   case AUTH = 'auth';
   case UPDATE = 'update';
   case DELETE = 'delete';
}