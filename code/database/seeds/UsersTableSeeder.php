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
        DB::table('indv_users')->delete();
        
        DB::table('indv_users')->insert(
        	array([
        		'firstname'		=>	'Chompunut',
        		'lastname'		=>	'Sornsumran',
        		'email'			=>	'pare.chompunut@gmail.com',
        		'password'		=>	bcrypt('0894769690'),
        		'user_role'		=>	2,
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}