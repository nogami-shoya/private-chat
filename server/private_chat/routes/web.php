<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/', [PrivateChatController::class, 'home'])->name('private-chat.home');
// チャットスペース作成
Route::post('/create', [PrivateChatController::class, 'create'])->name('private-chat.create');
// チャットスペース画面
Route::get('/chat-space/{url}', [PrivateChatController::class, 'chatspace'])->name('private-chat.chatspace');
// メッセージ送信（axios）
Route::post('/send/message', [PrivateChatController::class, 'sendmessage'])->name('private-chat.sendmessage');
// メッセージ一覧を取得（axios）
Route::match(['get', 'post'], '/get/messages',[PrivateChatController::class, 'getmessages'])->name('private-chat.getmessages');
