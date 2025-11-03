<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyActivity extends Model
{
    use SoftDeletes;

    protected $fillable = ['company_id', 'activity_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
