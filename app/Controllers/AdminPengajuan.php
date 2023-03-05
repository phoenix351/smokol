<?php

use App\Controllers\BaseController;

class AdminPengajuan extends BaseController
{

    public function index()
    {
        $status = [
            "PENDING",
            "PROCESSED",
            "DONE"
        ];
        $model = new PengajuanModel();
        $id = user()->id;
        $pengajuan = $model->getListPengajuan2($id);



        $data = [
            "active" => $pengajuan['active'],
            "history" => $pengajuan['history'],

            "title" => "Daftar Pengajuan Barang Saya",
            "status_list" => $status,
            "app_name" => $this->app_name,
            "page_name" => "Kelola Pengajuan",
            "uri" => $this->uri = service('uri')

        ];


        return view("user/pengajuan_barang", $data);
    }
    public function delete_pengajuan()
    {
        $id = $this->request->getVar('id');

        return $this->response->setJSON(['pesan' => 'test hehe' . $id]);
    }
}
