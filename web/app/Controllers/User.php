<?php

namespace App\Controllers;



use App\Models\KendaraanDinasModel;
use App\Models\BarangITModel;
use App\Models\PegawaiModel;
use App\Models\BarangModel;
use App\Models\PengajuanModel;
use App\Models\PenggunaModel;
use App\Models\GrupModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MasterITModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\ThirdParty\fpdf\FPDF;
helper(array('url','download'));

class User extends ResourceController
{

    use ResponseTrait;
    function __construct()
    {
        $this->pdf = new FPDF();
        $this->request = service('request');
        $this->it = new BarangITModel();
        $this->barang_model = new BarangModel();
        $this->master_it = new MasterITModel();
        $this->jenis_list = $this->master_it->select('distinct(jenis)')->where(['1='=>'1'])->findAll();
        $this->merk_list = $this->master_it->select('distinct(merk)')->where(['1='=>'1'])->findAll();
        $this->pengguna_model = new PenggunaModel();
        $this->pengajuan_model = new PengajuanModel();
        $this->client = \Config\Services::curlrequest();
    }


    protected $app_name = "SMOKOL";
    protected $helpers = ['auth'];
    protected $kondisi_list = [
        "Baik",
        "Rusak Ringan",
        "Rusak Berat"
    ];

    protected $merk_kbm = [
        "HONDA", "YAMAHA", "MITSUBISHI", "CHEVROLET", "SUZUKI", "TOYOTA"
    ];

  
    protected $tipe_list = [
        "Asus All In One PC Series", "Optiplex 3010 DT", "Optiplex 3020 Micro", "Optiplex 3040 Micro", "Optiplex 330", "Optiplex 780", "Azura Z3 (Rakitan)", "DX2310 MT (Pavilion)", "Prodesk 41 G5 SFF", "Z4", "Lenovo All In One PC", "Think Centre M710t", "Think Centre M720t", "Think Centre M80","TravelMate Spin P4", "Lainnya",
    ];
    protected $type_list_kendaraan = [
        "Mobil",
        "Sepeda Motor"
    ];

    protected $room_list = [
        "IPDS-Ruang Koordinator",
        "IPDS-Ruang Pegawai",
        "IPDS-Ruang Pengolahan",
        "Umum-Ruang Pegawai Umum",
        "Umum-Lobby",
        "IPDS-Pelayanan Statistik Terpadu",
        "Umum-Ruang Pegawai Perencanaan",
        "Umum-Ruang Pegawai PBJ",
        "Umum-Ruang Pegawai Keuangan",
        "Umum-Ruang Kepala Bagian",
        "Umum-Ruang Arsip",
        "Umum-Ruang Pegawai SDM",
        "Statistik Produksi-Ruang Koordinator",
        "Statistik Produksi-Ruang Pegawai",
        "Statistik Sosial-Ruang Koordinator",
        "Statistik Sosial-Ruang Pegawai",
        "Ruang Mako SP2020",
        "Aula",
        "Ruang Kepala BPS",
        "Umum-Ruang Sekretaris",
        "Ruang Vicon",
        "Nerwilis-Ruang Koordinator",
        "Nerwilis-Ruang Pegawai",
        "Statistik Distribusi-Ruang Koordinator",
        "Statistik Distribusi-Ruang Pegawai",
        "Lainnya"
    ];
    protected $os_list = [
        "Windows 10",
        "Windows 8",
        "Windows 7",
        "Windows XP",
        "Ubuntu",
        "CentOS",
        "Tidak Memakai OS",
        "Lainnya"
    ];
    protected $fungsi_list = [
        'Kepala Kantor',
        'Bagian Umum',
        'Fungsi Statistik Sosial',
        'Fungsi Statistik Produksi',
        'Fungsi Statistik Distribusi',
        'Fungsi Neraca Wilayah dan Analisis Statistik',
        'Fungsi IPDS',
    ];
    protected $jabatan_list  = [
        'Kepala BPS Provinsi',
        'Kepala Bagian',
        'Koordinator Fungsi',
        'Sub Koordinator Fungsi',
        'Staf Pelaksana',
        'PPNPN'
    ];


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
    public function unduh_rekap_kondisi()
    {


        // file name 
        $filename = 'rekap_kondisi_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 

        $rekap_ruangan = $this->barang_model->getRekap();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array('Jenis Barang', 'Baik', 'Rusak Ringan', 'Rusak Sedang', 'Jumlah');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_ruangan as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
    }

