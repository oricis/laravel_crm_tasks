<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email'   => 'foo@mail.com',
            'name'    => 'Foo',
            'password'=> Hash::make('123456'),
        ]);
        User::create([
            'email'   => 'baz@mail.com',
            'name'    => 'Baz',
            'password'=> Hash::make('123456'),
        ]);
    }
}
