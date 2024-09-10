<?php

namespace App\Http\Controllers;

use App\Jobs\CreateUserJob;
use Illuminate\Http\Request;

class TestingAndCreatingDataController extends Controller
{
    public function createData()
    {
        for ($i = 0; $i < 89; $i++) {
            CreateUserJob::dispatch();
        }

        return response()->json(['message' => 'Se han iniciado 1000 jobs para crear usuarios']);
    }
    
}

// 1. Crear un Job
// php artisan make:job ProcessLongRunningTask
// 2. Definir el Job (app/Jobs/ProcessLongRunningTask.php)

// 4. Configurar y ejecutar el worker de colas
// En tu archivo .env
// QUEUE_CONNECTION=database

// Ejecutar el worker (en la terminal)
// php artisan queue:work


