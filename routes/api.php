<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Postcontroller;
use App\Http\Controllers\CommentController;


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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('signup', [AuthController::class,'signup']);
    Route::get('signup', [AuthController::class,'signup']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::get('me', [AuthController::class,'me']);

    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']); 
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);
    Route::post('changePassword/{token}', [ResetPasswordController::class, 'updatePassword']);
 
    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class);
    Route::post('{post_id}/comments', [CommentController::class,'store']);
    Route::post('comments/{id}', CommentController::class, 'distroy');


     

});

  Route::get('admin', function(){
      return view('auth.auth-page');
  });
  Route::get('admin/home', function () {
    return view('auth.auth-page');
  });