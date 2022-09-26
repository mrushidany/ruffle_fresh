<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Category::create(['name'=>'Motorcycle','no_of_winners'=>3,'image'=>'motorcycle.png','draw_type_id'=>1]);
        Category::create(['name'=>'Cash prize','no_of_winners'=>50,'image'=>'weekly_cash.png','draw_type_id'=>1]);

        Category::create(['name'=>'Motorcycle','no_of_winners'=>3,'image'=>'motorcycle.png','draw_type_id'=>2]);
        Category::create(['name'=>'Monthly Cash Prize','no_of_winners'=>50,'image'=>'weekly_cash.png','draw_type_id'=>2]);
        Category::create(['name'=>'Double Saving','no_of_winners'=>200,'image'=>'double_savings.png','draw_type_id'=>2]);

        Category::create(['name'=>'Grand Prize','no_of_winners'=>1,'image'=>'grand_prize.png','draw_type_id'=>3]);
        Schema::enableForeignKeyConstraints();
    }
}
