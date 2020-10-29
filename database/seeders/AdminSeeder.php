<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Samet Sahin',
            'email' => 'sametsahinx@gmail.com',
            'password' => bcrypt(123456),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
