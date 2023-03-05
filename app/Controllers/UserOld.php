<?php

namespace App\Controllers;



use App\Models\KendaraanDinasModel;
use App\Models\BarangITModel;
use App\Models\PegawaiModel;
use App\Models\BarangModel;
use App\Models\PengajuanModel;
use App\Models\PenggunaModel;
use App\Models\GrupModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MasterITModel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\ThirdParty\fpdf\FPDF;

helper(array('url', 'download'));

class User extends ResourceController
{

    use ResponseTrait;
    function __construct()
    {
        $this->pdf = new FPDF();
        $this->request = service('request');
        $this->it = new BarangITModel();
        $this->barang_model = new BarangModel();
        $this->master_it = new MasterITModel();

        $this->pengguna_model = new PenggunaModel();
        $this->pengajuan_model = new PengajuanModel();
        $this->client = \Config\Services::curlrequest();
    }


    protected $app_name = "SMOKOL";
}
