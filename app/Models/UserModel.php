<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'password',
        'role',
        'actif'
    ];

    protected $useTimestamps = false;
}