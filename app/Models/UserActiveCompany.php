<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserActiveCompany extends Model
{
    protected $fillable = ['user_id', 'company_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