    public function unduh_rekap_ruangan()
    {

        // file name 
        $filename = 'rekap_ruangan_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 

        $rekap_ruangan = $this->barang_model->getRekapRuangan();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array('Nama Ruangan', 'PC', 'Laptop', 'Printer', 'Scanner', 'UPS', 'Lainnya');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_ruangan as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
    }

    public function unduh_rekap_bidang()
    {

        // file name 
        $filename = 'rekap_bidang_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 

        $rekap_ruangan = $this->barang_model->getRekapBidang();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array('Bidang', 'PC', 'Laptop', 'Printer', 'Scanner', 'UPS', 'Lainnya', 'Jumlah');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_ruangan as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
    }
    
    public function unduh_rekap_pemeliharaan()
    {

        // file name 
        $filename = 'rekap_pemeliharaan_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 

        $rekap_ruangan = $this->barang_model->getRekapPemeliharaan();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array('Jenis','Jumlah Item','Jumlah Biaya');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_ruangan as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
    }

    public function unduh_rekap_pemegang()
    {

        // file name 
        $filename = 'rekap_pemegang_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 

        $rekap_ruangan = $this->pengguna_model->getRekapBarang();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array('Nama Pemegang', 'PC', 'Laptop', 'Printer', 'Scanner', 'UPS', 'Lainnya');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_ruangan as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
    }
    
    public function unduh_rekap_barang_rusak()
    {
    
        // file name 
        $filename = 'rekap_barang_rusak_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data 

        $rekap_rusak = $this->barang_model->getBarangRusak();

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array('Nomor', 'Jenis', 'Tipe', 'Kondisi', 'Merk', 'Nomor Seri', 'Lokasi','Nama Pegawai');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_rusak as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
    }

