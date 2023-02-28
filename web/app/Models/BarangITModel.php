<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangITModel extends Model
{
    protected $table = 'barang_it';
    protected $allowedFields = [
        'id', "os"
    ];
    protected $primaryKey = "id";

    public function getBarangById($id = null)
    {
        if (is_null($id)) {
            return $this->select('barang.id as id, user_id, users.nama_lengkap,barang.jenis,nomor_seri, nib,tipe,merk,kondisi,barang.status,tahun_peroleh,lokasi,barang.created_at,barang.updated_at,os')
                ->join('barang', 'barang_it.id=barang.id')
                ->join('users', 'barang.user_id=users.id')
                ->findAll();
        } else {
            return $this->select('barang.id as id, user_id, barang.jenis,nomor_seri,nama_lengkap,nib,tipe,merk,kondisi,barang.status,tahun_peroleh,lokasi,barang.created_at,barang.updated_at,os')
                ->join('barang', 'barang_it.id=barang.id')
                ->join('users', 'barang.user_id=users.id')
                ->where(['barang.id' => $id])
                ->findAll();
        }
    }
    public function getBarangByUser($id = null)
    {
        if (is_null($id)) {
            return $this->select('barang.id as id ,barang.jenis,nomor_seri, nib,tipe,merk,kondisi,barang.status,tahun_peroleh,lokasi,barang.created_at,barang.updated_at,os')
                ->join('barang', 'barang_it.id=barang.id')
                ->join('users', 'barang.user_id=users.id')
                ->where('users.id <>', '5')
                ->findAll();
        } else {
            return $this->select('barang.id as id ,barang.jenis,nomor_seri,nama_lengkap,nib,tipe,merk,kondisi,barang.status,tahun_peroleh,lokasi,barang.created_at,barang.updated_at,os')
                ->join('barang', 'barang_it.id=barang.id')
                ->join('users', 'barang.user_id=users.id')
                ->where(['barang.user_id' => $id])
                ->findAll();
        }
    }

    public function getRekapBiaya()
    {

        return $this->select('barang.jenis, barang.merk,barang.tipe, users.nama_lengkap as nama_pemakai, YEAR(perawatan_barang.start_date) as tahun, sum(perawatan_barang.biaya) as total_biaya')
            ->join('barang', 'barang.id=barang_it.id')
            ->join('perawatan_barang', 'barang.id=perawatan_barang.id_barang')
            ->join('users', 'barang.user_id=users.id')
            ->groupBy('tahun')
            ->findAll();
    }

    public function getKondisiSum($user_id = null)
    {
        $ret = [
            'Baik' => 0,
            'Rusak Ringan' => 0,
            'Rusak Berat' => 0,
            'total' => 0
        ];
        if (is_null($user_id)) {
            $data =  $this->asArray()
                ->select('kondisi,count(barang.id) as jumlah')
                ->join('barang', 'barang_it.id=barang.id')
                ->join('users', 'barang.user_id=users.id')
                ->where('users.id <>', '5')
                ->groupBy('kondisi')
                ->findAll();
        } else {
            $data =  $this->asArray()
                ->select('kondisi,count(id) as jumlah')
                ->join('barang', 'barang_it.id=barang.id')
                ->join('users', 'barang.user_id=users.id')
                ->where('users.id <>', '5')
                ->where(['user_id' => $user_id])
                ->groupBy('kondisi')
                ->findAll();
        }
        foreach ($data as $d) {
            $ret[$d['kondisi']] = $d['jumlah'];
        }
        $ret['total'] = $ret['Baik'] + $ret['Rusak Ringan'] + $ret['Rusak Berat'];
        return $ret;
    }
}
