<?php

namespace App\Models;

use CodeIgniter\Model;

class MyModel extends Model
{
    public function __construct()
    {
        parent::__construct();

        $db = \Config\Database::connect();
        $colunas = $db->getFieldNames($this->table);

        $this->allowedFields = $colunas;
    }
}