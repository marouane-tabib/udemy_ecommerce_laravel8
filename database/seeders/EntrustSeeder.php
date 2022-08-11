<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    public function run(){
        $faker = Factory::create();
        // User Roles
        $adminRole = Role::create(['name' => 'admin' , 'display_name' => 'Administration' , 'description' => 'Administrator' , 'allowed_route' => 'admin']);
        $supervisorRole = Role::create(['name' => 'supervisor' , 'display_name' => 'Supervisor' , 'description' => 'Supervisor' , 'allowed_route' => 'admin']);
        $customerRole = Role::create(['name' => 'customer' , 'display_name' => 'Customer' , 'description' => 'Customer' , 'allowed_route' => null]);

        // Admin User with adminRole
        $admin = User::create([ 'first_name' => 'admin' , 'last_name' => 'System' , 'username' => 'admin' ,  'email' =>'admin@ecommerce.test' , 'email_verified_at' => now() , 'mobile' => '93049585989' , 'password' => bcrypt('123123123') , 'user_image' => 'avatar.svg' , 'status' => 1, 'remember_token' => Str::random(10) ]);
        $admin->attachRole($adminRole);

        // Supervisor User with supervisorRole
        $supervisor = User::create([ 'first_name' => 'Supervisor' , 'last_name' => 'System' , 'username' => 'supervisor', 'email' =>'supervisor@ecommerce.test' , 'email_verified_at' => now() , 'mobile' => '93049585999' , 'password' => bcrypt('marwan789') , 'user_image' => 'avatar.svg' , 'status' => 1, 'remember_token' => Str::random(10) ]);
        $supervisor->attachRole($supervisorRole);

        // Customer User with customerRole
        $customer = User::create([ 'first_name' => 'marwan' , 'last_name' => 'tabib' ,'username' => 'marwan_tabib', 'email' =>'marwan@gmail.com' ,'email_verified_at' => now() , 'mobile' => '99049585999' , 'password' => bcrypt('marwan789') , 'user_image' => 'avatar.svg' , 'status' => 1, 'remember_token' => Str::random(10) ]);
        $customer->attachRole($customerRole);


        for($i=1 ; $i<=20 ; $i++){
            $random_customer = User::create([
                'first_name' =>  $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'mobile' => $faker->phoneNumber,
                'password' => bcrypt('123123123'),
                'user_image' =>1,
                'remember_token' => Str::random(10)
            ]);
            $random_customer->attachRole($customerRole);
        }

        $manageMain = Permission::create(['name' => 'main', 'display_name' => 'main', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fas fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id ;
        $manageMain->save();

        // PRODUCTS CATEGORIES
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5']);
        $manageProductCategories->parent_show = $manageProductCategories->id ;
        $manageProductCategories->save();

        // SHOW CATEGORIES
        $showProductCategories = Permission::create(['name' => 'show_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE CATEGORIES
        $createProductCategories = Permission::create(['name' => 'create_product_categories', 'display_name' => 'Create Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => 'fas fa-create', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY CATEGORIES
        $displayProductCategories = Permission::create(['name' => 'display_product_categories', 'display_name' => 'Show Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE CATEGORIES
        $updateProductCategories = Permission::create(['name' => 'update_product_categories', 'display_name' => 'Update Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE CATEGORIES
        $deleteProductCategories = Permission::create(['name' => 'delete_product_categories', 'display_name' => 'Delete Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);

        // PRODUCTS TAGS
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tag', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10']);
        $manageTags->parent_show = $manageTags->id ;
        $manageTags->save();

        // SHOW TAGS
        $showTags = Permission::create(['name' => 'show_tags', 'display_name' => 'Tags', 'route' => 'tags', 'module' => 'tag', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE TAGS
        $createTags = Permission::create(['name' => 'create_tags', 'display_name' => 'Create Tag', 'route' => 'tags', 'module' => 'tag', 'as' => 'tags.create', 'icon' => 'fas fa-create', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY TAGS
        $displayTags = Permission::create(['name' => 'display_tags', 'display_name' => 'Show Tag', 'route' => 'tags', 'module' => 'tag', 'as' => 'tags.show', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE TAGS
        $updateTags = Permission::create(['name' => 'update_tags', 'display_name' => 'Update Tag', 'route' => 'tags', 'module' => 'tag', 'as' => 'tags.edit', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE TAGS
        $deleteTags = Permission::create(['name' => 'delete_tags', 'display_name' => 'Delete Tag', 'route' => 'tags', 'module' => 'tag', 'as' => 'tags.destroy', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);

        // MANAGE PRODUCTS
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => 'Products', 'route' => 'products', 'module' => 'product', 'as' => 'product.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15']);
        $manageProducts->parent_show = $manageProducts->id ;$manageProducts->save();
        // SHOW PRODUCTS
        $showProducts = Permission::create(['name' => 'show_products', 'display_name' => 'Products', 'route' => 'products', 'module' => 'product', 'as' => 'products.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE PRODUCTS
        $createProducts = Permission::create(['name' => 'create_products', 'display_name' => 'Create Products', 'route' => 'products', 'module' => 'product', 'as' => 'products.create', 'icon' => 'fas fa-create', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY PRODUCTS
        $displayProducts = Permission::create(['name' => 'display_products', 'display_name' => 'Show Products', 'route' => 'products', 'module' => 'product', 'as' => 'products.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE PRODUCTS
        $updateProducts = Permission::create(['name' => 'update_products', 'display_name' => 'Update Products', 'route' => 'products', 'module' => 'product', 'as' => 'products.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE PRODUCTS
        $deleteProducts = Permission::create(['name' => 'delete_products', 'display_name' => 'Delete Products', 'route' => 'products', 'module' => 'product', 'as' => 'products.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);


        // PRODUCTS COUPONS
        $manageProducts = Permission::create(['name' => 'manage_products_coupons', 'display_name' => 'Coupons', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percent', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20']);
        $manageProducts->parent_show = $manageProducts->id ;$manageProducts->save();
        // PRODUCTS COUPONS
        $showProductsCoupons = Permission::create(['name' => 'show_product_coupons', 'display_name' => 'Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percent', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE PRODUCTS COUPONS
        $createProductsCoupons = Permission::create(['name' => 'create_product_coupons', 'display_name' => 'Create Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.create', 'icon' => 'fas fa-percent', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY PRODUCTS COUPONS
        $displayProductsCoupons = Permission::create(['name' => 'display_product_coupons', 'display_name' => 'Show Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE PRODUCTS COUPONS
        $updateProductsCoupons = Permission::create(['name' => 'update_product_coupons', 'display_name' => 'Update Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE PRODUCTS COUPONS
        $deleteProductsCoupons = Permission::create(['name' => 'delete_product_coupons', 'display_name' => 'Delete Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);


        // PRODUCTS REVIEWS
        $manageProducts = Permission::create(['name' => 'manage_products_reviews', 'display_name' => 'Reviews', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20']);
        $manageProducts->parent_show = $manageProducts->id ;$manageProducts->save();
        // PRODUCTS REVIEWS
        $showProductsReviews = Permission::create(['name' => 'show_product_reviews', 'display_name' => 'Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE PRODUCTS REVIEWS
        $createProductsReviews = Permission::create(['name' => 'create_product_reviews', 'display_name' => 'Create Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.create', 'icon' => 'fas fa-comment', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY PRODUCTS REVIEWS
        $displayProductsReviews = Permission::create(['name' => 'display_product_reviews', 'display_name' => 'Show Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE PRODUCTS REVIEWS
        $updateProductsReviews = Permission::create(['name' => 'update_product_reviews', 'display_name' => 'Update Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE PRODUCTS REVIEWS
        $deleteProductsReviews = Permission::create(['name' => 'delete_product_reviews', 'display_name' => 'Delete Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);

    }

}
