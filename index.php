<?php 
//Habilita o acesso as Classes ou Métodos a partir de Namespaces
require_once  __DIR__ ."/vendor/autoload.php";

//Necessário para habilitar o arquivo já que não há namespace.
require_once __DIR__ . '/src/routes/main.php';

use App\Config\EnvLoader;
use App\Core\Core;
use App\Http\Route;

//Carrega as variáveis de ambiente.
EnvLoader::load();

//Carrega as rotas
Core::dispatch(Route::routes());