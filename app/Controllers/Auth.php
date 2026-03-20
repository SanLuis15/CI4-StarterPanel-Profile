<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') == TRUE) {
            return redirect()->to(base_url('dashboard'));
        }

        if (!$this->validate(['inputEmail'  => 'required'])) {
            return view('pages/commons/login');
        } else {
            $inputEmail     = $this->request->getVar('inputEmail');
            $inputPassword  = $this->request->getVar('inputPassword');
            $db = \Config\Database::connect();
            $user = $db->table('users')
                ->select('users.*, roles.name as role_name')
                ->join('roles', 'roles.id = users.role_id', 'left')
                ->where('username', $inputEmail)
                ->get()->getRowArray();
            if ($user) {
                $password        = $user['password'];
                $verify = password_verify($inputPassword, $password);
                if ($verify) {
                    session()->set([
                        'user' => [
                            'id' => $user['id'],
                            'name' => $user['fullname'],
                            'email' => $user['username'],
                            'role' => $user['role_name'],
                        ],
                        // Maintain original project's top level session data
                        'username'        => $user['username'],
                        'fullname'        => $user['fullname'],
                        'role'            => $user['role'],
                        'profile_image'   => $user['profile_image'] ?? '',
                        'isLoggedIn'      => TRUE
                    ]);
                    return match($user['role_name']) {
                        'admin' => redirect()->to('/dashboard'),
                        'teacher' => redirect()->to('/dashboard'),
                        'student' => redirect()->to('/student/dashboard'),
                        default => redirect()->to('/login'),
                    };
                } else {
                    session()->setFlashdata('notif_error', '<b>Your ID or Password is Wrong !</b> ');
                    return redirect()->to(base_url('login'));
                }
            } else {
                session()->setFlashdata('notif_error', '<b>Your ID or Password is Wrong!</b> ');
                return redirect()->to(base_url('login'));
            }
        }
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }

    public function forbiddenPage()
    {
        $data = array_merge($this->data ?? [], [
            'title'         => 'Forbidden Page'
        ]);
        return view('pages/commons/forbidden', $data);
    }

    public function unauthorized()
    {
        $data = array_merge($this->data ?? [], [
            'title' => 'Unauthorized Access'
        ]);
        return view('errors/unauthorized', $data);
    }

    public function register()
    {
        return view('pages/commons/register');
    }

    public function registration()
    {
        if (!$this->validate([
            'inputEmail'     => ['label' => 'Email', 'rules' => 'is_unique[users.username]'],
            'inputPassword'  => ['label' => 'Password', 'rules' => 'required'],
            'inputPassword2' => ['label' => 'Password Confirmation', 'rules' => 'matches[inputPassword]'],
        ])) {
            $data = array_merge($this->data, [
                'title'         => 'Register Page',
            ]);

            session()->setFlashdata('notif_error', $this->validation->getError('inputPassword2') . ' ' . $this->validation->getError('inputEmail'));
            return view('pages/commons/register', $data);
        } else {
            $inputFullname = $this->request->getVar('inputFullname');
            $inputEmail    = $this->request->getVar('inputEmail');
            $inputPassword = $this->request->getVar('inputPassword');
            $dataUser      = [
                'inputFullname' => $inputFullname,
                'inputUsername' => $inputEmail,
                'inputPassword' => $inputPassword,
                'inputRole'     => 1
            ];
            $this->ApplicationModel->createUser($dataUser);
            session()->setFlashdata('notif_success', '<b>Registration Successfully!</b> Please login with your account.');
            return view('pages/commons/login');
        }
    }
}
