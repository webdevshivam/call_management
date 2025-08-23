
<?php

namespace App\Models;

use CodeIgniter\Model;

class TelecallerModel extends Model
{
    protected $table = 'telecaller';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'email', 'phone', 'username', 'password', 'address', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[telecaller.email,id,{id}]',
        'phone' => 'required|min_length[10]|max_length[15]',
        'username' => 'required|min_length[3]|max_length[50]|is_unique[telecaller.username,id,{id}]',
        'password' => 'required|min_length[6]',
        'address' => 'required'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
