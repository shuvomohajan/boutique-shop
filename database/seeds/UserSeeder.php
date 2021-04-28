<?php

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'              => 'Admin',
            'type'              => 'admin',
            'email'             => 'admin@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password'          => Hash::make('password'),
        ]);

        User::create([
            'name'              => 'publisher',
            'type'              => 'publisher',
            'email'             => 'publisher@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password'          => Hash::make('password'),
        ]);
          User::create([
            'name'              => 'author',
            'type'              => 'author',
            'email'             => 'author@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password'          => Hash::make('password'),
        ]);

        factory(User::class, 10)->create();
    }
}
