<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenusController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// post manda datos
// get obtener datos
// update envia actualiza datos
// delete envia actualiza estatus



// TODOS los catalogos
Route::prefix('catalogos')->group(function (){
    Route::get('obtienemenus',[MenusController::class,'index']);
    Route::post('guardamenus',[MenusController::class,'store']);
    Route::post('actualizamenus',[MenusController::class,'update']);
    Route::post('eliminamenus',[MenusController::class,'destroy']);
});
