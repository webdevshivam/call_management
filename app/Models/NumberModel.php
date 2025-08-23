
<?php

namespace App\Models;

use CodeIgniter\Model;

class NumberModel extends Model
{
    protected $table = 'numbers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'phone', 'company_id', 'telecaller_id', 'status', 'notes', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'phone' => 'required|min_length[10]|max_length[15]',
        'company_id' => 'required|integer'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
}
