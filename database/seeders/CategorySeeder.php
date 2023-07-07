<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Database\Factories\CategoryFactory;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Full Sleeves',
            'Short Sleeves',
            'Track Suit',
            'Hiking',
            'Garments',
        ];
    
        foreach ($categories as $category) {
            CategoryFactory::new()->create([
                'category_name' => $category,
            ]);
        }
    }
    
}

