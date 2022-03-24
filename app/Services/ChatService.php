<?php

namespace App\Services;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatService extends CommonService
{
    protected $model;

    public function __construct(Chat $model)
    {
        $this->model = $model;
    }

    /**
     * 一覧データ取得
     */
    public function getList()
    {
        // データ取得
        return $this->model->getList();
    }

    /**
     * データ登録
     */
    public function createChat(array $formInput)
    {
        $formInput = [
            'user_id' => Auth::id(),
            'content' => $formInput['content'],
            'public' => $formInput['public'],
        ];
        $this->model->create($formInput);
    }
}
