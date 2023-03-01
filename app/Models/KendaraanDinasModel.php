<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanDinasModel extends Model
{
    protected $table = 'kendaraan_dinas';
    protected $allowedFields = [
        'id',"nomor_plat", "besar_cc"
    ];
    protected $primaryKey = "id";

    public function getBarang($nip = null)
    {
        if (is_null($nip)) {
            return $this->select('barang.id as id ,nama,nomor_seri,tipe,merk,kondisi,status,tahun_peroleh,nip_pemakai,lokasi,created_at,updated_at,besar_cc,nomor_plat')
            ->join('barang','kendaraan_dinas.id=barang.id')
            ->findAll();
        } else {
            return $this->select('barang.id as id ,nama,nomor_seri,tipe,merk,kondisi,status,tahun_peroleh,nip_pemakai,lokasi,created_at,updated_at,besar_cc,nomor_plat')
                ->join('barang','kendaraan_dinas.id=barang.id')
                ->where(['nip_pemakai' => $nip])
                ->findAll();
        }
    }


    public function getKondisiSum($nip = null)
    {
        $data = [
            "Baik" => 0,
            "Rusak Ringan" => 0,
            "Rusak Berat" => 0,
            "total" => 0
        ];

        if (is_null($nip)) {
            $rets =  $this->asArray()
                ->select('kondisi,count(barang.id) as jumlah')
                ->join('barang','kendaraan_dinas.id=barang.id')
                ->groupBy('kondisi')
                ->findAll();
        } else {
            $rets = $this->asArray()
                ->select('kondisi,count(barang.id) as jumlah')
                ->join('barang','kendaraan_dinas.id=barang.id')
                ->where(['nip_pemakai' => $nip])
                ->groupBy('kondisi')
                ->findAll();
        }
        foreach ($rets as $ret) {
            $data[$ret['kondisi']] = $ret['jumlah'];
        }
        $data['total'] = $data['Baik'] + $data['Rusak Ringan'] + $data['Rusak Berat'];
        return $data;
    }
    public function getRekap()
    {
        $arr = $this->asArray()
            ->select('tipe, kondisi, count(barang.id) as jumlah')
            ->join('barang','barang.id=kendaraan_dinas.id')
            ->groupBy('tipe, kondisi')
            ->findAll();
        $result = [];

        foreach ($arr as $elem) {
            $tipe = $elem['tipe'];
            if (!isset($result[$tipe])) {
                $result[$tipe] = [
                    "tipe" => $tipe
                ];
            }
            $result[$tipe][$elem['kondisi']] = $elem['jumlah'];
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
}
