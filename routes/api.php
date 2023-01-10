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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::any('register','AuthController@register');
    Route::any('login', 'AuthController@login');
    // Route::group(['middleware' => 'auth:api'], function () {

    Route::any('logout','AuthController@logout');
    Route::any('tournament','TournamentController@tournament');
    Route::any('league','LeagueController@league');
    Route::any('ticket/create','TicketController@create');
    Route::any('ticket/get','TicketController@ticketGet');
    Route::any('reply/create','TicketController@storeReply');
    Route::any('reply/get','TicketController@replyGet');
    // });
});
