<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskManagerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/addtask', [TaskManagerController::class, 'addtask']);

Route::post('/gettasks', [TaskManagerController::class, 'gettasks']);
Route::post('/updateTask', [TaskManagerController::class, 'updateTask']);
Route::post('/deleteTask', [TaskManagerController::class, 'deleteTask']);
Route::post('/gettasks', [TaskManagerController::class, 'gettasks']);
Route::post('/updatedraggable', [TaskManagerController::class, 'updatedraggable']);
Route::post('/createproject', [TaskManagerController::class, 'createproject']);
Route::post('/getprojects', [TaskManagerController::class, 'getprojects']);