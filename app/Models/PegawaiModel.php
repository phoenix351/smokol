<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $primaryKey = "nip";
    protected $allowedFields = ['namaLengkap', "nip", "role", "jabatan", "bidang", "katasandi"];
    protected $table = 'pegawai';
    public function getPegawai()
    {
        return $this->findAll();
    }
    public function getAllNip()
    {
        return $this->select('nip')
            ->where('role!="Admin"')
            ->findAll();
    }
}
