<?php

namespace Database\Seeders\Roles;


use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Roles of Users
     *
     * @return void
     */

    public function run(): void
    {
        try {
            $roles = ['admin', 'user'];
            foreach ($roles as $role) {
                Role::firstOrCreate(['name' => $role]);
            }

            $this->command->info("✔️ Roles seeder successfully!");
        } catch (Exception $e) {
            $this->command->error("❌ Roles seeder failed: " . $e->getMessage());
        }
    }
}
