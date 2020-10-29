<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 4; $i++) {
            DB::table('tasks')->insert([
                'admin_id' => 1,
                'name' => 'TASK000' . $i,
                'title' => 'task madde basligi  ' . $i,
                'description' => 'task madde icerigi ' . $i,
                'finished_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
