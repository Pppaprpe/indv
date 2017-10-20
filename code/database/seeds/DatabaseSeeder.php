<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(UserStatusesTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(AircraftsTableSeeder::class);
        $this->call(BookingPeriodsTableSeeder::class);
        $this->call(BookingSortsTableSeeder::class);
        $this->call(BookingStatusesTableSeeder::class);
        $this->call(SyllabusesTableSeeder::class);
    }
}
