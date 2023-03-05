<?php

use App\Controllers\BaseController;

class Pengajuan extends BaseController {
    protected pdf;
    function __construct()
    {
        $this->pdf = new Pdf();
    }

    public function pengguna_pengajuan()
    {
        $status = [
            "PENDING",
            "PROCESSED",
            "DONE"
        ];
        $model = new PengajuanModel();
        $id = user()->id;
        $pengajuan = $model->getListPengajuan($id);



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


        return view("user/pengguna_pengajuan", $data);
    }
    public function pengguna_tidak_kuasa()
    {


        $this->pengguna_model->tidak_kuasa(user()->id);
        return redirect()->to(base_url('user/pengguna_barangit'))->with('message', 'Berhasil Mengubah Menjadi Akun tanpa Penguasaan Barang IT');
    }

    public function tambah_pengajuan($id = null)
    {
        $queri = new BarangModel();
        $request = service("request");
        $data = $queri->select('tipe,merk')
            ->where(['id' => $id])
            ->findAll()[0];


        $barang = [
            'id' => $id,
            'nama' => $data['merk'] . ' ' . $data['tipe'],
            'tipe' => 1,
        ];

        $data = [
            "id" => $id,
            "app_name" => $this->app_name,
            "page_name" => "Kelola Pengajuan",
            "uri" => $this->uri = service('uri'),
            "barang" => $barang

        ];
        return view("user/tambah_pengajuan", $data);
    }
    public function pengajuan_detail($id = null)

    {

        if (is_null($id)) {
            $data = [
                "status" => 404,
                "pesan" => "Parameter ID tidak boleh null"
            ];
            return $this->respond($data);
        } else {
            $model = new PengajuanModel();
            $data = $model->select("id, status, created_at, start_date, end_date, keluhan, biaya,bukti_rusak_berat")
                ->where(['id' => $id])
                ->findAll();

            return $this->respond([
                "status" => 200,
                "data" => $data
            ]);
        }
    }
    public function update_pending()
    {

        $pengajuan_model = new PengajuanModel();

        $request = service("request");
        $rawdate = htmlentities($request->getPost('start_date'));
        $date = date('Y-m-d', strtotime($rawdate));

        $data = [
            "status" => "PROCESSED",
            "start_date" => $date,
        ];
        $id = $request->getPost("id");
        $save = $pengajuan_model->update($id, $data);


        if ($save) {
            return redirect()->to($request->getPost('url'))->with('message', 'Memproses perawatan barang IT!');
        } else {
            return redirect()->to($request->getPost('url'))->with('error', 'Gagal memproses perawatan barang IT!');
        }
    }

    public function update_processed()
    {

        $pengajuan_model = new PengajuanModel();
        $barang = new BarangModel();

        $request = service("request");
        $data = [
            "status" => "DONE",
            "end_date" => $request->getPost('end_date'),
            "kondisi_final" => $request->getPost('kondisi_final'),
            "biaya" => $request->getPost('biaya'),
            "catatan_admin" => $request->getPost('catatan_admin'),
        ];
        $dataBerkas = $this->request->getFile('bukti-rusak-berat');

        if ($data["kondisi_final"] == "Rusak Berat") {
            $fileName = $dataBerkas->getRandomName();
            $dataBerkas->move('uploads/berkas/', $fileName);
            $data["bukti_rusak_berat"] = $fileName;
        } else {
            $data['bukti_rusak_berat'] = NULL;
        }

        $id = $request->getPost("id");
        $id_barang = $request->getPost('id_barang');

        $up =  $pengajuan_model->update($id, $data);
        $up2 = $barang->update($id_barang, ['kondisi' => $request->getPost('kondisi_final'), 'bukti_rusak_berat' => $data['bukti_rusak_berat']]);

        return redirect()->to($request->getPost('url'))->with('message', 'Selesai memproses perawatan barang IT!');
    }


    public function ajukan()
    {
        $request = service("request");


        $model = new PengajuanModel();

        $data = [
            "id_barang" => $request->getPost('id_barang'),
            "tipe" => $request->getPost('tipe'),
            "keluhan" => $request->getPost('keluhan'),
        ];
        $model->save($data);
        return redirect()->to(base_url() . "/user/pengguna_barangit");
    }

    public function download_by_path()
    {
        $path = $this->request->getGet('path');
        $filepath = 'uploads/berkas/' . $path;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        die();
    }
    
