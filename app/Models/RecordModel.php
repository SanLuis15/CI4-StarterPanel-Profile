<?php

namespace App\Models;

use CodeIgniter\Model;

class RecordModel extends Model
{
    protected $table            = 'records';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'description', 'category', 'status'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'title'       => 'required|min_length[3]|max_length[255]',
        'description' => 'required|min_length[10]',
        'category'    => 'required',
        'status'      => 'required|in_list[active,inactive,pending]'
    ];

    protected $validationMessages = [
        'title' => [
            'required'   => 'Title is required',
            'min_length' => 'Title must be at least 3 characters',
        ],
        'description' => [
            'required'   => 'Description is required',
            'min_length' => 'Description must be at least 10 characters',
        ],
    ];
}
