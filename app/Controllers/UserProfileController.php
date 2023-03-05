<?php

use CodeIgniter\Config\BaseConfig;
use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class UserProfileController extends BaseController
{
    private $app_name;
    private $uri;

    private $pengguna_model;

    public function __construct()
    {
        $this->uri = service('uri');
        $this->app_name = "Smokol";
        $this->pengguna_model = new penggunaModel();
    }
    public function index()
    {
        $data = [
            "app_name" => $this->app_name,
            "page_name" => "Profile",
            "uri" => $this->uri,
        ];
        return view('user/profile', $data);
    }

    public function ubah_profil_data()
    {

        //ambil data dari form
        $user_id = user()->id;
        if (strlen($user_id) < 1) {
            return redirect()->to(base_url('user/profile'))->with('error', 'Gagal Mengubah Profil');
        }

        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $nip = $this->request->getPost('nip');
        $bidang = $this->request->getPost('bidang');
        $email = $this->request->getPost('email');
        $data = [
            'nama_lengkap' => $nama_lengkap,
            'nip' => $nip,
            'bidang' => $bidang,
            'email' => $email,
        ];

        $hasil = $this->pengguna_model->update($user_id, $data);
        if ($hasil) {
            return redirect()->to(base_url('user/profile'))->with('message', 'Berhasil Update Data Profil !');
        } else {
            return redirect()->to(base_url('user/profile'))->with('error', 'Gagal Mengubah Profil');
        }
    }

    public function ubah_foto()
    {
        //ambil foto
        $foto = $this->request->getFile('foto-baru');


        $fileName = user()->username . '.' . $foto->getClientExtension();
        $foto->move('assets/profil_pics/', $fileName, true);

        //update db
        if (strlen(user()->id) < 1) {
            return redirect()->to(base_url('user/profile'))->with('error', 'Terjadi kesalahan');
        }
        $this->pengguna_model->update(user()->id, ['foto' => $fileName]);
        return redirect()->to(base_url('user/profile'))->with('message', 'Foto Profil anda berhasil diubah');
    }
}
