<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BarangModel;

class Barang extends ResourceController
{
    use ResponseTrait;
    function __construct()
    {
        $this->model = new BarangModel();
    }

    // ambil semua barang
    public function index()
    {

        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {

        $data = $this->model->getWhere(["id" => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound("No Data Found with id " . $id);
        }
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'user_id' => 'required',
            'jenis' => 'required|min_length[3]|max_length[255]',
            'tipe' => 'required|min_length[3]|max_length[255]',
            'kondisi' => 'required|min_length[3]|max_length[64]',
            'merk' => 'required|min_length[3]|max_length[64]',
            'tahun_peroleh' => 'required|greater_than_equal_to[2000]|less_than_equal_to[' . date("Y") . ']',
            'nib' => 'required|min_length[3]|max_length[64]',
            'nomor_seri' => 'required|min_length[3]|max_length[64]',
            'lokasi' => 'required|min_length[3]|max_length[255]',
            'status' => 'required|min_length[3]|max_length[30]',
            'perawatan' => 'required|less_than_equal_to[1]|greater_than_equal_to[0]',

        ];
        if (!$this->validate($rules)) {

            return $this->fail($this->validator->getErrors());
        } else {

            $data = [
                'user_id' => $this->request->getVar('user_id'),
                'jenis' => $this->request->getVar('jenis'),
                'tipe' => $this->request->getVar('tipe'),
                'kondisi' => $this->request->getVar('kondisi'),
                'merk' => $this->request->getVar('merk'),
                'tahun_peroleh' => $this->request->getVar('tahun_peroleh'),
                'nib' => $this->request->getVar('nib'),
                'nomor_seri' => $this->request->getVar('nomor_seri'),
                'lokasi' => $this->request->getVar('lokasi'),
                'status' => $this->request->getVar('status'),
                'perawatan' => $this->request->getVar('perawatan'),
            ];

            $barang_id = $this->model->insert($data);
            $data['barang_id'] = $barang_id;
            return $this->respondCreated($data);
        }
    }

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'user_id' => 'required',
            'jenis' => 'required|min_length[3]|max_length[255]',
            'tipe' => 'required|min_length[3]|max_length[255]',
            'kondisi' => 'required|min_length[3]|max_length[64]',
            'merk' => 'required|min_length[3]|max_length[64]',
            'tahun_peroleh' => 'required|greater_than_equal_to[2000]|less_than_equal_to[' . date("Y") . ']',
            'nib' => 'required|min_length[3]|max_length[64]',
            'nomor_seri' => 'required|min_length[3]|max_length[64]',
            'lokasi' => 'required|min_length[3]|max_length[255]',
            'status' => 'required|min_length[3]|max_length[30]',
            'perawatan' => 'required|less_than_equal_to[1]|greater_than_equal_to[0]',

        ];
        if (!$this->validate($rules)) {

            return $this->fail($this->validator->getErrors());
        } else {

            $input = $this->request->getRawInput();
            $data = [
                'id' => $input['id'],
                'user_id' => $input['user_id'],
                'jenis' => $input['jenis'],
                'tipe' => $input['tipe'],
                'kondisi' => $input['kondisi'],
                'merk' => $input['merk'],
                'tahun_peroleh' => $input['tahun_peroleh'],
                'nib' => $input['nib'],
                'nomor_seri' => $input['nomor_seri'],
                'lokasi' => $input['lokasi'],
                'status' => $input['status'],
                'perawatan' => $input['perawatan'],
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->model->save($data);
            return $this->respond($data);
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $this->model->delete($id);
            return $this->respondDeleted($data);
        } else {
            return $this->failNotFound('Barang tidak ditemukan !');
        }
    }
}
