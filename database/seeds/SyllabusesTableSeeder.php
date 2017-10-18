<?php

use Illuminate\Database\Seeder;

class SyllabusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_syllabuses')->delete();
        
        DB::table('indv_syllabuses')->insert(
        	array([
        		'name'			=>	'Phrase P.',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Phrase I.',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Phrase A.',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Phrase M.',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	])
        );
    }
}
