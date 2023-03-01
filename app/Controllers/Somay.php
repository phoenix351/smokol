<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Somay extends Controller
{

    public function index()
    {
        return view('user/pdf_view');
    }

    function htmlToPDF()
    {
        $dompdf = new \Dompdf\Dompdf();
        $result = date('d/m/Y');
        $data['data'] = [
            'nomor_surat' => "1332" . $result,
            'nama_barang' => "ASUS" . " " . "Vivobook S14",
            "jenis_barang" => "Laptop",
            "nomor_seri" => "2312331321",
            "nib" => "2312331321",
            "keluhan" => "Blue Screeen dan  lama loading sering hang",
            "nama_pemakai" => "Pemakai",
            "nama_admin" => "admin1",
            "tanggal_diajukan" => "13 May 2021",
            "tanggal_diproses" => "14 May 2021",
            "tanggal" => $result
        ];

        $dompdf->loadHtml(view('user/pdf_view', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream();
    }
}
