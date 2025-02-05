<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Shop extends Model
{
    use HasFactory, SoftDeletes, BelongsToTenant;
    protected $fillable = ['merchant_id', 'name', 'tenant_id'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

}
