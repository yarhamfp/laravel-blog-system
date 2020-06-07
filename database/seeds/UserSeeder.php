<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'role_id'   => 1,
            'username'  => 'admin',
            'image' => 'default.jpg',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Author',
            'role_id'   => 2,
            'username'  => 'author',
            'image' => 'default.jpg',
            'email' => 'author@gmail.com',
            'password' => Hash::make('author123'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
