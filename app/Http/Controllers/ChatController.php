<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * ひとこと一覧表示
     */
    public function getList()
    {
        $result = [
            [
                ''
            ], [], []
        ];
        return view('chat.list');
    }
}
