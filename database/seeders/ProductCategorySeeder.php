<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // shoes (women, men,boy,girls)
        $clothes = ProductCategory::create(['name' => 'Clothes', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategory::create(['name' => 'Women\'s T-Shirt', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Men\'s T-Shirt', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Oresses', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Novelty Socks', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Women\'s Sunglasses', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);
        ProductCategory::create(['name' => 'Men\'s Sunglasses', 'cover' => 'clothes.jpg', 'status' => true, 'parent_id' => $clothes->id]);

        $shoes = ProductCategory::create(['name' => 'Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategory::create(['name' => 'Women\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create(['name' => 'Men\'s Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create(['name' => 'Boy Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);
        ProductCategory::create(['name' => 'Girls Shoes', 'cover' => 'shoes.jpg', 'status' => true, 'parent_id' => $shoes->id]);

        $watches = ProductCategory::create(['name' => 'Watches', 'cover' => 'watches.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategory::create(['name' => 'Women\'s Watches', 'cover' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create(['name' => 'Men\'s Watches', 'cover' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create(['name' => 'Boy Watches', 'cover' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id]);
        ProductCategory::create(['name' => 'Girls Watches', 'cover' => 'watches.jpg', 'status' => true, 'parent_id' => $watches->id]);

        $electronics = ProductCategory::create(['name' => 'Electronics', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => null]);
        ProductCategory::create(['name' => 'Electronics', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'USB Flash drives', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'Headphones', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'Portable speakers', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'Cell Phone bluetooth headsets', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
        ProductCategory::create(['name' => 'keyboards', 'cover' => 'electronics.jpg', 'status' => true, 'parent_id' => $electronics->id]);
    }
}
