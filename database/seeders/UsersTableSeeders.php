<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //menambahkan user db
        DB::table('users')->insert([
            'name' => 'tes',
            'username' => 'tes',
            'email' => 'tes@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
