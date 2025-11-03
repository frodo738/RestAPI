<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPhone extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'company_phones';

    protected $fillable = ['phone_number', 'company_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
