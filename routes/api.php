<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::group(["middleware" => ["auth:sanctum"]], function() {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    Route::controller(BlogController::class)->prefix('blog')->name('blog')->group(function() {
        Route::post('/create', 'create');
        Route::post('/update/{id}', 'update');
        Route::get('/show', 'show');
        Route::delete('/delete/{id}', 'delete');

        // Comments and Reviews
    });


});
Route::controller(BlogController::class)->prefix('blog')->name('blog')->group(function() {
    Route::post('/comment/{id}', 'commentsPost');
});


// Route::get('/user', function() {
//     $user = User::all();
//     return response()->json([
//         'users' => $user
//     ]);
// });



