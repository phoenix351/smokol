<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PenggunaModel extends Model
{
    protected $primaryKey = "id";
    protected $allowedFields = ['id', "nama_lengkap", 'foto', "email", "nip", "bidang", "password_hash", "active", "kuasa"];
    protected $table = 'users';

    public function getUser($id = null)
    {
        if (is_null($id)) {
            return $this->select('users.id as id,nama_lengkap ,email,nip,bidang,active,auth_groups.name as role')
                ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
                ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')
                ->findAll();
        } else {
            return $this->select('users.id as id,nama_lengkap ,email,nip,bidang,active,auth_groups.name as role')
                ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
                ->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id')
                ->where(['id' => $id])
                ->findAll();
        }
    }
    public function getUserName()
    {
        return $this->select('id,nama_lengkap')->findAll();
    }
    public function getAllNip()
    {
        return $this->select('nip')
            ->findAll();
    }
    public function tidak_kuasa($user_id)
    {
        $up = $this->update($user_id, ["kuasa" => '0']);
        if ($up) {
            return true;
        } else {
            return false;
        }
    }
    public function kuasa($user_id)
    {
        $up = $this->update($user_id, ["kuasa" => '1']);
        if ($up) {
            return true;
        } else {
            return false;
        }
    }
    public function getRekapBarang()
    {
        $data = $this->select('nama_lengkap, barang.jenis, count(barang.id) as jumlah')
            ->join('barang', 'barang.user_id=users.id', 'left')
            ->where('users.id <>', '5')
            ->orderBy('nama_lengkap', 'ASC')
            ->groupBy('nama_lengkap,jenis')
            ->findAll();


        $ret = [
            'nama_lengkap' => 'blom',
            'PC' => 0,
            'Laptop' => 0,
            'Printer' => 0,
            'Scanner' => 0,
            'UPS' => 0,
            'Lainnya' => 0,
            'Jumlah' => 0,
        ];
        $array_jenis = ['PC', 'Printer', 'Laptop', 'Scanner', 'UPS'];
        $nilai = [];
        $ix = 0;
        $nama_sebelum = '';

        foreach ($data as $d) {

            if ($ix == 0 || ($d['nama_lengkap'] != $nama_sebelum)) {
                array_push($nilai, $ret);
                $nilai[$ix]['nama_lengkap'] = $d['nama_lengkap'];
            } else {
                $ix--;
            }

            if (in_array($d['jenis'], $array_jenis)) {
                $nilai[$ix][$d['jenis']] = $d['jumlah'];
                $nilai[$ix]['Jumlah'] += $d['jumlah'];
                $ix++;
            } else {
                $nilai[$ix]['Lainnya'] = $nilai[$ix]['Lainnya'] + $d['jumlah'];
                $nilai[$ix]['Jumlah'] += $d['jumlah'];
                $ix++;
            }
            $nama_sebelum = $d['nama_lengkap'];
        }

        return $nilai;
    }
}
