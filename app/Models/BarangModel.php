<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $allowedFields = [
        'jenis', 'merk', "user_id", "tahun_peroleh", "kondisi",
        'status', "nomor_seri", "nib", "lokasi",
        "tipe", 'updated_at'
    ];
    protected $primaryKey = "id";
}
