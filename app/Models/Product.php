<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    // use SoftDeletes; // Enable soft deletes

    protected $fillable = [
        'productSKU',
        'productName',
        'productPrice',
        'productWeight',
        'productCartDesc',
        'productLongDesc',
        'productImage',
        'productStock',
    ];

    protected $dates = ['deleted_at']; // Specify the 'deleted_at' column as a date

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_categories', 'product_id', 'category_id');
    }

    public function scopeSearch($query, $search)
        {
            return $query->where('archive', 0)
                ->where(function ($query) use ($search) {
                    $query->where('productSKU', 'LIKE', "%$search%")
                        ->orWhere('productName', 'LIKE', "%$search%");
                });
        }

}
