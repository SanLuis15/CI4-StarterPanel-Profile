<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;

class UserAdminController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $users = $db->table('users')
            ->select('users.id, users.fullname, users.username, users.role_id, roles.name as role_name, roles.label as role_label')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->get()->getResultArray();
            
        $roles = (new RoleModel())->findAll();

        $data = array_merge($this->data ?? [], ['users' => $users, 'roles' => $roles]);
        return view('admin/users/index', $data);
    }

    public function assignRole($id)
    {
        $db = \Config\Database::connect();
        $user = $db->table('users')->where('id', $id)->get()->getRowArray();
        if (!$user) return redirect()->to('/admin/users')->with('error', 'User not found.');

        $currentUserRole = session('user')['role'];
        $currentUserId = session('user')['id'];
        
        if ($user['id'] === $currentUserId) {
            return redirect()->to('/admin/users')->with('error', 'You cannot change your own role.');
        }

        $roleId = $this->request->getPost('role_id');
        
        $db->table('users')->where('id', $id)->update(['role_id' => $roleId]);

        return redirect()->to('/admin/users')->with('success', 'Role assigned successfully.');
    }

    public function storeUser()
    {
        $db = \Config\Database::connect();
        
        $fullname = $this->request->getPost('fullname');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $roleId   = $this->request->getPost('role_id');

        $db->table('users')->insert([
            'fullname' => $fullname,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => $roleId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/users')->with('success', 'User created and role assigned!');
    }

    public function deleteUser($id)
    {
        $db = \Config\Database::connect();
        
        // Optionally prevent deleting admin role
        if ($id == session('user')['id']) {
            return redirect()->to('/admin/users')->with('error', 'You cannot delete your own account.');
        }

        $db->table('users')->where('id', $id)->delete();

        return redirect()->to('/admin/users')->with('success', 'User deleted successfully.');
    }
}
