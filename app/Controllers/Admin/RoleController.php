<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;

class RoleController extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        // Get roles with user counts
        $db = \Config\Database::connect();
        $roles = $db->table('roles')
            ->select('roles.*, (SELECT COUNT(id) FROM users WHERE users.role_id = roles.id) as user_count')
            ->get()->getResultArray();

        $data = array_merge($this->data ?? [], ['roles' => $roles]);
        return view('admin/roles/index', $data);
    }

    public function create()
    {
        $data = array_merge($this->data ?? [], []);
        return view('admin/roles/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'name' => 'required|is_unique[roles.name]|regex_match[/^[a-z_]+$/]',
            'label' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->roleModel->save([
            'name' => $this->request->getPost('name'),
            'label' => $this->request->getPost('label'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/roles')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = $this->roleModel->find($id);
        if (!$role) return redirect()->to('/admin/roles')->with('error', 'Role not found.');

        $data = array_merge($this->data ?? [], ['role' => $role]);
        return view('admin/roles/edit', $data);
    }

    public function update($id)
    {
        $role = $this->roleModel->find($id);
        if (!$role) return redirect()->to('/admin/roles')->with('error', 'Role not found.');

        // Lock slug for core roles
        $coreRoles = ['admin', 'teacher', 'student'];
        $name = $this->request->getPost('name');
        
        if (in_array($role['name'], $coreRoles)) {
            $name = $role['name']; // Can't change
        }

        if (!$this->validate([
            'name' => "required|regex_match[/^[a-z_]+$/]|is_unique[roles.name,id,$id]",
            'label' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->roleModel->update($id, [
            'name' => $name,
            'label' => $this->request->getPost('label'),
            'description' => $this->request->getPost('description')
        ]);

        return redirect()->to('/admin/roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $role = $this->roleModel->find($id);
        if (!$role) return redirect()->to('/admin/roles')->with('error', 'Role not found.');

        if ($role['name'] === 'admin') {
            return redirect()->to('/admin/roles')->with('error', 'Cannot delete admin role.');
        }

        // Unassign affected users
        $db = \Config\Database::connect();
        $db->table('users')->where('role_id', $id)->update(['role_id' => null]);

        $this->roleModel->delete($id);
        return redirect()->to('/admin/roles')->with('success', 'Role deleted successfully.');
    }
}
