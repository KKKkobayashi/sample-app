<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'content',
        'public',
    ];
    protected $hidden = [
        'id',
    ];

    /**
     * 一覧データ取得
     */
    public function getList()
    {
        return $this
            ->select(
                'users.name',
                'chats.*'
            )
            ->join('users', 'users.id', '=', 'chats.user_id')
            ->where(function ($query) {
                return $query->where('chats.user_id', Auth::id())
                    ->orWhere('chats.public', config('const.MODEL.CHAT.PUBLIC.PUBLIC'));
            })
            ->orderby('chats.created_at', 'desc')
            ->get();
    }
}
