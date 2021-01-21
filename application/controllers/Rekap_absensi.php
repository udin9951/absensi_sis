<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @author BelumGede
 * @version 1.0
 */

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';
// include_once APPPATH . '/third_party/fpdf/fpdf.php';

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class Rekap_absensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('rekap_model', 'rekap', TRUE);
    }

    public function index()
    {
        if ($this->session->userdata('username') == "") {
            redirect('login');
        } else {

            $this->data['breadcrumb']  = 'Rekap';
            $this->data['main_view']   = 'rekap/v_rekap';
            $this->data['kelas'] = $this->rekap->get_kelas()->result();
            $this->load->view('template', $this->data);
        }
    }

    function export()
    {
        $this->load->library('pdf');
        $bulan = $this->input->post('bulan');
        if ($bulan == "") {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <strong>Failed!</strong> Bulan Ga boleh Kosong.
          </div>');
            redirect('Rekap_absensi');
        } else {

            $print = $this->rekap->export($bulan)->result();

            $pdf = new FPDF('l', 'mm', 'A5');
            // membuat halaman baru
            $pdf->AddPage();
            // setting jenis font yang akan digunakan
            $pdf->SetFont('Arial', 'B', 16);
            // mencetak string 
            $pdf->Cell(190, 7, 'SMK Mangunjaya 01', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(190, 7, 'JL. Pendidikan, Blok 1 RT. 07 RW. 01', 0, 1, 'C');
            $pdf->Cell(190, 7, 'Mangunjaya, Tambun Selatan., Bekasi, Jawa Barat 17510', 0, 1, 'C');
            $pdf->Cell(190, 7, 'Bekasi, Jawa Barat 17510', 0, 1, 'C');
            $pdf->Cell(190, 7, '---------------------------------------------------------------------------------------------', 0, 1, 'C');
            // Memberikan space kebawah agar tidak terlalu rapat
            $pdf->Cell(10, 7, '', 0, 1);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 6, 'No', 1, 0);
            $pdf->Cell(30, 6, 'Nis', 1, 0);
            $pdf->Cell(24, 6, 'Wali Kelas', 1, 0);
            $pdf->Cell(25, 6, 'Tanggal Absen', 1, 0);
            $pdf->Cell(35, 6, 'Jam Absen Sesi 1', 1, 0);
            $pdf->Cell(35, 6, 'Jam Absen Sesi 2', 1, 0);
            $pdf->Cell(35, 6, 'Jam Absen Sesi 3', 1, 1);
            $pdf->SetFont('Arial', '', 10);

            $no = 1;

            if ($print == "") {
                echo "data kosong";
            } else {
                foreach ($print as $row) {

                    $pdf->Cell(10, 6, $no++, 1, 0);
                    $pdf->Cell(30, 6, $row->nis, 1, 0);
                    $pdf->Cell(24, 6, $row->wali_kelas, 1, 0);
                    $pdf->Cell(25, 6, $row->tanggal, 1, 0);
                    $pdf->Cell(35, 6, $row->jam_absen1, 1, 0);
                    $pdf->Cell(35, 6, $row->jam_absen2, 1, 0);
                    $pdf->Cell(35, 6, $row->jam_absen3, 1, 1);
                }
                $pdf->Output();
            }
        }
    }


    function Download()
    {
        $bulan = $this->input->post('get_bulan');

        if ($bulan == "") {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <strong>Failed!</strong> Bulan Ga boleh Kosong.
          </div>');
            redirect('Rekap_absensi');
        } else {

            $export = $this->rekap->export($bulan)->result();

            $file_path = "Data Absensi bulan $bulan.xls";
            $writer = WriterFactory::create(Type::XLSX);
            $writer->openToBrowser($file_path);
            //silahkan sobat sesuaikan dengan data yang ingin sobat tampilkan

            $label = ['LAPORAN Data Absensi Siswa di Smk Mangunjaya 01'];
            $spasi1 = [''];
            $spasi2 = [''];
            $spasi3 = [''];
            $header = [
                'No',
                'Nis',
                'Wali Kelas ',
                'Tanggal Absen',
                'Jam Absen Sesi 1',
                'Jam Absen Sesi 2',
                'Jam Absen Sesi 3',
            ];


            $writer->addRow($label);
            $writer->addRow($spasi1);
            $writer->addRow($spasi2);
            $writer->addRow($spasi3);
            $writer->addRow($header);

            $data   = array(); //siapkan variabel array untuk menampung data
            $no     = 1;

            foreach ($export as $ex) {


                //masukkan data dari database ke variabel array
                //silahkan sobat sesuaikan dengan nama field pada tabel database
                $stok = array(
                    $no++,
                    $ex->nis,
                    $ex->wali_kelas,
                    $ex->tanggal,
                    $ex->jam_absen1,
                    $ex->jam_absen2,
                    $ex->jam_absen3,
                );

                array_push($data, $stok);
            }

            $writer->addRows($data); // tambahkan row untuk data anggota

            $writer->close(); //tutup spout writer

        }
    }
}
