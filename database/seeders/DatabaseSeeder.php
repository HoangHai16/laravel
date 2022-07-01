<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tbl_customer')->insert([
            'customer_name' => 'Hoang Hai',
            'customer_email' => 'haihh@gmail.com',
            'customer_phone' => '0568785478',
            'customer_password' => md5('password'),
            'customer_address' => 'HN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (app()->environment(['local', 'testing'])) {
            \Schema::disableForeignKeyConstraints();
            User::factory(1)->create();
            Product::factory(10)->create();
            // Order::factory(10)->create();
            // OrderDetail::factory(10)->create();
            Customer::factory(10)->create();
            Brand::factory(10)->create();
            Category::factory(100)->create();
            \Schema::enableForeignKeyConstraints();
        }
    }
}
