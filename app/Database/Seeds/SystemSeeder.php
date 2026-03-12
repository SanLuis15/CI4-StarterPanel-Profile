<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SystemSeeder extends Seeder
{
    public function run()
    {
        // Insert user roles
        $this->db->table('user_role')->insertBatch([
            ['role_name' => 'Admin'],
            ['role_name' => 'User'],
        ]);

        // Insert menu categories
        $this->db->table('user_menu_category')->insertBatch([
            ['menu_category' => 'Common Page'],
            ['menu_category' => 'Management'],
        ]);

        // Insert menus
        $this->db->table('user_menu')->insertBatch([
            ['menu_category' => 1, 'title' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'speedometer', 'parent' => 0],
            ['menu_category' => 2, 'title' => 'Students', 'url' => 'students', 'icon' => 'people', 'parent' => 0],
            ['menu_category' => 2, 'title' => 'Records', 'url' => 'records', 'icon' => 'folder', 'parent' => 0],
        ]);
    }
}
