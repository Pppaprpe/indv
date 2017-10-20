<?php

use Illuminate\Database\Seeder;

class BookingSortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_booking_sorts')->delete();
        
        DB::table('indv_booking_sorts')->insert(
        	array([
        		'name'			=>	'Flight',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Simulator',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