    function Header($nomor, $tanggal)
    {
        // Logo

        $this->pdf->Image('assets/img/logo-bps.png', 90, 6, 30);
        // Arial bold 15
        $this->pdf->SetFont('Arial', 'B', 13);
        // Move to the right

        // Title
        $this->pdf->Ln(25);
        $this->pdf->Cell(0, 10, 'BADAN PUSAT STATISTIK PROVINSI SULAWESI UTARA', 0, 0, 'C');
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, 'MEMO PENGAJUAN USULAN PERBAIKAN BARANG IT', 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, 'Nomor : ' . $nomor . "     Tanggal : " . $tanggal, 0, 0, 'C');



        // Line break
        $this->pdf->Ln(20);
    }
    function Body($nama_barang, $jenis_barang, $nomor_seri, $nib, $keluhan)
    {
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Jenis Barang', 0, 0, 'L');
        $this->pdf->Cell(60, 10, ': ' . $jenis_barang, 0, 0, 'L');
        $this->pdf->Ln(10);
        $this->pdf->SetX(20);
        $this->pdf->Cell(60, 10, 'Nama Barang', 0, 0, 'L');
        $this->pdf->Cell(60, 10, ': ' . $nama_barang, 0, 0, 'L');
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
    function Footer($penerima, $penyerah)
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
        $bulan = date('m');
        $tahun = date('Y');


        $data = [
            'nomor_surat' => 'PTI.' . $barang['id'] . '/BPS7100/' . $bulan . '/' . $tahun,
            'nama_barang' => $barang['merk'] . ' ' . $barang['tipe'],
            "jenis_barang" => $barang['jenis'],
            "nomor_seri" => $barang['nomor_seri'],
            "nib" => $barang['nib'],
            "keluhan" => $barang['keluhan'],
            "nama_pemakai" => $barang['nama_lengkap'],
            "nama_admin" => user()->nama_lengkap,
            "tanggal" => $result
        ];




        // membuat halaman baru
        $this->pdf->AliasNbPages();
        $this->pdf->AddPage();
        $this->Header($data["nomor_surat"], $data["tanggal"]);
        $this->Body($data["nama_barang"], $data['jenis_barang'], $data['nomor_seri'], $data['nib'], $data['keluhan']);
        $this->Footer("....................", $data['nama_pemakai']);
        $this->pdf->SetFont('Times', '', 12);



        $this->response->setHeader('Content-Type', 'application/pdf');
        $this->pdf->Output();
    }
    function ImprovedTable($header, $data)
    {
        // Column widths
        $w = array(10, 40, 30, 40, 40, 40, 80);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->pdf->Ln();
        // Data
        $indeks = 1;
        foreach ($data as $row) {
            $this->pdf->Cell($w[0], 6, number_format($indeks), 'LR', 0, 'R');
            $this->pdf->Cell($w[1], 6, $row['lokasi'], 'LR');
            $this->pdf->Cell($w[2], 6, $row['jenis'], 'LR');
            $this->pdf->Cell($w[3], 6, $row['merk'], 'LR');
            $this->pdf->Cell($w[4], 6, $row['tipe'], 'LR');
            $this->pdf->Cell($w[5], 6, $row['nomor_seri'], 'LR');
            $this->pdf->Cell($w[6], 6, $row['keluhan'], 'LR');

            $this->pdf->Ln();
            $indeks++;
        }
        // Closing line
        $this->pdf->Cell(array_sum($w), 0, '', 'T');
    }

    function Header_rekap($nomor, $tanggal)
    {
        // Logo

        $this->pdf->Image('assets/img/logo-bps.png', 130, 10, 30);
        // Arial bold 15
        $this->pdf->SetFont('Arial', 'B', 13);
        // Move to the right

        // Title
        $this->pdf->Ln(25);
        $this->pdf->Cell(0, 10, 'BADAN PUSAT STATISTIK PROVINSI SULAWESI UTARA', 0, 0, 'C');
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, 'MEMO PENGAJUAN USULAN PERBAIKAN BARANG IT', 0, 0, 'C');
        $this->pdf->SetFont('Arial', '', 11);
        $this->pdf->Ln(7);
        $this->pdf->Cell(0, 10, 'Nomor : ' . $nomor . "     Tanggal : " . $tanggal, 0, 0, 'C');



        // Line break
        $this->pdf->Ln(20);
    }



    // Page footer
    function Footer_rekap($penerima)
    {
        // Position at 1.5 cm from bottom

        // Arial italic 8
        $this->pdf->SetFont('Arial', '', 11);
        // Page number
        $this->pdf->Cell(60, 10, '', 0, 0, 'C');
        $this->pdf->SetY(-40);
        $this->pdf->SetX(-90);

        $this->pdf->Cell(60, 10, 'Yang Menerima,', 0, 0, 'C');

        $this->pdf->Ln(6);
        $this->pdf->SetX(20);
    }


    // Instanciation of inherited class
}