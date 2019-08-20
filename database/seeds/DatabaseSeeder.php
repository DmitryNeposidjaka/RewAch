<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = \App\Models\User::firstOrCreate([
            'name' => 'Superadmin',
            'email' => 'admin@mail.com',
            'email_verified_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'password' => bcrypt('secret')
        ]);
        // $this->call(UsersTableSeeder::class);
    }
}
