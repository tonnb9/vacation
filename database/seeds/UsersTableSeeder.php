<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Driton Berisha',
            'email' => 'dritonnaserberisha@gmail.com',
            'password' => bcrypt('123456'),
            'is_admin' => '1',
        ]);
    }
}
