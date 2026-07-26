<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['conversation_id', 'sender_id', 'body'];

    public function conversation()
{
    return $this->belongsTo(Conversation::class);
}

public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}

public function reads()
{
    return $this->hasMany(MessageRead::class);
}

public function isReadBy($userId)
{
    return $this->reads()->where('user_id', $userId)->whereNotNull('read_at')->exists();
}
}