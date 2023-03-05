<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminBarang extends BaseController
{
    public function index()
    {


        $data = [
            'barang'  => $this->barang_it_model->getBarangById(),
            'user_list' => $this->pengguna_model->getUserName(),
            'title' => 'Daftar Barang IT',
            'jenis_list' => $this->jenis_list,
            'os_list' => $this->os_list,
            'room_list' => $this->room_list,
            'merk_list' => $this->merk_list,
            'tipe_list' => $this->tipe_list,
            "app_name" => $this->app_name,
            'users_list' => $this->pengguna_model->getUser(),
            "page_name" => "Kelola Barang IT",
            "uri" => $this->uri = service('uri')
        ];
        return view('user/kelola_barangit', $data);
    }
    public function admin_ubah_barang($id = null)
    {
        $it = new BarangITModel();
        $request = service("request");
        $data = $it->getBarangById($id)[0];



        $data = [
            "id" => $id,
            "app_name" => $this->app_name,
            'jenis_list' => $this->jenis_list,
            'merk_list' => $this->merk_list,
            'tipe_list' => $this->tipe_list,
            'os_list' => $this->os_list,
            'room_list' => $this->room_list,
            'users_list' => $this->pengguna_model->getUser(),
            "page_name" => "Kelola Pengajuan",
            "uri" => $this->uri = service('uri'),
            "barang" => $data

        ];
        return view("user/admin_ubah_barang", $data);
    }
}
