<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Rubel',
            'email' => 'rubel@gmail.com',
            'password' => Hash::make('12345678'),
            'user_type'=> 'admin',
            'created_at'=>Carbon::now(),
        ]);
    }
}
