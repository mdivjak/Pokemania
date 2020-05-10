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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'AdminsController@store');

//------------------------------KRAJ MARKOVOG------------------------------------

//-------------------------------NATALIJINO---------------------------------------

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
//------------------------------KRAJ NATALIJINOG------------------------------------