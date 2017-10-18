<?php

use Illuminate\Database\Seeder;

class BookingStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_booking_statuses')->delete();
        
        DB::table('indv_booking_statuses')->insert(
        	array([
        		'name'			=>	'Booked',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
            [
                'name'          =>  'Accepted',
                'created_at'    =>  new Datetime(),
                'updated_at'    =>  new Datetime()
            ],
        	[
        		'name'			=>	'Canceled',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Closed',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
