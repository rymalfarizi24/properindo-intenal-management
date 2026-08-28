<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "Rayhan Muhammad Alfarizi",
            'username' => "rymalfarizi",
            'email' => 'rayhanmalfarizi@gmail.com',
            'job' => "College Student",
            'is_admin' => true,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        User::factory(19)->create();
    }
}
