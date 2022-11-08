<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::get('/index', function () {
    return redirect('/');
})->name('index');


Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->middleware('auth')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('view-post/{id}', [\App\Http\Controllers\PostController::class, 'show']);

    Route::get('create-post', [\App\Http\Controllers\PostController::class, 'create'])->can('create', Post::class);
    Route::post('store-post', [\App\Http\Controllers\PostController::class, 'store'])->can('create',Post::class);

    Route::get('edit-post/{id}', [\App\Http\Controllers\PostController::class, 'edit'])->can('update',Post::class);
    Route::post('update-post', [\App\Http\Controllers\PostController::class, 'update'])->can('update',Post::class);

    Route::get('delete-post/{id}', [\App\Http\Controllers\PostController::class, 'delete'])->can('delete',Post::class);


});



require __DIR__.'/auth.php';

require __DIR__.'/api.php';
