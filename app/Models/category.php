<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable=['title','slug','cate_main_title','category_title','summary','photo','status','is_parent','parent_id','added_by','meta_title','meta_description'];
    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id');
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
