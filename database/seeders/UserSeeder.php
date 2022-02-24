<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // 1 Admin
        DB::table('users')->insert([
            'dni' => $faker->randomNumber($nbDigits = 8) . Str::random(1),
            'name' => 'Rasma',
            'surname' => 'Butkute',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'address' => $faker->streetAddress,
            'city' => $faker->city,
            'phone' => $faker->phoneNumber,
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role_id' => 1
        ]);

        // 5 clients
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'dni' => $faker->randomNumber($nbDigits = 8) . Str::random(1),
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'email' => 'client' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role_id' => 2
            ]);
        }

        // 5 restaurant managers
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'dni' => $faker->randomNumber($nbDigits = 8) . Str::random(1),
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'email' => 'manager' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role_id' => 3
            ]);
        }

        // 5 deliverymen
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'dni' => $faker->randomNumber($nbDigits = 8) . Str::random(1),
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'email' => 'deliveryman' . $i . '@gmail.com',
                'email_verified_at' => now(),
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'role_id' => 4
            ]);
        }
    }
}
