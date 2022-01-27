<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAdmin extends Model
{
    protected $table      = 'loginadmin';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;

    protected $allowedFields = ['idAdmin', 'sessionID', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
