<?php

use App\Http\Modules\Equipment\EquipmentController;
use App\Http\Modules\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Регистрация пользователей
Route::post('/user/register', [UserController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    //Получение типов оборудования
    Route::get('/equipment-type', [EquipmentController::class, "getEquipmentTypes"]);
    //Создание оборудования
    Route::post('/equipment', [EquipmentController::class, "createEquipment"]);
    //Обновление оборудования
    Route::put('/equipment/{id}', [EquipmentController::class, "updateEquipment"])->where('id', '[0-9]');
    //Удаление оборудования
    Route::delete('/equipment/{id}', [EquipmentController::class, "deleteEquipment"])->where('id', '[0-9]');
    //Получение оборудования по id
    Route::get('/equipment/{id}', [EquipmentController::class, 'getEquipmentById'])->where('id', '[0-9]');
    //Получение оборудования
    Route::get('/equipment', [EquipmentController::class, 'getEquipment']);
});
