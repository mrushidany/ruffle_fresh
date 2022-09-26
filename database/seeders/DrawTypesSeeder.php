<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;
use App\Models\Draw;
use App\Models\DrawType;
use App\Models\Participant;
use App\Models\DrawWinner;
use App\Models\GrandWinner;
class DrawTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Draw::truncate();
        DrawType::truncate();
        Participant::truncate();
        DrawWinner::truncate();
        GrandWinner::truncate();

        DrawType::create(['name'=>'Weekly']);
        DrawType::create(['name'=>'Monthly']);
        DrawType::create(['name'=>'Grand Prize']);

        Schema::enableForeignKeyConstraints();
    }
}
