<?php

// app/Database/Seeds/MainSeeder.php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * MainSeeder
 *
 * Runs all seeders in the correct order to avoid foreign key errors.
 * This is the recommended way to seed the entire database.
 *
 * Run with:  php spark db:seed MainSeeder
 */
class MainSeeder extends Seeder
{
    public function run(): void
    {
        // Run seeders in dependency order
        $this->call('RoleSeeder');      // Must run first - creates roles
        $this->call('UserSeeder');      // Depends on roles existing
        
        // Add other seeders here as needed
        // $this->call('StudentSeeder');
        // $this->call('SystemSeeder');
    }
}