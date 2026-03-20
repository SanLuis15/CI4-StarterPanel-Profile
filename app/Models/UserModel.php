<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $useSoftDeletes = false;
    protected $deletedField = 'deleted_at';
    
    protected $allowedFields = [
        'fullname', 'username', 'password', 'role', 'role_id',
        'student_id', 'course', 'year_level',
        'section', 'phone', 'address', 'profile_image', 'deleted_at'
    ];

    public function updateProfile(int $userId, array $data): bool
    {
        return $this->update($userId, $data);
    }
}
