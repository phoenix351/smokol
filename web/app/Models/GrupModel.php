<?php

namespace App\Models;

use CodeIgniter\Model;

class GrupModel extends Model
{
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['group_id', 'user_id'];
    protected $table = 'auth_groups_users';
}
