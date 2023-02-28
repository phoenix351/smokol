<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterITModel extends Model
{
    protected $table = 'master_it';
    protected $allowedFields = [
        'id', "merk", "tipe"
    ];
    protected $primaryKey = "id";
    public function getMerk()
    {
        return $this->select("distinct(merk)")->findAll();
    }
    public function getTipeByMerkJenis($merk, $jenis)
    {
        return $this->select("distinct(tipe)")->where(["merk" => $merk, "jenis" => $jenis])->findAll();
    }
    public function getMerkByJenis($jenis)
    {
        return $this->select("distinct(merk)")->where(["jenis" => $jenis])->findAll();
    }
    public function getTipeByJenis($jenis)
    {
        return $this->select("distinct(tipe)")->where(["jenis" => $jenis])->findAll();
    }
}
