<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;

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

//-----------------------------------MARKOVO----------------------------------

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');
//kreiranje novog turnira
Route::post('/admin', 'AdminController@store');
//pregled prijava
Route::get('/admin/tournament/{id}', 'AdminController@listRegistrations')->name('admin.registrations');
//prihvatanje prijave
Route::post('/admin/tournament/{id}/accept', 'AdminController@accept')->name('admin.accept');
//odbijanje prijave
Route::post('/admin/tournament/{id}/decline', 'AdminController@decline')->name('admin.decline');
//brisanje turnira
Route::post('/admin/tournament/{tournament}/delete', 'AdminController@deleteTournament')->name('admin.delete');


//------------------------------KRAJ MARKOVOG------------------------------------

//-------------------------------NATALIJINO---------------------------------------

Route::get("/", [
    "uses" => "GuestController@show",
    "as" => "home.index"
]);

Route::get("/pokedex", [
    "uses" => "GuestController@pokedex",
    "as" => "home.pokedex"
]);

Route::get("/pokedex/{id}", [
    "uses" => "GuestController@pokemon",
    "as" => "home.pokemon"
]);

Route::get("/quiz", [
    "uses" => "GuestController@quiz",
    "as" => "home.quiz"
]);

Route::post("/quiz", [
    "uses" => "GuestController@quizGuess",
    "as" => "home.quizGuess"
]);
//------------------------------KRAJ NATALIJINOG------------------------------------

//----------------------------------ANJINE RUTE-------------------------------------

/**
 * Korisnik
 */
Route::get('/profile/{user}', 'UserController@show')->name('user.show');
Route::put('/profile/{user}/feed', 'UserController@feed')->name('user.feed');
Route::put('/profile/{user}/release', 'UserController@release')->name('user.release');
/**
 * Kupovina u prodavnici
 */
Route::get('/profile/{id}/shop', 'UserController@shop')->name('user.shop');
Route::put('/profile/{id}/shop', 'UserController@buy')->name('user.buy');

/**
 * Turnir
 */
Route::get('/tournament', 'TournamentController@index')->name('tournament.index');
Route::get('/tournament/{tournament}', 'TournamentController@show')->name('tournament.show');
Route::post('/tournament/{tournament}', 'TournamentController@store')->name('tournament.store');
Route::delete('/tournament/{tournament}', 'TournamentController@delete')->name('tournament.delete');

//------------------------------KRAJ ANJINOG----------------------------------------------

//------------------------------VUKASIN-----------------------------------------------

Route::get('/wildBattle', 'wildBattleController@show')->name('wildBattle');

Route::post('/wildBattlePick', 'wildBattleController@pick')->name('wildBattlePick');

Route::get('/wildBattleAttack', 'wildBattleController@attack')->name('wildBattleAttack');

Route::get('/wildBattleCatch', 'wildBattleController@catch')->name('wildBattleCatch');

Route::get('/trainerBattle', 'trainerBattleController@show')->name('trainerBattle');

Route::post('/trainerBattlePick', 'trainerBattleController@pick')->name('trainerBattlePick');

Route::get('/trainerBattleAttack', 'trainerBattleController@attack')->name('trainerBattleAttack');

//-----------------------------KRAJ VUKASIN------------------------------------------------------
