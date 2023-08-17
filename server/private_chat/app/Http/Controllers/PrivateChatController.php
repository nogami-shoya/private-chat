<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\String_;

use function Termwind\render;

class PrivateChatController extends Controller
{
    /**
     * URL作成ページ（最初のページ）
     */
    public function create()
    {
        return Inertia::render('CreateUrl');
    }

    /**
     * URLの登録処理
     */
    public function store(Request $request)
    {
        dd($request->get('url'));
        return Inertia::render('CreateUrl');
    }
}
