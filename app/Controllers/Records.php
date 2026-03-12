<?php

namespace App\Controllers;

use App\Models\RecordModel;

class Records extends BaseController
{
    // READ - Display all records
    public function index()
    {
        $recordModel = new RecordModel();
        $data = array_merge($this->data, [
            'title'   => 'Records List',
            'records' => $recordModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager'   => $recordModel->pager
        ]);
        return view('pages/records/index', $data);
    }

    // READ - Show single record
    public function show($id)
    {
        $recordModel = new RecordModel();
        $record = $recordModel->find($id);
        
        if (!$record) {
            session()->setFlashdata('notif_error', 'Record not found');
            return redirect()->to('/records');
        }

        $data = array_merge($this->data, [
            'title'  => 'Record Details',
            'record' => $record
        ]);
        return view('pages/records/show', $data);
    }

    // CREATE - Show form
    public function create()
    {
        $data = array_merge($this->data, [
            'title' => 'Create New Record'
        ]);
        return view('pages/records/create', $data);
    }

    // CREATE - Store data
    public function store()
    {
        $recordModel = new RecordModel();
        if (!$this->validate($recordModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category'    => $this->request->getPost('category'),
            'status'      => $this->request->getPost('status')
        ];

        if ($recordModel->insert($data)) {
            session()->setFlashdata('notif_success', 'Record created successfully!');
            return redirect()->to('/records');
        }

        session()->setFlashdata('notif_error', 'Failed to create record');
        return redirect()->back()->withInput();
    }

    // UPDATE - Show edit form
    public function edit($id)
    {
        $recordModel = new RecordModel();
        $record = $recordModel->find($id);
        
        if (!$record) {
            session()->setFlashdata('notif_error', 'Record not found');
            return redirect()->to('/records');
        }

        $data = array_merge($this->data, [
            'title'  => 'Edit Record',
            'record' => $record
        ]);
        return view('pages/records/edit', $data);
    }

    // UPDATE - Update data
    public function update($id)
    {
        $recordModel = new RecordModel();
        if (!$this->validate($recordModel->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'category'    => $this->request->getPost('category'),
            'status'      => $this->request->getPost('status')
        ];

        if ($recordModel->update($id, $data)) {
            session()->setFlashdata('notif_success', 'Record updated successfully!');
            return redirect()->to('/records');
        }

        session()->setFlashdata('notif_error', 'Failed to update record');
        return redirect()->back()->withInput();
    }

    // DELETE - Hard delete
    public function delete($id)
    {
        $recordModel = new RecordModel();
        $record = $recordModel->find($id);
        
        if (!$record) {
            session()->setFlashdata('notif_error', 'Record not found');
            return redirect()->to('/records');
        }

        // Hard delete
        if ($recordModel->delete($id)) {
            session()->setFlashdata('notif_success', 'Record deleted successfully!');
        } else {
            session()->setFlashdata('notif_error', 'Failed to delete record');
        }

        return redirect()->to('/records');
    }
}
