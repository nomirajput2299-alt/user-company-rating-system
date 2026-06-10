<?php

namespace Database\Seeders\Users;


use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Seeder of Users
     *
     * @return void
     */

    public function run(): void
    {
        try {
            $users = [
                [
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'phoneNumber' => '03000000000',
                    'avatar' => null,
                    'status' => 1,
                    'role' => 'admin',
                    'password' => 'password',
                ],
                [
                    'name' => 'User',
                    'email' => 'user@example.com',
                    'phoneNumber' => '03111111111',
                    'avatar' => null,
                    'status' => 1,
                    'role' => 'user',
                    'password' => 'password',
                ],
            ];

            foreach ($users as $data) {
                $role = $data['role'];
                unset($data['role']); // IMPORTANT (not stored in users table)
                $data['password'] = Hash::make($data['password']);

                $user = User::updateOrCreate(
                    ['email' => $data['email']],
                    $data
                );

                // Assign Spatie Role
                $user->assignRole($role);
            }

            $this->command->info('✔ Users seeded with roles successfully!');
        } catch (Exception $e) {
            $this->command->error('❌ Users seeder failed: ' . $e->getMessage());
        }
    }
}
