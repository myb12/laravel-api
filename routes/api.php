<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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



Route:: get('/articles',[ArticleController::class, 'getAllArticles']);
Route:: get('/articles/{article}',[ArticleController::class, 'getArticle']);

Route::middleware('auth:api')->group(function(){
    Route:: post('/articles',[ArticleController::class, 'createArticle']); //->middleware('auth:api'); to prtect individual route
    Route:: put('/articles/{article}',[ArticleController::class, 'updateArticle']);
    Route:: delete('/articles/{article}',[ArticleController::class, 'deleteArticle']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); //getting the authnticated users

Route::post('/token',[UserController::class,'generateToken']);


Route::get('/create', function(){
    User::forceCreate([
        'name'=>'Mohammad Yasin',
        'email'=>'mohammadyasinbappy@outlook.com',
        'password'=>Hash::make('12345678')
    ]);

      User::forceCreate([
        'name'=>'Md Shakiluzzaman',
        'email'=>'shakil@gmail.com',
        'password'=>Hash::make('12345678')
    ]);
});

Route::get('/tokencreate', function(){
    $user = User::find(1);
    $user->api_token=Str::random(80);
    $user->save();

    $user = User::find(2);
    $user->api_token=Str::random(80);
    $user->save();
});