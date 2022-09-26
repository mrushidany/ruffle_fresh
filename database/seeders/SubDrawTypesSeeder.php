<?php

namespace Database\Seeders;

use App\Models\Draw;
use App\Models\DrawType;
use App\Models\DrawWinner;
use App\Models\GrandWinner;
use App\Models\Participant;
use App\Models\SubDrawType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SubDrawTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        SubDrawType::create(['name'=>'Motorcycle']);
        SubDrawType::create(['name'=>'Cash Prize']);
        SubDrawType::create(['name'=>'Monthly Motorcycle']);
        SubDrawType::create(['name'=>'Monthly Cash Prize']);
        SubDrawType::create(['name'=>'Double Saving']);

        Schema::enableForeignKeyConstraints();
    }
}
