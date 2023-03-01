<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $primaryKey = "id";
    protected $allowedFields = [
        "id", "id_barang", "tipe", "keluhan", "created_at", 'catatan_admin',
        "updated_at", "start_date", "end_date", "biaya", "status", "kondisi_final","bukti_rusak_berat"
    ];
    protected $table = 'perawatan_barang';
    public function getListPengajuan($id = null)
    {
        if (is_null($id)) {
            $data = $this->select("perawatan_barang.id,barang.nomor_seri, barang.jenis, barang.lokasi, barang.merk,barang.tipe as tipe_barang,perawatan_barang.id_barang, perawatan_barang.status,perawatan_barang.tipe, users.nama_lengkap as nama_pengguna,perawatan_barang.keluhan,biaya")
                ->join('barang', 'perawatan_barang.id_barang = barang.id')
                ->join('users', 'barang.user_id = users.id')
                ->findAll();
        } else {
            $data = $this->select("perawatan_barang.id,barang.nomor_seri, barang.jenis, barang.lokasi,barang.merk,barang.tipe as tipe_barang, perawatan_barang.id_barang, perawatan_barang.status,perawatan_barang.tipe, users.nama_lengkap as nama_pengguna,perawatan_barang.keluhan,biaya")
                ->join('barang', 'perawatan_barang.id_barang = barang.id')
                ->join('users', 'barang.user_id = users.id')
                ->where(['barang.user_id' => $id])
                ->findAll();
        }
        $hasil = [
            "PENDING" => [],
            "PROCESSED" => [],
            "DONE" => []
        ];
        foreach ($data as $row) {
            array_push($hasil[$row['status']], $row);
        }
        return $hasil;
    }
    public function getListPengajuan2($id = null)
    {
        if (is_null($id)) {
            $data = $this->select("perawatan_barang.id, barang.merk,barang.tipe as tipe_barang,perawatan_barang.id_barang, perawatan_barang.status,perawatan_barang.tipe, users.nama_lengkap as nama_pengguna,perawatan_barang.keluhan, biaya")
                ->join('barang', 'perawatan_barang.id_barang = barang.id')
                ->join('users', 'barang.user_id = users.id')
                ->findAll();
        } else {
            $data = $this->select("perawatan_barang.id,barang.merk,barang.tipe as tipe_barang, perawatan_barang.id_barang, perawatan_barang.status,perawatan_barang.tipe, users.nama_lengkap as nama_pengguna,perawatan_barang.keluhan, biaya")
                ->join('barang', 'perawatan_barang.id_barang = barang.id')
                ->join('users', 'barang.user_id = users.id')
                ->where(['barang.user_id' => $id])
                ->findAll();
        }
        $hasil = [
            "active" => [],
            "history" => []
        ];
        foreach ($data as $row) {
            if ($row['status'] == "DONE") {
                array_push($hasil["history"], $row);
            } else {
                array_push($hasil["active"], $row);
            }
        }
        return $hasil;
    }
    public function getPengajuanById($id)
    {
        return $this->select('barang.id,barang.merk, barang.tipe, barang.jenis, barang.nib, barang.nomor_seri, users.nama_lengkap, perawatan_barang.keluhan')
            ->join('barang', 'barang.id=perawatan_barang.id_barang')
            ->join('users', 'users.id=barang.user_id')
            ->where(['perawatan_barang.id' => $id])
            ->findAll();
    }
}
