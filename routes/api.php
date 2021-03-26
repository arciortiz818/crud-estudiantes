<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/estudiantes',[StudentController::class,'index'])->name('list-students');
Route::get('/estudiantes/{id}',[StudentController::class,'show'])->name('show-student');
Route::post('/estudiantes',[StudentController::class,'store'])->name('add-student');
Route::put('/estudiantes/{id}',[StudentController::class,'update'])->name('update-student');
Route::delete('/estudiantes/{id}',[StudentController::class,'destroy'])->name('delete-student');

// Route::apiResource('/estudiantes',StudentController::class);