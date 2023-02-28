<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $allowedFields = [
        'id', 'jenis', 'merk', "user_id", "tahun_peroleh", "kondisi",
        'status', "nomor_seri", "nib", "lokasi",
        "tipe", 'created_at', 'updated_at','bukti_rusak_berat'
    ];
    protected $primaryKey = "id";
    public function getBarangById($id = null)
    {
        if (is_null($id)) {
            return $this->select('barang.id as id, user_id users.nama_lengkap,barang.jenis,nomor_seri, nib,tipe,merk,kondisi,barang.status,tahun_peroleh,lokasi,barang.created_at,barang.updated_at,os')
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
    public function getKondisiSum($id = null)
    {
        $ret = [
            'Baik' => 0,
            'Rusak Ringan' => 0,
            'Rusak Berat' => 0,
            'Total' => 0
        ];
        if (is_null($id)) {
            $data =  $this->asArray()
                ->select('kondisi,count(id) as jumlah')
                ->groupBy('kondisi')
                ->where(['user_id <> ' => '5'])
                ->findAll();
        } else {
            $data =  $this->asArray()
                ->select('kondisi,count(id) as jumlah')
                ->where(['user_id' => $id])
                ->groupBy('kondisi')
                ->findAll();
        }
        foreach ($data as $d) {
            $ret[$d['kondisi']] = $d['jumlah'];
        }
        $ret['Total'] = $ret['Baik'] + $ret['Rusak Ringan'] + $ret['Rusak Berat'];
        return $ret;
    }



    public function balik_barang_pengguna($id)
    {

        $data = [
            "user_id" => 5
        ];


        $up  = $this->update($id, $data);
    }
    public function getRekap()
    {
        $arr = $this->asArray()
            ->select('jenis, kondisi, count(barang.id) as jumlah')
            ->groupBy('jenis, kondisi')
            ->findAll();
        $result = [];

        foreach ($arr as $elem) {
            $jenis = $elem['jenis'];
            if (!isset($result[$jenis])) {
                $result[$jenis] = [
                    "jenis" => $jenis
                ];
            }
            $result[$jenis][$elem['kondisi']] = $elem['jumlah'];
        }
        $indeks = 0;
        $hasil = [];
        foreach ($result as $e) {
            if (!isset($e['Baik'])) {
                $e['Baik'] = 0;
            }
            if (!isset($e['Rusak Ringan'])) {
                $e['Rusak Ringan'] = 0;
            }
            if (!isset($e['Rusak Berat'])) {
                $e['Rusak Berat'] = 0;
            }
            $e['Total'] = $e['Baik'] + $e['Rusak Berat'] + $e['Rusak Ringan'];
            $hasil[$indeks] = $e;
            $indeks++;
        }
        return $hasil;
    }
    public function getRekapRuangan()
    {
        $data = $this->select('lokasi, barang.jenis, count(barang.id) as jumlah')
            ->join('users', 'barang.user_id=users.id')
            ->where('users.id <>', '5')
            ->orderBy('lokasi', 'ASC')
            ->groupBy('lokasi,jenis')
            ->findAll();


        $ret = [
            'lokasi' => 'blom',
            'PC' => 0,
            'Laptop' => 0,
            'Printer' => 0,
            'Scanner' => 0,
            'UPS' => 0,
            'Lainnya' => 0,
            'Jumlah' => 0
        ];
        $array_jenis = ['PC', 'Printer', 'Laptop', 'Scanner', 'UPS'];
        $nilai = [];
        $ix = 0;
        $nama_sebelum = '';

        foreach ($data as $d) {

            if ($ix == 0 || ($d['lokasi'] != $nama_sebelum)) {
                array_push($nilai, $ret);
                $nilai[$ix]['lokasi'] = $d['lokasi'];
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
            $nama_sebelum = $d['lokasi'];
        }

        return $nilai;
    }
    public function getRekapBidang()
    {
        $data = $this->select('bidang, barang.jenis, count(barang.id) as jumlah')
            ->join('users', 'barang.user_id=users.id')
            ->where('users.id <>', '5')
            ->orderBy('bidang', 'ASC')
            ->groupBy('bidang,jenis')
            ->findAll();


        $ret = [
            'bidang' => 'blom',
            'PC' => 0,
            'Laptop' => 0,
            'Printer' => 0,
            'Scanner' => 0,
            'UPS' => 0,
            'Lainnya' => 0,
            'Jumlah' => 0
        ];
        $array_jenis = ['PC', 'Printer', 'Laptop', 'Scanner', 'UPS'];
        $nilai = [];
        $ix = 0;
        $nama_sebelum = '';

        foreach ($data as $d) {

            if ($ix == 0 || ($d['bidang'] != $nama_sebelum)) {
                array_push($nilai, $ret);
                $nilai[$ix]['bidang'] = $d['bidang'];
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

            $nama_sebelum = $d['bidang'];
        }

        return $nilai;
    }
    

    public function getRekapPemeliharaan()
    {
        $data = $this->select('barang.jenis, count(barang.jenis) as jumlah_item,sum(perawatan_barang.biaya) as jumlah_biaya')
            ->join('perawatan_barang', 'barang.id=perawatan_barang.id_barang')
            ->where('biaya >', '0')
            ->orderBy('jenis', 'ASC')
            ->groupBy('jenis')
            ->findAll();


        return $data;
    }
    
    public function getBarangRusak()
    {
        $data =  $this->select('ROW_NUMBER() OVER() AS num_row, barang.jenis, barang.tipe, barang.kondisi, barang.merk, barang.nomor_seri, barang.lokasi, users.nama_lengkap')
            ->join('users', 'barang.user_id=users.id')
            ->join('perawatan_barang','barang.id=perawatan_barang.id_barang','left')
            ->where("users.id<>5 and barang.kondisi like '%rusak%' and perawatan_barang.id is NULL")
            ->findAll();
            if( !$data) {
                $error = $db->error();
                return $error;
            }
            return $data;
        
    }
    
}
