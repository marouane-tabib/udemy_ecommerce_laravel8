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

        // PRODUCT CATEGORIES
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageProductCategories->parent_show = $manageProductCategories->id ;
        $manageProductCategories->save();

        // SHOW CATEGORIES
        $showProductCategories = Permission::create(['name' => 'show_product_categories', 'display_name' => 'Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '1']);

        // CREATE CATEGORIES
        $createProductCategories = Permission::create(['name' => 'create_product_categories', 'display_name' => 'Careate Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => 'fas fa-create', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);

        // DISPLAY CATEGORIES
        $displayProductCategories = Permission::create(['name' => 'display_product_categories', 'display_name' => 'Show Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);

        // UPDATE CATEGORIES
        $updateProductCategories = Permission::create(['name' => 'update_product_categories', 'display_name' => 'Update Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);

        // DELETE CATEGORIES
        $deleteProductCategories = Permission::create(['name' => 'delete_product_categories', 'display_name' => 'Delete Categories', 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '0']);
    }

}
