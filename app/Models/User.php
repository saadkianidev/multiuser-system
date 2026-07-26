<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // The company this user belongs to (as an employee/guest)
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // The company this user owns (if they're an admin)
   public function ownedCompanies()
{
    return $this->hasMany(Company::class, 'owner_id');
}

    // The admin who created this user
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Users this admin has created
    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }

    // Conversations this user participates in
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_participants');
    }

    // Messages this user has sent
    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Message reads for this user
    public function messageReads()
    {
        return $this->hasMany(MessageRead::class);
    }
}