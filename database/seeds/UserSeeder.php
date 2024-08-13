<?php

use Illuminate\Database\Seeder;

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
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => 'kikirabdullah@gmail.com',
            'password' => md5('admin'),
            'nowa' => '085155300552'
        ]);

        DB::table('users')->insert([
            'username' => 'kiki',
            'name' => 'Kiki',
            'email' => 'kikirabdullaha@gmail.com',
            'password' => md5('123123'),
            'nowa' => '085155300552'
        ]);
    }
}
