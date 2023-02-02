<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $admin = new User();
        $admin -> name = 'Elio Galindo';
        $admin -> email = 'eliogalindo@nauta.cu';
        $admin -> password = Hash::make( 'admin*2023');
        $admin -> role = 'Administrator';
        $admin -> save();
    }
}
