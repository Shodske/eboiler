<?php

use App\Http\Controllers\BoilerController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::prefix('prices')->group(function ($router) {
    $router->get('', [PriceController::class, 'list']);
    $router->get('{price}', [PriceController::class, 'get']);
    $router->post('', [PriceController::class, 'create']);
    $router->patch('{price}', [PriceController::class, 'update']);
});

Route::prefix('boilers')->group(function ($router) {
    $router->get('', [BoilerController::class, 'list']);
    $router->get('{boiler}', [BoilerController::class, 'get']);
    $router->post('', [BoilerController::class, 'create']);
    $router->patch('{boiler}', [BoilerController::class, 'update']);

    // Relationships
    $router->get('{boiler}/schedules', [ScheduleController::class, 'list']);
});

Route::prefix('schedules')->group(function ($router) {
    $router->get('', [ScheduleController::class, 'list']);
    $router->get('{schedule}', [ScheduleController::class, 'get']);
    $router->post('', [ScheduleController::class, 'create']);
    $router->patch('{schedule}', [ScheduleController::class, 'update']);
});
