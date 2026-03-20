<?php

namespace App\Controllers;

class StudentController extends BaseController
{
    public function dashboard()
    {
        $data = array_merge($this->data ?? [], [
            'title' => 'Student Dashboard'
        ]);
        
        return view('pages/commons/dashboard', $data);
    }
}
