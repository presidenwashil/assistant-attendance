<?php

namespace Database\Seeders;

use App\Models\Rfid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RfidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rfid::factory(1)->create();
    }
}
