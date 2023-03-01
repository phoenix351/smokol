<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Dompdf\Dompdf;


class Memodinas extends Controller
{

    public function index()
    {

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

        // reference the Dompdf namespace

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();


        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);
        // Render the HTML as PDF


        // Output the generated PDF to Browser

        $html = view('user/memo_pemeliharaan', $data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('memo.pdf', array("Attachment" => false));
    }
}
