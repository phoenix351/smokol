<?php



namespace App\Controllers;

use App\Models\KendaraanDinasModel;
use App\Models\BarangITModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Publik extends ResourceController
{
    use ResponseTrait;

    protected $helpers = ['auth'];



    public function index()
    {
        $it = new BarangITModel();
        $kbm = new KendaraanDinasModel();
        $sum_it = $it->getKondisiSum();
        $sum_kbm = $kbm->getKondisiSum();
        $sum_ = [
            'Baik' => 0,
            'Rusak Ringan' => 0,
            'Rusak Berat' => 0,
            'total' => 0
        ];
        $sum_['Baik'] = $sum_it['Baik'] + $sum_kbm['Baik'];
        $sum_['Rusak Ringan'] = $sum_it['Rusak Ringan'] + $sum_kbm['Rusak Ringan'];
        $sum_['Rusak Berat'] = $sum_it['Rusak Berat'] + $sum_kbm['Rusak Berat'];
        $sum_['total'] = $sum_['Baik'] + $sum_['Rusak Ringan'] + $sum_['Rusak Berat'];
        $data = [
            'barang_it'  => $it->getBarang(),
            'kbm' => $kbm->getBarang(),
            'sum' => $sum_,
            'title' => 'Daftar Barang',
            "app_name" => "SIMOKAP",
            "page_name" => "Dashboard",
            "uri" => $this->uri = service('uri')
        ];

        return view('user/index', $data);
    }
}
