<?php

use Illuminate\Database\Seeder;

class AircraftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_aircrafts')->delete();
        
        DB::table('indv_aircrafts')->insert(
        	array([
        		'name'			=>	'C-172',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'DA-42',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
