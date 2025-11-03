<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Building extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'latitude', 'longitude'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
