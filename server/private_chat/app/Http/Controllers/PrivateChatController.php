<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Channel;
use App\Models\Message;
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
     * チャットスペースの作成処理
     */
    public function create(Request $request)
    {
        $channel = new Channel();
        $channel->channel_name = $request->get('channel_name');
        $channel->url = $request->get('url');
        $channel->save();

        $user = new User();
        $user->channel_id = $channel->id;
        $user->user_name = $request->get('user_name');
        $user->save();

        return redirect()->route('private-chat.chatspace', [
            'url' => $channel->url
        ])->withInput(['user_id' => $user->id, 'channel_id' => $channel->id, 'channel_name' => $channel->channel_name]);
    }

    /**
     * チャットスペース画面
     */
    public function chatspace(Request $request, $url)
    {
        $user_id = $request->old('user_id');
        $channel_id = $request->old('channel_id');
        $channel_name = $request->old('channel_name');

        // チャンネル作成者ではない場合新たにユーザーを登録（URL共有された人用）
        // TODO:同じ端末からアクセスした人の識別（更新するたびユーザーが増えるたり、メッセージ送信者が自分ではなくなるため）
        if (empty($user_id)) {
            // urlを元にchannelのidを取得
            $channel_id = Channel::where('url', $url)->value('id');
            // urlを共有された人を登録する
            $user = new User();
            $user->channel_id = $channel_id;
            $user->user_name = 'ゲスト';
            $user->save();

            $user_id = $user->id;
            $channel_id = $channel_id;
        }

        // チャンネル名称の取得
        $channel_name = $this->getChatSpaceService->getChannelName($url);

        return Inertia::render('ChatSpace', [
            'userId' => $user_id,
            'channelId' => $channel_id,
            'channelName' => $channel_name
        ]);
    }

    /**
     * メッセージ登録処理
     */
    public function sendmessage(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->get('userId');
        $message->channel_id = $request->get('channelId');
        $message->message = $request->get('message');
        $message->save();
    }

    /**
     * メッセージ一覧取得処理
     */
    public function getmessages(Request $request)
    {
        $url = $request->get('url');
        // ユーザー情報とそれに紐づくメッセージを取得してフロントに渡す
        $user_messages = $this->getChatSpaceService->getMessages($url);
        return $user_messages;
    }
}
