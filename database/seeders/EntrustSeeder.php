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
                'user_image' => null,
                'remember_token' => Str::random(10)
            ]);
            $random_customer->attachRole($customerRole);
        }

        $manageMain = Permission::create(['name' => 'main', 'display_name' => 'main', 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'fas fa-home', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id ;
        $manageMain->save();

        // PRODUCTS CATEGORIES
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5']);
        $manageProductCategories->parent_show = $manageProductCategories->id ;$manageProductCategories->save();
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
        $manageTags->parent_show = $manageTags->id ;$manageTags->save();
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
        $manageProductsCoupons = Permission::create(['name' => 'manage_products_coupons', 'display_name' => 'Coupons', 'route' => 'product_coupons', 'module' => 'product_coupons', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percent', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20']);
        $manageProductsCoupons->parent_show = $manageProductsCoupons->id ;$manageProductsCoupons->save();
        // PRODUCTS COUPONS
        $showProductsCoupons = Permission::create(['name' => 'show_product_coupons', 'display_name' => 'Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.index', 'icon' => 'fas fa-percent', 'parent' => $manageProductsCoupons->id, 'parent_original' => $manageProductsCoupons->id, 'parent_show' => $manageProductsCoupons->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE PRODUCTS COUPONS
        $createProductsCoupons = Permission::create(['name' => 'create_product_coupons', 'display_name' => 'Create Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.create', 'icon' => 'fas fa-percent', 'parent' => $manageProductsCoupons->id, 'parent_original' => $manageProductsCoupons->id, 'parent_show' => $manageProductsCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY PRODUCTS COUPONS
        $displayProductsCoupons = Permission::create(['name' => 'display_product_coupons', 'display_name' => 'Show Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.show', 'icon' => null, 'parent' => $manageProductsCoupons->id, 'parent_original' => $manageProductsCoupons->id, 'parent_show' => $manageProductsCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE PRODUCTS COUPONS
        $updateProductsCoupons = Permission::create(['name' => 'update_product_coupons', 'display_name' => 'Update Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.edit', 'icon' => null, 'parent' => $manageProductsCoupons->id, 'parent_original' => $manageProductsCoupons->id, 'parent_show' => $manageProductsCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE PRODUCTS COUPONS
        $deleteProductsCoupons = Permission::create(['name' => 'delete_product_coupons', 'display_name' => 'Delete Products Coupons', 'route' => 'product_coupons', 'module' => 'product', 'as' => 'product_coupons.destroy', 'icon' => null, 'parent' => $manageProductsCoupons->id, 'parent_original' => $manageProductsCoupons->id, 'parent_show' => $manageProductsCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);


        // PRODUCTS REVIEWS
        $manageProductsReviews = Permission::create(['name' => 'manage_product_reviews', 'display_name' => 'Reviews', 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20']);
        $manageProductsReviews->parent_show = $manageProductsReviews->id ;$manageProductsReviews->save();
        // PRODUCTS REVIEWS
        $showProductsReviews = Permission::create(['name' => 'show_product_reviews', 'display_name' => 'Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageProductsReviews->id, 'parent_original' => $manageProductsReviews->id, 'parent_show' => $manageProductsReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE PRODUCTS REVIEWS
        $createProductsReviews = Permission::create(['name' => 'create_product_reviews', 'display_name' => 'Create Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.create', 'icon' => 'fas fa-comment', 'parent' => $manageProductsReviews->id, 'parent_original' => $manageProductsReviews->id, 'parent_show' => $manageProductsReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY PRODUCTS REVIEWS
        $displayProductsReviews = Permission::create(['name' => 'display_product_reviews', 'display_name' => 'Show Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.show', 'icon' => null, 'parent' => $manageProductsReviews->id, 'parent_original' => $manageProductsReviews->id, 'parent_show' => $manageProductsReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE PRODUCTS REVIEWS
        $updateProductsReviews = Permission::create(['name' => 'update_product_reviews', 'display_name' => 'Update Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.edit', 'icon' => null, 'parent' => $manageProductsReviews->id, 'parent_original' => $manageProductsReviews->id, 'parent_show' => $manageProductsReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE PRODUCTS REVIEWS
        $deleteProductsReviews = Permission::create(['name' => 'delete_product_reviews', 'display_name' => 'Delete Products Reviews', 'route' => 'product_reviews', 'module' => 'product', 'as' => 'product_reviews.destroy', 'icon' => null, 'parent' => $manageProductsReviews->id, 'parent_original' => $manageProductsReviews->id, 'parent_show' => $manageProductsReviews->id, 'sidebar_link' => '1', 'appear' => '0']);


        // CUSTOMER
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name' => 'Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '30']);
        $manageCustomers->parent_show = $manageCustomers->id ;$manageCustomers->save();
        // SHOW CUSTOMER
        $showCustomers = Permission::create(['name' => 'show_customers', 'display_name' => 'Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-comment', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE CUSTOMER
        $createCustomers = Permission::create(['name' => 'create_customers', 'display_name' => 'Create Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.create', 'icon' => 'fas fa-comment', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY CUSTOMER
        $displayCustomers = Permission::create(['name' => 'display_customers', 'display_name' => 'Show Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.show', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE CUSTOMER
        $updateCustomers = Permission::create(['name' => 'update_customers', 'display_name' => 'Update Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.edit', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE CUSTOMER
        $deleteCustomers = Permission::create(['name' => 'delete_customers', 'display_name' => 'Delete Customers', 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.destroy', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);


        // CUSTOMER ADDRESS
        $manageCustomersAddresses = Permission::create(['name' => 'manage_customers_addresses', 'display_name' => 'CustomersAddresses', 'route' => 'customers_addresses', 'module' => 'customers_addresses', 'as' => 'customers_addresses.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40']);
        $manageCustomersAddresses->parent_show = $manageCustomersAddresses->id ;$manageCustomersAddresses->save();
        // SHOW CUSTOMER ADDRESS
        $showCustomersAddresses = Permission::create(['name' => 'show_customers_addresses', 'display_name' => 'CustomersAddresses', 'route' => 'customers_addresses', 'module' => 'customers_addresses', 'as' => 'customers_addresses.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageCustomersAddresses->id, 'parent_original' => $manageCustomersAddresses->id, 'parent_show' => $manageCustomersAddresses->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE CUSTOMER ADDRESS
        $createCustomersAddresses = Permission::create(['name' => 'create_customers_addresses', 'display_name' => 'Create CustomersAddresses', 'route' => 'customers_addresses', 'module' => 'customers_addresses', 'as' => 'customers_addresses.create', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageCustomersAddresses->id, 'parent_original' => $manageCustomersAddresses->id, 'parent_show' => $manageCustomersAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY CUSTOMER ADDRESS
        $displayCustomersAddresses = Permission::create(['name' => 'display_customers_addresses', 'display_name' => 'Show CustomersAddresses', 'route' => 'customers_addresses', 'module' => 'customers_addresses', 'as' => 'customers_addresses.show', 'icon' => null, 'parent' => $manageCustomersAddresses->id, 'parent_original' => $manageCustomersAddresses->id, 'parent_show' => $manageCustomersAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE CUSTOMER ADDRESS
        $updateCustomersAddresses = Permission::create(['name' => 'update_customers_addresses', 'display_name' => 'Update CustomersAddresses', 'route' => 'customers_addresses', 'module' => 'customers_addresses', 'as' => 'customers_addresses.edit', 'icon' => null, 'parent' => $manageCustomersAddresses->id, 'parent_original' => $manageCustomersAddresses->id, 'parent_show' => $manageCustomersAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE CUSTOMER ADDRESS
        $deleteCustomersAddresses = Permission::create(['name' => 'delete_customers_addresses', 'display_name' => 'Delete CustomersAddresses', 'route' => 'customers_addresses', 'module' => 'customers_addresses', 'as' => 'customers_addresses.destroy', 'icon' => null, 'parent' => $manageCustomersAddresses->id, 'parent_original' => $manageCustomersAddresses->id, 'parent_show' => $manageCustomersAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);


        // COUNTRY
        $manageCountries = Permission::create(['name' => 'manage_countries', 'display_name' => 'Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40']);
        $manageCountries->parent_show = $manageCountries->id ;$manageCountries->save();
        // SHOW COUNTRY
        $showCountries = Permission::create(['name' => 'show_countries', 'display_name' => 'Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE COUNTRY
        $createCountries = Permission::create(['name' => 'create_countries', 'display_name' => 'Create Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.create', 'icon' => 'fas fa-globe', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY COUNTRY
        $displayCountries = Permission::create(['name' => 'display_countries', 'display_name' => 'Show Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.show', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE COUNTRY
        $updateCountries = Permission::create(['name' => 'update_countries', 'display_name' => 'Update Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.edit', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE COUNTRY
        $deleteCountries = Permission::create(['name' => 'delete_countries', 'display_name' => 'Delete Countries', 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.destroy', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id, 'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);


        // STATES
        $manageStates = Permission::create(['name' => 'manage_states', 'display_name' => 'States', 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45']);
        $manageStates->parent_show = $manageStates->id ;$manageStates->save();
        // SHOW STATES
        $showStates = Permission::create(['name' => 'show_states', 'display_name' => 'States', 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE STATES
        $createStates = Permission::create(['name' => 'create_states', 'display_name' => 'Create States', 'route' => 'states', 'module' => 'states', 'as' => 'states.create', 'icon' => 'fas fa-map-marker', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY STATES
        $displayStates = Permission::create(['name' => 'display_states', 'display_name' => 'Show States', 'route' => 'states', 'module' => 'states', 'as' => 'states.show', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE STATES
        $updateStates = Permission::create(['name' => 'update_states', 'display_name' => 'Update States', 'route' => 'states', 'module' => 'states', 'as' => 'states.edit', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE STATES
        $deleteStates = Permission::create(['name' => 'delete_states', 'display_name' => 'Delete States', 'route' => 'states', 'module' => 'states', 'as' => 'states.destroy', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);


        // CITIES
        $manageCities = Permission::create(['name' => 'manage_cities', 'display_name' => 'Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50']);
        $manageCities->parent_show = $manageCities->id ;$manageCities->save();
        // SHOW CITIES
        $showCities = Permission::create(['name' => 'show_cities', 'display_name' => 'Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE CITIES
        $createCities = Permission::create(['name' => 'create_cities', 'display_name' => 'Create Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.create', 'icon' => 'fas fa-university', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY CITIES
        $displayCities = Permission::create(['name' => 'display_cities', 'display_name' => 'Show Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.show', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE CITIES
        $updateCities = Permission::create(['name' => 'update_cities', 'display_name' => 'Update Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.edit', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE CITIES
        $deleteCities = Permission::create(['name' => 'delete_cities', 'display_name' => 'Delete Cities', 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.destroy', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);


        // SUPERVISORS
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => 'Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '100']);
        $manageSupervisors->parent_show = $manageSupervisors->id ;$manageSupervisors->save();
        // SHOW SUPERVISORS
        $showSupervisors = Permission::create(['name' => 'show_supervisors', 'display_name' => 'Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-comment', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '1']);
        // CREATE SUPERVISORS
        $createSupervisors = Permission::create(['name' => 'create_supervisors', 'display_name' => 'Create Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => 'fas fa-comment', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DISPLAY SUPERVISORS
        $displaySupervisors = Permission::create(['name' => 'display_supervisors', 'display_name' => 'Show Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        // UPDATE SUPERVISORS
        $updateSupervisors = Permission::create(['name' => 'update_supervisors', 'display_name' => 'Update Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        // DELETE SUPERVISORS
        $deleteSupervisors = Permission::create(['name' => 'delete_supervisors', 'display_name' => 'Delete Supervisors', 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);

    }

}
