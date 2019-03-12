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
    		'name' => 'Mahasiswa Baru',
    		'email' => 'mahasiswa@gmail.com',
    		'password' => bcrypt('12345'),
    		'role' => 'mahasiswa',
            'photo' => 'profile1.png',
    		'created_at' => new Datetime(),
    		'updated_at' => new Datetime()
    	]);

        DB::table('users')->insert([
            'name' => 'Dosen Baru',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'dosen',
            'photo' => 'profile2.png',
            'created_at' => new Datetime(),
            'updated_at' => new Datetime()
        ]);
    }
}
