<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\Message;
use App\Models\User;

class GetChatSpaceService
{
    /**
     * URLを元にメッセージを取得
     */
    public function getUserInfo($url)
    {
        // URlを元にidを取得
        $id = Channel::where('url', $url)->value('id');

        // チャンネルIDを元にユーザー情報と紐づくメッセージを取得
        $user_messages = User::with(['messages'])->where('channel_id', $id)->get();
        // dd($user_messages);

        // ユーザー情報を取得
        $user_info = User::where('channel_id', $id)->get();


        return [$user_messages, $user_info];
    }
}
