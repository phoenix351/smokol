<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PengajuanModel;
use App\ThirdParty\fpdf\FPDF;




class Memo extends Controller
{

    function Header($nomor, $tanggal)
    {
        // Logo

        $this->pdf->Image('assets/img/logo-ct.png', 90, 6, 30);
        // Arial bold 15
        $this->pdf->SetFont('Arial', 'B', 13);
        // Move to the right

        // Title
        $this->pdf->Ln(25);
        $this->pdf->Cell(0, 10, 'BADAN PUSAT STATISTIK PROVINSI SULAWESI UTARA', 0, 0, 'C');
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, 'SURAT PENGAJUAN USULAN PERBAIKAN BARANG IT', 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, 'Nomor : ' . $nomor . " Tanggal : " . $tanggal, 0, 0, 'C');



        // Line break
        $this->pdf->Ln(20);
    }
    function Body($nama_barang, $jenis_barang, $nomor_seri, $nib, $keluhan)
    {
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Nama Barang', 0, 0, 'L');
        $this->pdf->Cell(60, 10, ': ' . $nama_barang, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Jenis Barang', 0, 0, 'L');
        $this->pdf->Cell(60, 10, ': ' . $jenis_barang, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Nomor Seri', 0, 0, 'L');
        $this->pdf->Cell(60, 10, ': ' . $nomor_seri, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Nomor Induk Barang', 0, 0, 'L');
        $this->pdf->Cell(60, 10, ': ' . $nib, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Keluhan', 0, 0, 'L');
        $this->pdf->MultiCell(100, 10, ': ' . $keluhan);
        $this->pdf->Ln(30);
    }

    // Page footer
    function Footer($penerima, $penyerah, $tanggal)
    {
        // Position at 1.5 cm from bottom

        // Arial italic 8
        $this->pdf->SetFont('Arial', '', 11);
        // Page number
        $this->pdf->SetX(30);
        $this->pdf->Cell(60, 10, 'Yang Menerima,', 0, 0, 'C');
        $this->pdf->SetX(-70);
        $this->pdf->Cell(60, 10, 'Yang Menyerahkan, ', 0, 0, 'C');
        $this->pdf->Ln(30);
        $this->pdf->SetX(30);
        $this->pdf->Cell(60, 10, $penerima, 0, 0, 'C');
        $this->pdf->SetX(-70);
        $this->pdf->Cell(60, 10, $penyerah, 0, 0, 'C');
        $this->pdf->Ln(6);
        $this->pdf->SetX(20);
    }


    // Instanciation of inherited class


    public function cetak($id = null)
    {
        $pengajuan  = new PengajuanModel();
        $barang = $pengajuan->getPengajuanById($id)[0];
        $result = date('d/m/Y');


        $data = [
            'nomor_surat' => $barang['id'] . '/' . $barang['tanggal_diproses'],
            'nama_barang' => $barang['merk'] . ' ' . $barang['tipe'],
            "jenis_barang" => $barang['jenis'],
            "nomor_seri" => $barang['nomor_seri'],
            "nib" => $barang['nib'],
            "keluhan" => $barang['keluhan'],
            "nama_pemakai" => $barang['nama_lengkap'],
            "nama_admin" => user()->nama_lengkap,
            "tanggal_diajukan" => $barang['tanggal_diajukan'],
            "tanggal_diproses" => $barang['tanggal_diproses'],
            "tanggal" => $result
        ];




        // membuat halaman baru
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->Header($data["nomor_surat"], $data["tanggal"]);
        $this->Body($data["nama_barang"], $data['jenis_barang'], $data['nomor_seri'], $data['nib'], $data['keluhan']);
        $this->Footer($data['nama_admin'], $data['nama_pemakai'], $data['tanggal']);
        $this->pdf->SetFont('Times', '', 12);



        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->pdf->Output();
    }
}
