<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function show()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');
        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $data = array_merge($this->data, [
            'user' => $user,
            'role_label' => $user['role_label'] ?? ucfirst($user['role'] ?? 'User')
        ]);
        return view('profile/show', $data);
    }

    public function edit()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');
        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $data = array_merge($this->data, ['user' => $user]);
        return view('profile/edit', $data);
    }

    public function update()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $username = session()->get('username');
        $user = $this->userModel->where('username', $username)->first();

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $userId = $user['id'];

        $rules = [
            'fullname' => 'required|min_length[3]|max_length[100]',
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$userId}]",
            'student_id' => 'permit_empty|max_length[20]',
            'course' => 'permit_empty|max_length[100]',
            'year_level' => 'permit_empty|integer|in_list[1,2,3,4,5]',
            'section' => 'permit_empty|max_length[50]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];

        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($this->validate(['profile_image' => 'is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]'])) {
                $uploadPath = FCPATH . 'uploads/profiles/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if (!empty($user['profile_image'])) {
                    $oldImagePath = $uploadPath . $user['profile_image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                $ext = $file->getExtension();
                $newName = 'avatar_' . $userId . '_' . time() . '.' . $ext;
                $file->move($uploadPath, $newName);
                $updateData['profile_image'] = $newName;
            }
        }

        if ($this->userModel->updateProfile($userId, $updateData)) {
            session()->set('fullname', $updateData['fullname']);
            session()->set('username', $updateData['username']);
            if (isset($updateData['profile_image'])) {
                session()->set('profile_image', $updateData['profile_image']);
            }
            return redirect()->to('/profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
    }

    public function settings()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        $roleName = session('user')['role'] ?? '';
        $canEdit = ($roleName === 'admin');

        $data = array_merge($this->data, [
            'title' => 'Settings',
            'canEdit' => $canEdit
        ]);
        
        return view('profile/settings', $data);
    }
}