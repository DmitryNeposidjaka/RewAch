<?php


class UsersTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $superadmin = \App\Models\User::firstOrCreate(
            [
                'email' => 'admin@mail.com',
            ],
            [
                'name' => 'Superadmin',
                'email_verified_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'password' => bcrypt('secret')
            ]);
    }
}