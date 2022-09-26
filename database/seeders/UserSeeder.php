<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users = factory(App\Models\User::class,1000)->create();
        Schema::disableForeignKeyConstraints();
        User::truncate();
        User::create([
            'name'=>'NCBA',
            'email'=>'admin@ncba.com',
            'password'=>bcrypt('password')
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
