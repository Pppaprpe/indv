<?php

use Illuminate\Database\Seeder;

class UserStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_user_statuses')->delete();
        
        DB::table('indv_user_statuses')->insert(
        	array([
        		'name'			=>	'Active',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Inactive',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
