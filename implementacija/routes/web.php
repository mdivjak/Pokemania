<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\User;
use App\Tournament;

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
Auth::routes(['verify' => true]);

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('verified');
//kreiranje novog turnira
Route::post('/admin', 'AdminController@store')->middleware('verified');
//pregled prijava
Route::get('/admin/tournament/{id}', 'AdminController@listRegistrations')->name('admin.registrations')->middleware('verified');
//prihvatanje prijave
Route::put('/admin/tournament/{id}/accept', 'AdminController@accept')->name('admin.accept')->middleware('verified');
//odbijanje prijave
Route::post('/admin/tournament/{id}/decline', 'AdminController@decline')->name('admin.decline')->middleware('verified');
//brisanje turnira
Route::post('/admin/tournament/{tournament}/delete', 'AdminController@deleteTournament')->name('admin.delete')->middleware('verified');


//------------------------------KRAJ MARKOVOG------------------------------------

//-------------------------------NATALIJINO---------------------------------------

Route::get('/', 'GuestController@show')->name('home.index');

Route::get('/pokedex', 'GuestController@pokedex')->name('home.pokedex');

Route::get('/pokedex/{id}', 'GuestController@pokemon')->name('home.pokemon');

Route::get('/quiz', 'GuestController@quiz')->name('home.quiz');

Route::post('/quiz', 'GuestController@quizGuess')->name('home.quizGuess');
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


//-----------------------------PREVIEW MEJLOVA-----------------------------------------------------

Route::get('/test-accept-mail', function () {
    Mail::to("dekan@etf.rs")->send(new App\Mail\AcceptRegistration(User::find(1), Tournament::find(1)));
    return new App\Mail\AcceptRegistration(User::find(1),Tournament::find(1));
});

Route::get('/test-decline-mail', function () {
    Mail::to("dekan@etf.rs")->send(new App\Mail\DeclineRegistration(User::find(1), Tournament::find(1)));
    return new App\Mail\DeclineRegistration(User::find(1),Tournament::find(1));
});

Route::get('/test-delete-mail', function () {
    Mail::to("dekan@etf.rs")->send(new App\Mail\TournamentDeleted(User::find(1), Tournament::find(1), "Test message"));
    return new App\Mail\TournamentDeleted(User::find(1),Tournament::find(1), "Test message");
});

Route::get('/test-verify', function () {
    return view('auth.verify');
});

Route::get('/test-reset', function () {
    return view('auth.passwords.reset');
});