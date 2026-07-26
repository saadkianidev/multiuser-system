<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyTheme extends Model
{
    protected $fillable = ['company_id', 'primary_color', 'secondary_color','accent_color','text_color', 'logo_path', 'font'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}