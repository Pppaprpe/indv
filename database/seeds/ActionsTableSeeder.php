<?php

use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('indv_actions')->delete();
        
        DB::table('indv_actions')->insert(
        	array([
        		'name'			=>	'Created',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Edited',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Deleted',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
        	[
        		'name'			=>	'Registered',
        		'created_at'	=>	new Datetime(),
        		'updated_at'	=>	new Datetime()
        	],
            [
                'name'          =>  'Logined',
                'created_at'    =>  new Datetime(),
                'updated_at'    =>  new Datetime()
            ],
            [
                'name'          =>  'Actived',
                'created_at'    =>  new Datetime(),
                'updated_at'    =>  new Datetime()
            ],
            [
                'name'          =>  'Inactived',
                'created_at'    =>  new Datetime(),
                'updated_at'    =>  new Datetime()
            ])
        );
    }
}
