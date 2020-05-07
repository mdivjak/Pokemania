<?php

use App\Http\Controllers\HomePageController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/", [
    "uses" => "HomeController@show",
    "as" => "home.index"
]);

Route::get("/pokedex", [
    "uses" => "HomeController@pokedex",
    "as" => "home.pokedex"
]);

Route::get("/pokedex/{id}", [
    "uses" => "HomeController@pokemon",
    "as" => "home.pokemon"
]);

Route::get("/quiz", [
    "uses" => "HomeController@quiz",
    "as" => "home.quiz"
]);
Route::post("/quiz", [
    "uses" => "HomeController@quizGuess",
    "as" => "home.quizGuess"
]);

Auth::routes();

/**
 * Korisnik
 */
Route::get('/profile/{id}', 'UserController@show')->name('user.show');
Route::put('/profile/{id}/feed', 'UserController@feed')->name('user.feed');
Route::put('/profile/{id}/release', 'UserController@release')->name('user.release');
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