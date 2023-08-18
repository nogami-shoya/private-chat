<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\String_;
use App\Models\Channel;

use function Termwind\render;

class PrivateChatController extends Controller
{
    /**
     * URL作成ページ（最初のページ）
     */
    public function home()
    {
        return Inertia::render('CreateUrl');
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

        return Inertia::render('CreateUrl');
    }
}
