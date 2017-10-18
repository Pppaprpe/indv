<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_user_roles')->delete();
        
        DB::table('indv_user_roles')->insert(
        	array([
        		'name'			=>	'Student',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'IT',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'FO',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'MKT',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
