<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\User;

class GetChatSpaceService
{
    /**
     * URLを元にメッセージを取得
     */
    public function getMessage($url)
    {
        // ddで見た後はリポジトリに移動させる
        // idを取得
        $id = Channel::where('url', $url)->value('id');
        // チャンネルのIDを元に（ユーザー情報（id, user_name）とメッセージ情報（user_id, message, created_at）を取得）
        $user = User::with(['message:user_id,message,created_at'])
            ->whereHas('message', function($q) use ($id) {
            $q->where('message.channel_id', $id);
        })->get();

        dd($user);
    }
}