    public function export()
    {

        $rekapan = $this->pengguna_model->getRekapBarang();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Pegawai')
            ->setCellValue('B1', 'Jenis Barang')
            ->setCellValue('C1', 'Nama Barang')
            ->setCellValue('D1', 'Lokasi Barang');

        $column = 2;

        foreach ($rekapan as $rekap) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $rekap['nama_lengkap'])
                ->setCellValue('B' . $column, $rekap['jenis'])
                ->setCellValue('C' . $column, $rekap['merk'] . " " . $rekap['tipe'])
                ->setCellValue('D' . $column, $rekap['lokasi']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Rekap-Pegawai';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function getMerkByJenis($jenis)
    {

        return $this->respond([
            "data" => $this->master_it->getMerkByJenis($jenis),
            "statusCode" => 200,
            "message" => "Berhasil mengambil data !"
        ]);
    }

    

    public function index()
    {


        $barang = new BarangModel();


        // if (logged_in()) {
        //     $sum_ = $barang->getKondisiSum(user()->id);
        //     $data = [
        //         'barang_it'  => $this->it->getBarangByUser(user()->id),

        //         'sum' => $sum_,
        //         'title' => 'Daftar Barang',
        //         "app_name" => $this->app_name,
        //         "page_name" => "Dashboard",
        //         "uri" => $this->uri = service('uri')
        //     ];
        // } else {
        //     $sum_ = $barang->getKondisiSum(null);
        //     $data = [
        //         'barang_it'  => $this->it->getBarangByUser(null),

        //         'sum' => $sum_,
        //         'title' => 'Daftar Barang',
        //         "app_name" => $this->app_name,
        //         "page_name" => "Dashboard",
        //         "uri" => $this->uri = service('uri')
        //     ];
        // }

        $sum_ = $barang->getKondisiSum(null);
        $data = [
            'barang_it'  => $this->it->getBarangByUser(null),

            'sum' => $sum_,
            'title' => 'Daftar Barang',
            "app_name" => $this->app_name,
            "page_name" => "Dashboard",
            "uri" => $this->uri = service('uri')
        ];

        return view('user/index', $data);
    }
    public function madang()
    {

        //$arr = ['340017859', '340018559', '340017199', '340019751', '340017202', '340011441', '340053852', '340013058', '340059273', '340059276', '340060268', '340060228', '340056837'];


        //echo "" . user()->hashPassword('rb7100') . "<br>";
        
        $send = $this->client->request('GET','https://webapps.bps.go.id/sulut/fordone/apiminut');
        
        var_dump($send->getBody());
        die;
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

    function ubah_foto()
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


    public function cetak_rekap($id = null)
    {
        $pengajuan  = new PengajuanModel();

        $data['list_pengajuan'] = $pengajuan->getListPengajuan(null)['PENDING'];
        return view("export/rekap_pemeliharaan", $data);
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
    public function profile()
    {
        $data = [
            "app_name" => $this->app_name,
            "page_name" => "Profile",
            "uri" => $this->uri = service('uri')
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
    public function rekap()
    {
        $it = new BarangITModel();

        $data = [
            'title' => 'Rekapitulasi Barang',
            'rekap_it' => $this->barang_model->getRekap(),
            'rekap_bidang' => $this->barang_model->getRekapBidang(),
            'rekap_pemeliharaan'=>$this->barang_model->getRekapPemeliharaan(),
            'rekap_biaya' => $it->getRekapBiaya(),
            'rekap_pengguna' => $this->pengguna_model->getRekapBarang(),
            "app_name" => $this->app_name,
            "page_name" => "Rekapitulasi",
            "uri" => $this->uri = service('uri'),
            'rekap_ruangan' => $this->barang_model->getRekapRuangan(),
        ];

        return view("user/rekap", $data);
    }
    public function kelola_barangit()
    {
        $it = new BarangITModel();
        $peg = new PenggunaModel();

        $data = [
            'barang'  => $it->getBarangById(),
            'user_list' => $peg->getUserName(),
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

    
    public function kelola_pengguna()
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
    public function pengajuan_barang()
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
        
        if($data["kondisi_final"]=="Rusak Berat"){
            $fileName =$dataBerkas->getRandomName();
            $dataBerkas->move('uploads/berkas/', $fileName);
            $data["bukti_rusak_berat"]=$fileName;
        } else {
            $data['bukti_rusak_berat']=NULL;
        }
        
        $id = $request->getPost("id");
        $id_barang = $request->getPost('id_barang');

        $up =  $pengajuan_model->update($id, $data);
        $up2 = $barang->update($id_barang, ['kondisi' => $request->getPost('kondisi_final'),'bukti_rusak_berat'=>$data['bukti_rusak_berat']]);
        
            return redirect()->to($request->getPost('url'))->with('message', 'Selesai memproses perawatan barang IT!');
        
        }
        
       
        //$dataBerkas = $this->request->getFile('bukti-rusak-berat');    
        
		//$fileName =$dataBerkas->getRandomName();
    	//$dataBerkas->move('uploads/berkas/', $fileName);
        
        
	    
       
    
    public function pengguna_barangit()
    {
        $it = new BarangITModel();
        $peg = new PegawaiModel();
        $jenis_list = $this->master_it->select('distinct(jenis)')->where(['1='=>'1'])->findAll();

        $data = [
            'barang'  => $it->getBarangByUser(user()->id),
            'nip' => user()->nip,
            'title' => 'Daftar Barang IT',
            'jenis_list' => $jenis_list,
            'merk_list' => $this->merk_list,
            'tipe_list' => $this->tipe_list,
            'os_list' => $this->os_list,
            'room_list' => $this->room_list,

            "app_name" => $this->app_name,
            "page_name" => "Barang IT Pengguna",
            "uri" => $this->uri = service('uri')
        ];
        return view('user/pengguna_barangit', $data);
    }
    public function pengguna_kendaraandinas()
    {
        $kd = new KendaraanDinasModel();

        $data = [
            'barang'  => $kd->getBarangById(user()->id),
            'nip' => user()->nip,
            'title' => 'Daftar Kendaraan Dinas',
            "app_name" => $this->app_name,
            "page_name" => "Barang IT Pengguna",
            "type_list" => $this->type_list_kendaraan,
            "merk_list" => $this->merk_kbm,
            "kondisi_list" => $this->kondisi_list,
            "room_list" => $this->room_list,
            "uri" => $this->uri = service('uri')
        ];
        return view('user/pengguna_kendaraandinas', $data);
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
    
    public function download_by_path() {
        $path = $this->request->getGet('path');
        $filepath = 'uploads/berkas/'.$path;
         header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
    }
    public function delete_pengajuan() {
        $id = $this->request->getVar('id');
        
        return $this->response->setJSON(['pesan'=>'test hehe'.$id]);
        
        
        
    }
}
