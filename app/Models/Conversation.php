<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['company_id', 'title', 'created_by'];

   public function company()
{
    return $this->belongsTo(Company::class);
}

public function creator()
{
    return $this->belongsTo(User::class, 'created_by');
}

public function participants()
{
    return $this->belongsToMany(User::class, 'conversation_participants')
        ->withTimestamps();
}

public function messages()
{
    return $this->hasMany(Message::class)->orderBy('created_at');
}

public function latestMessage()
{
    return $this->hasOne(Message::class)->latestOfMany();
}
}