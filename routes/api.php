<?php

use App\Models\Post;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.basic.once')->group(function () {

    Route::get('api/view-posts', [\App\Http\Controllers\ApiController::class, 'showAll']);

    Route::get('api/view-post/{id}', [\App\Http\Controllers\ApiController::class, 'show']);

    Route::post('api/store-post', [\App\Http\Controllers\ApiController::class, 'store'])->can('create',Post::class);

    Route::patch('api/update-post/{id}', [\App\Http\Controllers\ApiController::class, 'update'])->can('update',Post::class);

    Route::delete('api/delete-post/{id}', [\App\Http\Controllers\ApiController::class, 'delete'])->can('delete',Post::class);


});
