<?php

namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReserveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reserve')->insert([
            'name' => EntityType::ITEM,
            'count' => 100
        ]);

        DB::table('reserve')->insert([
            'name' => EntityType::MONEY,
            'count' => 10000
        ]);
    }
}
