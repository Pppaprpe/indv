<?php

use Illuminate\Database\Seeder;

class BookingPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_booking_periods')->delete();
        
        DB::table('indv_booking_periods')->insert(
        	array([
        		'name'			=>	'All Day',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Morning',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Afternoon',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
