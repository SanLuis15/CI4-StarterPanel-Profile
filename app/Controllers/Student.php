<?php

namespace App\Controllers;

use App\Models\StudentModel;

class Student extends BaseController
{
    // READ - Display all students
    public function index()
    {
        $studentModel = new StudentModel();
        $data = array_merge($this->data, [
            'title'    => 'Student Management',
            'students' => $studentModel->orderBy('created_at', 'DESC')->findAll()
        ]);
        return view('pages/commons/studentview', $data);
    }

    // READ - Show single student
    public function show($id)
    {
        $studentModel = new StudentModel();
        $student = $studentModel->find($id);
        
        if (!$student) {
            session()->setFlashdata('notif_error', 'Student not found');
            return redirect()->to('/students');
        }

        $data = array_merge($this->data, [
            'title'   => 'Student Details',
            'student' => $student
        ]);
        return view('pages/commons/student_show', $data);
    }

    // CREATE - Store data
    public function store()
    {
        $studentModel = new StudentModel();
        if (!$this->validate([
            'name'   => 'required|min_length[3]|max_length[100]',
            'email'  => 'required|valid_email|is_unique[students.email]',
            'course' => 'required|min_length[2]|max_length[50]',
        ])) {
            session()->setFlashdata('notif_error', implode('<br>', $this->validator->getErrors()));
            return redirect()->back()->withInput();
        }

        $data = [
            'name'   => $this->request->getPost('name'),
            'email'  => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];

        if ($studentModel->insert($data)) {
            session()->setFlashdata('notif_success', 'Student added successfully!');
        } else {
            session()->setFlashdata('notif_error', 'Failed to add student');
        }
        
        return redirect()->to('/students');
    }

    // UPDATE - Show edit form
    public function edit($id)
    {
        $studentModel = new StudentModel();
        $student = $studentModel->find($id);
        
        if (!$student) {
            session()->setFlashdata('notif_error', 'Student not found');
            return redirect()->to('/students');
        }

        $data = array_merge($this->data, [
            'title'   => 'Edit Student',
            'student' => $student
        ]);
        return view('pages/commons/student_edit', $data);
    }

    // UPDATE - Update data
    public function update($id)
    {
        $studentModel = new StudentModel();
        if (!$this->validate([
            'name'   => 'required|min_length[3]|max_length[100]',
            'email'  => "required|valid_email|is_unique[students.email,id,{$id}]",
            'course' => 'required|min_length[2]|max_length[50]',
        ])) {
            session()->setFlashdata('notif_error', implode('<br>', $this->validator->getErrors()));
            return redirect()->back()->withInput();
        }

        $data = [
            'name'   => $this->request->getPost('name'),
            'email'  => $this->request->getPost('email'),
            'course' => $this->request->getPost('course'),
        ];

        if ($studentModel->update($id, $data)) {
            session()->setFlashdata('notif_success', 'Student updated successfully!');
            return redirect()->to('/students');
        }

        session()->setFlashdata('notif_error', 'Failed to update student');
        return redirect()->back()->withInput();
    }

    // DELETE - Hard delete
    public function delete($id)
    {
        $studentModel = new StudentModel();
        $student = $studentModel->find($id);
        
        if (!$student) {
            session()->setFlashdata('notif_error', 'Student not found');
            return redirect()->to('/students');
        }

        // Hard delete
        if ($studentModel->delete($id)) {
            session()->setFlashdata('notif_success', 'Student deleted successfully!');
        } else {
            session()->setFlashdata('notif_error', 'Failed to delete student');
        }

        return redirect()->to('/students');
    }
}