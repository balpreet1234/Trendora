<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'discount', 'cat_id','status'];

    public function category()
    {
        return $this->belongsTo(category::class, 'cat_id');
    }
}
