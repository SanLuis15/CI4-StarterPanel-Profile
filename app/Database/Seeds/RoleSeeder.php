<?php

// app/Database/Seeds/RoleSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * RoleSeeder
 *
 * Creates the basic roles for the RBAC system.
 * Must be run BEFORE UserSeeder since users reference role IDs.
 *
 * Run with:  php spark db:seed RoleSeeder
 */
class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $roles = [
            [
                'name'        => 'admin',
                'description' => 'Administrator - Full system access',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'teacher',
                'description' => 'Teacher - Can manage students and classes',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'student',
                'description' => 'Student - Limited access to own data',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'name'        => 'coordinator',
                'description' => 'Coordinator - Can coordinate between teachers and students',
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        $this->db->table('roles')->insertBatch($roles);
    }
}