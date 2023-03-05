<?php

use App\Controllers\BaseController;

class UserController extends BaseController {
    ublic function kelola_pengguna()
    {
        $user = new PenggunaModel();

        $data = [

            'daftar_nip' => $user->getAllNip(),
            "users" => $user->getUser(null),
            'room_list' => $this->room_list,
            'fungsi_list' => $this->fungsi_list,
            "app_name" => $this->app_name,
            "page_name" => "Kelola Pengguna",
            "uri" => $this->uri = service('uri')
        ];
        return view('user/kelola_pengguna', $data);
    }
    public function tambah_pengguna()
    {
        $grup = new GrupModel();
        $pengguna = new PenggunaModel();

        $request = service('request');
        //"tahunPeroleh" => $request->getPost('tahunPeroleh'),
        $data = [
            "id" => null,
            "email" => $request->getPost('email'),
            "nip" => $request->getPost('nip'),
            "nama_lengkap" => $request->getPost('nama_lengkap'),
            "active" => 1,
            "bidang" => $request->getPost('bidang'),
            "password_hash" => password_hash($request->getPost('password'), PASSWORD_BCRYPT, ['cost' => 10]),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ];

        #insert pengguna
        $pengguna->set($data);
        $pengguna->insert();
        if ($request->getPost('role') == 'admin') {
            #insert group
            $grup->set([
                'group_id' => 2,
                'user_id' => $pengguna->getInsertID()
            ]);
        } else {

            #insert group
            $grup->set([
                'group_id' => 5,
                'user_id' => $pengguna->getInsertID()
            ]);
        }
        $grup->insert();

        return redirect()->to($request->getPost('url'));
    }
    public function ubah_pengguna()
    {
        $grup = new GrupModel();
        $pengguna = new PenggunaModel();

        $request = service('request');
        //"tahunPeroleh" => $request->getPost('tahunPeroleh'),
        $user_id = $request->getPost('id');
        $data = [

            "email" => $request->getPost('email'),

            "nip" => $request->getPost('nip'),
            "nama_lengkap" => $request->getPost('nama_lengkap'),
            "bidang" => $request->getPost('bidang'),
            'updated_at' => date('Y-m-d H:i:s')

        ];
        if (strlen($request->getPost('password')) > 7) {
            $data["password_hash"] = password_hash($request->getPost('password'), PASSWORD_BCRYPT, ['cost' => 10]);
        }

        #update pengguna
        $pengguna->update($user_id, $data);

        if ($request->getPost('role') == 'admin') {

            $grup_id = 1;
        } else {

            $grup_id = 2;
        }
        $data_grup = [
            'group_id' => $grup_id
        ];
        $grup->update($user_id, $data_grup);


        return redirect()->to($request->getPost('url'))->with('message', 'Data pengguna berhasil diubah!');
    }
    public function hapus_pengguna()
    {
        $grup = new GrupModel();
        $pengguna = new PenggunaModel();

        $request = service('request');
        //"tahunPeroleh" => $request->getPost('tahunPeroleh'),
        $user_id = $request->getPost('id');
        $pengguna->where('id', $user_id)->delete();
        $grup->where('user_id', $user_id)->delete();
        return 1;
    }

    public function kelola_pengajuan()
    {
        $status = [
            "PENDING",
            "PROCESSED",
            "DONE"
        ];
        $model = new PengajuanModel();

        $pengajuan = $model->getListPengajuan(null);



        $data = [
            "pending" => $pengajuan['PENDING'],
            "processed" => $pengajuan['PROCESSED'],
            "done" => $pengajuan['DONE'],
            "title" => "Daftar Pengajuan Barang Saya",
            "status_list" => $status,
            "app_name" => $this->app_name,
            "page_name" => "Kelola Pengajuan",
            "uri" => $this->uri = service('uri')

        ];




        return view("user/kelola_pengajuan", $data);
    }
}