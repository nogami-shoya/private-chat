<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PrivateChatController;

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

// チャットスペース作成画面
Route::get('/create-url', [PrivateChatController::class, 'create'])->name('private-chat.create');
// チャットスペース作成
Route::post('/create-url', [PrivateChatController::class, 'store'])->name('private-chat.store');
// チャットスペース画面
Route::get('/chat-space/{uuid}', [PrivateChatController::class, 'index'])->name('private-chat.index');
