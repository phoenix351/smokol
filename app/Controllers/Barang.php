<?php

namespace App\Controllers;

use App\Models\BarangITModel;
use App\Models\MasterITModel;
use App\Models\PegawaiModel;
use Exception;

use function PHPUnit\Framework\throwException;

class Barang extends BaseController
{
    protected $barang_it_model;
    protected $master_it;
    protected $pegawai_model;
    protected $kondisi_list = [
        "Baik",
        "Rusak Ringan",
        "Rusak Berat"
    ];

    // list of builders
    protected $view_barang;
    protected $master_ruangan;
    protected $master_sistem_operasi;
    protected $history_barang;

    function __construct()
    {
        $this->barang_it_model = new BarangITModel();
        $this->master_it = new MasterITModel();
        $this->pegawai_model = new PegawaiModel();

        $this->database = \Config\Database::connect();

        $this->view_barang  = $this->database->table('view_barang_detail');
        $this->master_ruangan  = $this->database->table('master_ruangan');
        $this->master_sistem_operasi = $this->database->table('master_sistem_operasi');
        $this->history_barang = $this->database->table('history_barang');
    }

    public function index()
    {


        // query list barang of current user
        // $barang_list_query  = $this->view_barang->where('id_pengguna', user()->id)->get();
        $barang_list_query  = $this->view_barang->get();

        // $barang_list_query  = $barang_list_builder->get();
        $barang_list = $barang_list_query->getResultArray();
        $master_ruangan_query = $this->master_ruangan->get();
        $master_sistem_operasi_query = $this->master_sistem_operasi->get();

        // get
        $daftar_ruangan = $master_ruangan_query->getResultArray();
        $daftar_sistem_operasi = $master_sistem_operasi_query->getResultArray();



        $data = [
            // 'barang'  => $this->barang_it_model->getBarangByUser(user()->id),
            'barang'  => $barang_list,
            'title' => 'Daftar Barang IT',
            "daftar_ruangan" => $daftar_ruangan,
            "daftar_sistem_operasi" => $daftar_sistem_operasi,
            "app_name" => $this->app_name,
            "page_name" => "Barang IT Pengguna",
            "uri" => $this->uri = service('uri')
        ];
        return view('user/pengguna_barangit', $data);
    }

    public function get_last_history()
    {
        try {

            $id_barang = $this->request->getGet('id_barang');
            $history = $this->history_barang->where('id_barang', $id_barang)->orderBy('tanggal_perubahan', 'DESC')->get();

            $last_history = $history->getResultArray()['0'];
            return $this->response->setStatusCode(200)
                ->setContentType('application/json')
                ->setJSON($last_history);
        } catch (Exception $e) {
            return [$e->getCode(), $e->getMessage()];
        }
    }

    public function getMerkList()
    {
        return $this->respond([
            "data" => $this->master_it->getMerk(),
            "statusCode" => 200,
            "message" => "Berhasil mengambil data !"
        ]);
    }
    public function getTipeListByJenis($jenis)
    {

        return $this->respond([
            "data" => $this->master_it->getTipeByJenis($jenis),
            "statusCode" => 200,
            "input" => $jenis,
            "message" => "Berhasil mengambil data !"
        ]);
    }
    public function getTipeListByMerk()
    {
        $merk = $this->request->getGet('merk');
        $jenis = $this->request->getGet('jenis');
        return $this->respond([
            "data" => $this->master_it->getTipeByMerkJenis($merk, $jenis),
            "statusCode" => 200,
            "input" => $merk . $jenis,
            "message" => "Berhasil mengambil data !"
        ]);
    }



    public function getMerkByJenis($jenis)
    {

        return $this->respond([
            "data" => $this->master_it->getMerkByJenis($jenis),
            "statusCode" => 200,
            "message" => "Berhasil mengambil data !"
        ]);
    }

    protected function tambahBarang($data)
    {
        $barang = new BarangModel();

        //"tahunPeroleh" => $request->getPost('tahunPeroleh'),

        $barang->set($data);
        $barang->insert();
        return $barang->insertID;
    }

