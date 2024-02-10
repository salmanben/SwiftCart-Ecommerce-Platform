<?php

namespace Database\Seeders;

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
        User::create([
           'name'=>'salman',
           'image'=>'admin.png',
           'email'=>'benomarsalman11212@gmail.com',
           'phone'=>'0899879788',
           'password'=>Hash::make('SALMAN123'),
           'role'=>'admin',
           'email_verified_at'=>Carbon::now()->toDateString(),

        ]);
    }
}
