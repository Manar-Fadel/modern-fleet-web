<?php

namespace Database\Seeders;

use App\Managers\Constants;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'manar@modernfleet.com'], [
            'full_name' => 'Manar Admin',
            'email' => 'manar@modernfleet.com',
            'password' => Hash::make('123456789'),
            'phone_number' => '0500000000',
            'type' => Constants::ADMIN,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        User::updateOrCreate(['email' => 'admin@modernfleet.com'], [
            'full_name' => 'Super Admin',
            'email' => 'admin@modernfleet.com',
            'password' => Hash::make('123456789'),
            'phone_number' => '0590000000',
            'type' => Constants::ADMIN,
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
