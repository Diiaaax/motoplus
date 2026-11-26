<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('ADMIN_PASSWORD') ?: Str::password(16);

        User::create([
            'name' => 'Super Admin',
            'email' => env('ADMIN_EMAIL', 'admin@motoplus.dz'),
            'password' => bcrypt($password),
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        if (! env('ADMIN_PASSWORD')) {
            $this->command?->warn("Generated admin password: {$password} (set ADMIN_PASSWORD in .env to choose your own)");
        }
    }
}
