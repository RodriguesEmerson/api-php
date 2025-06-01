<?php

namespace App\Enums;

enum UserAction: string {
   case SAVE = 'save';
   case FIND = 'find';
   case AUTH = 'auth';
   case UPDATE = 'update';
   case DELETE = 'delete';
}