<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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
Route::fallback(function(){
    return response()->json([
        'message' => 'Ошибка!'], 404, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
});
//Route::get('/apiList', [ApiController::class, '@list']);
Route::get('/', function () {
    //return view('swagger-description');
    //return view('welcome');
    return response()->json([
        'result' => 'warning', 'message' => 'Для доступа к платформе по API настройте подключение'], 404, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);  
});

Route::get('/apiList', ['uses' => ApiController::class . '@lists']);

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('register', 'AuthController@register');
    Route::get('profile', 'AuthController@profile');
    Route::post('refresh', 'AuthController@refresh');

});