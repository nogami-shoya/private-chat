<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\String_;
use App\Models\Channel;
use App\Models\User;
use App\Services\GetChatSpaceService;

use function Termwind\render;

class PrivateChatController extends Controller
{
    protected $getChatSpaceService;

    public function __construct(GetChatSpaceService $getChatSpaceService)
    {
        $this->getChatSpaceService = $getChatSpaceService;
    }
    /**
     * URL作成ページ（最初のページ）
     */
    public function home()
    {
        return Inertia::render('CreateChannel');
    }

    /**
     * URLの登録処理
     */
    public function create(Request $request)
    {
        $channel = new Channel();
        $channel->channel_name = $request->get('channel_name');
        $channel->url = $request->get('url');
        $channel->save();

        $channel_id = $channel->id;

        $user = new User();
        $user->channel_id = $channel_id;
        $user->user_name = $request->get('user_name');
        $user->save();

        return redirect()->route('private-chat.chatspace', [
            'url' => $channel->url
        ]);
    }

    /**
     * チャットスペース
     */
    public function chatspace($url)
    {
        // ユーザー情報とそれに紐づくメッセージを取得する
        $user_messages = $this->getChatSpaceService->getMessage($url);
        return Inertia::render('ChatSpace', [
            'userMessages' => $user_messages
        ]);
    }
}
