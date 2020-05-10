<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('begin');


Route::get('/wildBattle', 'wildBattleController@show')->name('wildBattle');

Route::post('/wildBattlePick', 'wildBattleController@pick')->name('wildBattlePick');

Route::get('/wildBattleAttack', 'wildBattleController@attack')->name('wildBattleAttack');

Route::get('/wildBattleCatch', 'wildBattleController@catch')->name('wildBattleCatch');


Route::get('/trainerBattle', 'trainerBattleController@show')->name('trainerBattle');

Route::post('/trainerBattlePick', 'trainerBattleController@pick')->name('trainerBattlePick');
