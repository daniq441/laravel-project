<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

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

    public function getProductsForDashboard()
    {
        return $this->with('categories')->where('archive', 0)->paginate(5);
    }

    public function getCurrentCategory($id)
    {
        return $this->with('categories')->where('id', $id)->first();
    }

    public function searchProducts($search)
    {
        return $this->search($search)->paginate(5);
    }

    public function getArchivedProducts()
    {
        return $this->where('archive', 1)->paginate(5);
    }

    public function unarchiveProduct()
    {
        $this->archive = 0;
        return $this->save();
    }

    public function archiveProduct()
    {
        $this->archive = 1;
        return $this->save();
    }

    public function deleteProduct()
    {
        $this->categories()->detach();
        return $this->delete();
    }
}

