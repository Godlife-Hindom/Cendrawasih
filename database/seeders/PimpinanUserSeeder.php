<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class PimpinanUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    User::create([
        'name' => 'Pimpinan BKSDA',
        'email' => 'pimpinan@example.com',
        'password' => Hash::make('password'),
        'role' => 'pimpinan',
    ]);
}
}
