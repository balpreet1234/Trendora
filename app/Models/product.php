<?php

namespace App\Models;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $casts = [
        'tags' => 'array',

            'cat_id' => 'array',

    ];
    public function getCategoryIdsAttribute()
    {
        return explode(',', $this->cat_id);
    }
    public function galleries() {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }
    public function categories()
    {
        return $this->hasMany(Category::class, 'cat_id', 'id');
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    //scope filter
    public function scopeFilter($query, Request $request)
    {
        return $query
            ->when($request->sort_by === 'sort_by_latest', function ($builder) {
                return $builder->orderBy('created_at', 'desc');
            })
            ->when($request->sort_by === 'low_to_high', function ($builder) {
                return $builder->orderByRaw('CAST(price - (price * discount / 100) AS DECIMAL(10,2)) ASC');
            })
            ->when($request->sort_by === 'high_to_low', function ($builder) {
                return $builder->orderByRaw('CAST(price - (price * discount / 100) AS DECIMAL(10,2)) DESC');
            })
            ->when($request->minPrice, function ($query) use ($request) {
                return $query->whereRaw('price - (price * discount / 100) >= ?', [$request->minPrice]);
            })
            ->when($request->maxPrice, function ($query) use ($request) {
                return $query->whereRaw('price - (price * discount / 100) <= ?', [$request->maxPrice]);
            })
            ->when($request->category_id, function ($query) use ($request) {
                $categoryIds = explode(',', $request->category_id);
                foreach ($categoryIds as $id) {
                    $query->orWhere('cat_id', 'LIKE', "%$id%");
                }
                return $query;
            });
    }

}
