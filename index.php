<?php 
//Habilita o acesso as Classes ou Métodos a partir de Namespaces
require_once  __DIR__ ."/vendor/autoload.php";

//Necessário para habilitar o arquivo ja que não há namespace.
require_once __DIR__ . '/src/routes/main.php';

use App\Core\Core;
use App\Http\Route;

use App\Config\EnvLoader;
EnvLoader::load();

Core::dispatch(Route::routes());