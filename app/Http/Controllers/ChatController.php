<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatRequest;
use Illuminate\Http\Request;
use App\Services\ChatService;

class ChatController extends Controller
{
    protected $service;

    public function __construct(ChatService $service)
    {
        $this->service = $service;
    }

    /**
     * ひとこと一覧表示
     */
    public function getList()
    {
        // セッション取得
        $scrollTop = $this->service->getSession(config('const.SESSION.CHAT.SESSION_SCROLL_TOP')) ?: 0;
        $showNum = $this->service->getSession(config('const.SESSION.CHAT.SESSION_CHAT_SHOW_NUM')) ?: 10;

        // データ取得
        $result = $this->service->getList($showNum);
        $viewAssign = [
            'result' => $result,
            'scrollTop' => $scrollTop,
        ];
        return view('chat.list', $viewAssign);
    }

    /**
     * 更新(get)
     *
     */
    public function getReload()
    {
        // セッション格納
        $this->service->setSession(config('const.SESSION.CHAT.SESSION_SCROLL_TOP'), 0);
        // リダイレクト
        return redirect('chat');
    }

    /**
     * 更新(post)
     *
     * @param Illuminate\Http\Request $request
     */
    public function postReload(Request $request)
    {
        // セッション格納
        $this->service->setSession(config('const.SESSION.CHAT.SESSION_SCROLL_TOP'), $request->scrol_top);
        // 表示数追加(+10)
        $showNum = $this->service->getSession(config('const.SESSION.CHAT.SESSION_CHAT_SHOW_NUM')) ?: 10;
        $this->service->setSession(config('const.SESSION.CHAT.SESSION_CHAT_SHOW_NUM'), $showNum + 10);
        // リダイレクト
        return redirect('chat');
    }

    /**
     * 投稿
     */
    public function postCreate(ChatRequest $request)
    {
        // データ登録
        $this->service->createChat($request->all());
        return redirect('chat');
    }
}