    public function tambahBarangIT()
    {
        $it = new BarangITModel();
        $request = service('request');
        $this->pengguna_model->kuasa(user()->id);

        $data_it = [
            'id' => $this->insertBarangForm(),
            'os' => $request->getPost('os')
        ];
        $it->set($data_it);
        $it->insert();

        return redirect()->to($request->getPost('url'))->with('message', 'Berhasil Menambahkan satu barang IT');
    }
    public function ubah_barangitByUser()
    {
        $barangModel = new BarangModel();
        $it = new BarangITModel();
        $request = service("request");
        $id = $request->getPost("id");
        if (strlen($id) < 2) {
            return redirect()->to($request->getPost('url'))->with('error', 'Gagal mengubah data barang!');
        }



        $data = [
            "jenis" => $request->getPost('jenis'),
            "merk" => $request->getPost('merk'),
            "tipe" => $request->getPost('tipe'),
            "tahun_peroleh" => $request->getPost('tahun_peroleh'),
            "kondisi" => $request->getPost('kondisi'),
            "nomor_seri" => $request->getPost('nomor_seri'),
            "nib" => $request->getPost('nib'),
            "lokasi" => $request->getPost('lokasi'),
        ];

        $up1  = $barangModel->update($id, $data);
        $data2 = [
            "os" => $request->getPost('os'),
        ];

        $up2 = $it->update($id, $data2);
        if ($up2 && $up1) {
            return redirect()->to($request->getPost('url'))->with('message', 'Berhasil mengubah data barang!');
        } else {
            return redirect()->to($request->getPost('url'))->with('error', 'Gagal mengubah data barang!');
        }
    }
    public function ubahBarangIT()
    {
        $barangModel = new BarangModel();
        $it = new BarangITModel();

        $request = service("request");

        $data = [
            "jenis" => $request->getPost('jenis'),
            "merk" => $request->getPost('merk'),
            "tipe" => $request->getPost('tipe'),
            "tahun_peroleh" => $request->getPost('tahun_peroleh'),
            "kondisi" => $request->getPost('kondisi'),
            "nomor_seri" => $request->getPost('nomor_seri'),
            "nib" => $request->getPost('nib'),
            "lokasi" => $request->getPost('lokasi'),
            "user_id" => $request->getPost('user_id'),
        ];
        $id = $request->getPost("id");
        if (strlen($id) < 2) {
            return redirect()->to($request->getPost('url'))->with('error', 'Gagal mengubah data barang!');
        }

        $up1  = $barangModel->update($id, $data);
        $data2 = [
            "os" => $request->getPost('os'),
        ];
        $up2 = $it->update($id, $data2);
        if ($up2 && $up1) {
            return redirect()->to($request->getPost('url'))->with('message', 'Berhasil mengubah data barang!');
        } else {
            return redirect()->to($request->getPost('url'))->with('error', 'Gagal mengubah data barang!');
        }
    }

    public function hapusBarangIT()
    {
        $request = service('request');
        $id = $request->getPost('id');
        if (strlen($id < 2)) {
            return redirect()->to($request->getPost('url'))->with('message', 'Gagal menghapus data barang!');
        }

        $model = new BarangITModel();
        if (isset($id)) {
            $hapus = $model->where('id', $id)->delete();
            if ($hapus) {
                return redirect()->to($request->getPost('url'))->with('error', 'Berhasil menghapus data barang!');
            }
        }
    }
    protected function insertBarangForm()
    {
        $request = service('request');
        $data = [
            "id" => null,
            "user_id" => (int)user()->id,
            "jenis" => $request->getPost('jenis'),
            "merk" => $request->getPost('merk'),
            "tipe" => $request->getPost('tipe'),
            "tahun_peroleh" => $request->getPost('tahun_peroleh'),
            "kondisi" => $request->getPost('kondisi'),
            "status" => $request->getPost('status'),
            "nomor_seri" => $request->getPost('nomor_seri'),
            "nib" => $request->getPost('nib'),
            "lokasi" => $request->getPost('lokasi'),
            "nip_pemakai" => $request->getPost('nip_pemakai'),


        ];
        return $this->tambahBarang($data);
    }

    public function pengguna_balik_barang()
    {

        $barangModel = new BarangModel();

        $id = $this->request->getPost('barang_id');
        if ($id == "" || is_null($id)) {
            return redirect()->to(base_url('user/pengguna_barangit'))->with('error', 'Gagal Mengembalikan Barang ke Gudang, ID tidak valid');
        } else {

            $barangModel->balik_barang_pengguna($id);
            //return success
            return redirect()->to(base_url('user/pengguna_barangit'))->with('message', 'Berhasil Mengembalikan Barang ke Gudang' . $id);
        }
    }
    public function ubah_barangit_pengguna($id = null)
    {
        $it = new BarangITModel();
        $request = service("request");
        $data = $it->getBarangById($id)[0];
        if (user()->id != $it->getBarangById($id)[0]['user_id']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data = [
            "id" => $id,
            "app_name" => $this->app_name,
            'jenis_list' => $this->jenis_list,
            'merk_list' => $this->merk_list,
            'tipe_list' => $this->tipe_list,
            'os_list' => $this->os_list,
            'room_list' => $this->room_list,
            "page_name" => "Kelola Pengajuan",
            "uri" => $this->uri = service('uri'),
            "barang" => $data

        ];
        return view("user/ubah_barangit_pengguna", $data);
    }
}
