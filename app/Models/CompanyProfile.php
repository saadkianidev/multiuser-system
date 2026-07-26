<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = ['company_id', 'address', 'city', 'country', 'phone', 'website'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}