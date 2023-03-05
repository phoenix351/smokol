<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangITModel;
use App\Models\BarangModel;
use App\Models\PenggunaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Rekap extends BaseController
{
    private $barang_model;
    private $pengguna_model;
    private $pengajuan_model;
    private $barang_it_model;

    function __construct()
    {
        $this->barang_model = new BarangModel();
        $this->barang_it_model = new BarangITModel();
        $this->pengguna_model = new PenggunaModel();
        $this->pengajuan_model = new PenggunaModel();
    }
    public function index()
    {
        $it = new BarangITModel();

        $data = [
            'title' => 'Rekapitulasi Barang',
            'rekap_it' => $this->barang_model->getRekap(),
            'rekap_bidang' => $this->barang_model->getRekapBidang(),
            'rekap_pemeliharaan' => $this->barang_model->getRekapPemeliharaan(),
            'rekap_biaya' => $it->getRekapBiaya(),
            'rekap_pengguna' => $this->pengguna_model->getRekapBarang(),
            "app_name" => $this->app_name,
            "page_name" => "Rekapitulasi",
            "uri" => $this->uri = service('uri'),
            'rekap_ruangan' => $this->barang_model->getRekapRuangan(),
        ];

        return view("user/rekap", $data);
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

        $header = array('Jenis', 'Jumlah Item', 'Jumlah Biaya');
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

        $header = array('Nomor', 'Jenis', 'Tipe', 'Kondisi', 'Merk', 'Nomor Seri', 'Lokasi', 'Nama Pegawai');
        fputcsv($file, $header, $separator = ";");
        foreach ($rekap_rusak as $key => $line) {
            fputcsv($file, $line, $separator = ";");
        }
        fclose($file);
        exit;
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

    public function cetak_rekap($id = null)
    {

        $data['list_pengajuan'] = $this->pengajuan_model->getListPengajuan(null)['PENDING'];
        return view("export/rekap_pemeliharaan", $data);
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
}
