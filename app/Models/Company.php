<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['owner_id', 'name', 'description'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function profile()
    {
        return $this->hasOne(CompanyProfile::class);
    }

    public function theme()
    {
        return $this->hasOne(CompanyTheme::class);
    }

    // Employees/guests belonging to this company
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
