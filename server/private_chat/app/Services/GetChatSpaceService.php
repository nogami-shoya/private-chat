<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\Message;
use App\Models\User;

class GetChatSpaceService
{
    /**
     * URLを元にチャンネル内のメッセージを取得
     */
    public function getMessages($url)
    {
        // URlを元にidを取得
        $id = Channel::where('url', $url)->value('id');

        // チャンネルIDを元にメッセージを取得
        $user_messages = Message::with(['user'])->where('channel_id', $id)->orderBy('created_at', 'asc')->get();

        return $user_messages;
    }

    /**
     * チャンネル名称の取得
     */
    public function getChannelName($url)
    {
        // URlを元にidを取得
        return Channel::where('url', $url)->value('channel_name');
    }
}
