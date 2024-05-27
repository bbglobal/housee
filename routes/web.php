<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(IndexController::class)->group(function () {
    Route::get('/',  'index')->name('home')->middleware(['auth', 'online']);

    Route::get('/tickets',  'tickets')->name('tickets')->middleware(['auth', 'online']);
    Route::get('/power-ticket',  'ticketsPower')->name('tickets.powers')->middleware(['auth', 'online']);
    Route::get('/room-ticket',  'ticketsRoom')->name('tickets.rooms')->middleware(['auth', 'online']);
    Route::get('/tickets/{ticketValue}',  'addTickets')->name('add.tickets')->middleware(['auth', 'online']);
    Route::get('/power-ticket/{ticketValue}',  'addTickets')->name('add.tickets')->middleware(['auth', 'online']);
    Route::get('/room-ticket/{ticketValue}',  'addTickets')->name('add.tickets')->middleware(['auth', 'online']);

    Route::get('/powers',  'powers')->name('powers')->middleware(['auth', 'online']);
    Route::get('/powers/{powerName}',  'addPowers')->name('add.powers')->middleware(['auth', 'online']);

    Route::get('/start/{id}',  'start')->name('start')->middleware(['auth', 'online']);
    Route::get('/start/game-data/{id}',  'getGameDate')->name('start.game')->middleware(['auth', 'online']);
    Route::get('/start/power/{id}',  'startPower')->name('start.power')->middleware(['auth', 'online']);
    Route::get('/start/room/{id}',  'startRoom')->name('start.room')->middleware(['auth', 'online']);

    Route::get('/start/{ticket}',  'main')->name('main')->middleware(['auth', 'online']);
    Route::get('/start/room-data/{roomId}',  'getRoomData')->name('start.room')->middleware(['auth', 'online']);

    Route::get('/main/{ticket}',  'main')->name('main')->middleware(['auth', 'online']);

    Route::get('/play-with-powers/{id}',  'playWithPowers')->name('play.powers')->middleware(['auth', 'online']);
    Route::get('/paly-in-rooms',  'playInRoom')->name('play.rooms')->middleware(['auth', 'online']);
    Route::post('/paly-in-rooms',  'addRoomId')->name('add.roomId')->middleware(['auth', 'online']);

    Route::get('/check-room/{roomId}',  'checkRoom')->name('check.room')->middleware(['auth', 'online']);

    Route::get('/room/{id}',  'joinRoom')->name('join.room')->middleware(['auth', 'online']);

    Route::get('/add-coins',  'addCoins')->name('add.coins')->middleware(['auth', 'online']);
    Route::post('/withdraw-request',  'withdraw')->name('request.withdraw')->middleware(['auth', 'online']);

    Route::get('/win/{id}',  'winner')->name('winner')->middleware(['auth', 'online']);

    Route::get('/profile/{id}',  'profile')->name('user.profile')->middleware(['auth', 'online']);
    Route::post('/profile/{userId}',  'changeProfile')->name('edit.profile')->middleware(['auth', 'online']);

    Route::get('/phonepe/{coins}',  'phonePe')->name('phonepe')->middleware('auth');
    Route::any('/phonepe-response',  'response')->name('response');
});


Route::controller(AdminController::class)->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/', 'admin')->name('admin');
        Route::get('/login', 'login')->name('login');
        Route::post('/login', [Login::class, 'login']);
        Route::get('/signup', 'signup')->name('signup');
        Route::post('/signup', 'register')->name('regitser');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/reset', 'reset')->name('reset.request');

        Route::get('/google', 'redirectToGoogle')->name('login.google');
        Route::get('/google/callback', 'handleGoogleCallBack');

        Route::get('/facebook', 'redirectToFacebook')->name('login.facebook');
        Route::get('/facebook/callback', 'handleFacebookCallBack');
    });
});

Route::controller(PusherController::class)->group(function () {
    Route::prefix('/chat')->group(function () {
        Route::get('/', 'index');
        Route::post('/broadcast', 'broadcast');
        Route::post('/receive', 'receive');
    });
});
