<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


 //tiniest api
Route::get('users',function(){   
    $data=['akhil','ashraf','rajeev'];   //data to return through API,this is just an array,in real world we get it from database or other sources..
    return response()->json($data);     //send the data
});
