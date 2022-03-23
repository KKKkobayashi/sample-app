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
        // データ取得
        $result = $this->service->getList();
        $viewAssign = [
            'result' => $result,
        ];
        return view('chat.list', $viewAssign);
    }

    /**
     * 更新
     */
    public function getReload()
    {
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
