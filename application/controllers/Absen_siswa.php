<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absen_siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Login_model', 'login', TRUE);
    }

    public function index()
    {
        $this->load->view('v_absen_siswa');
    }

    public function get_nis()
    {
        $nis = $this->input->post('nis');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $date = date('Y-m-d');

        $siswa = $this->M_absen_siswa->get_siswa($nis);
        $err = "";

        if ($siswa->num_rows() > 0) {
            if (date('H:i:s') < '17:00:00' && date('H:i:s') > '15:00:00') {
                $absen = $this->M_absen_siswa->get_absen($nis, $date);

                // $status_absen =  $absen->row()->status_absen1;

                if ($absen->num_rows() < 1) {
                    $data = array(
                        'nis' => $nis,
                        'tanggal' => date('Y-m-d'),
                        'id_semester' => 1,
                        'bulan' => date('F'),
                        'jam_absen1' => date('Y-m-d H:i:s'),
                        'latitude1' => $latitude,
                        'longitude1' => $longitude,
                        'status_absen1' => 1
                    );

                    $save = $this->M_absen_siswa->save($data);

                    if ($save == true) {
                        $err .= '<div class="alert alert-success">
                        <strong>Sukses!</strong> Kamu Berhasil Absen Sesi Pertama,Jangan Lupa Untuk Yang ke 2 Nanti Ya !.
                    </div>';
                    } else {
                        $err .= '<div class="alert alert-danger">
                        <strong>Failed!</strong> Data Gagal Disimpan Silahkan Coba Kembali !.
                    </div>';
                    }
                } else {
                    $err .= '<div class="alert alert-danger">
                    <strong>Failed!</strong> Anda Sudah Absen Di Sesi Pertama.
                  </div>';
                }
            } else if (date('H:i:s') < '19:00:00' && date('H:i:s') > '18:00:00') {
                $absen = $this->M_absen_siswa->get_absen($nis, $date);



                if ($absen->num_rows() < 1) {
                    // $status_absen =  $absen->row()->status_absen2;
                    $data = array(
                        'nis' => $nis,
                        'tanggal' => date('Y-m-d'),
                        'id_semester' => 1,
                        'bulan' => date('F'),
                        'jam_absen2' => date('Y-m-d H:i:s'),
                        'latitude2' => $latitude,
                        'longitude2' => $longitude,
                        'status_absen2' => 1
                    );

                    $save = $this->M_absen_siswa->save($data);

                    if ($save == true) {
                        $err .= '<div class="alert alert-success">
                            <strong>Sukses!</strong> Kamu Berhasil Absen Sesi Pertama,Jangan Lupa Untuk Yang ke 2 Nanti Ya !.
                        </div>';
                    } else {
                        $err .= '<div class="alert alert-danger">
                            <strong>Failed!</strong> Data Gagal Disimpan Silahkan Coba Kembali !.
                        </div>';
                    }
                } else {
                    $status_absen =  $absen->row()->status_absen2;
                    if ($status_absen == NULL) {

                        $data = array(

                            'jam_absen2' => date('Y-m-d H:i:s'),
                            'latitude2' => $latitude,
                            'longitude2' => $longitude,
                            'status_absen2' => 1
                        );
                        $id = $absen->row()->id_absen;


                        $save = $this->M_absen_siswa->update($id, $data);

                        if ($save == true) {
                            $err .= '<div class="alert alert-success">
                            <strong>Sukses!</strong> Kamu Berhasil Absen Sesi Kedua,Jangan Lupa Untuk Yang ke 3 Nanti Ya !.
                        </div>';
                        } else {
                            $err .= '<div class="alert alert-danger">
                            <strong>Failed!</strong> Data Gagal Disimpan Silahkan Coba Kembali !.
                        </div>';
                        }
                    } else {
                        $err .= '<div class="alert alert-danger">
                        <strong>Failed!</strong> Anda Sudah Absen Di Sesi Kedua.
                      </div>';
                    }
                }
            } else if (date('H:i:s') < '12:00:00' && date('H:i:s') > '10:00:00') {
                $absen = $this->M_absen_siswa->get_absen($nis, $date);

                if ($absen->num_rows() < 1) {
                    // $status_absen =  $absen->row()->status_absen3;


                    $data = array(
                        'nis' => $nis,
                        'tanggal' => date('Y-m-d'),
                        'id_semester' => 1,
                        'bulan' => date('F'),
                        'jam_absen3' => date('Y-m-d H:i:s'),
                        'latitude3' => $latitude,
                        'longitude3' => $longitude,
                        'status_absen3' => 1
                    );

                    $save = $this->M_absen_siswa->save($data);

                    if ($save == true) {
                        $err .= '<div class="alert alert-success">
                            <strong>Sukses!</strong> Kamu Berhasil Absen Sesi Pertama,Jangan Lupa Untuk Yang ke 2 Nanti Ya !.
                        </div>';
                    } else {
                        $err .= '<div class="alert alert-danger">
                            <strong>Failed!</strong> Data Gagal Disimpan Silahkan Coba Kembali !.
                        </div>';
                    }
                } else {
                    $status_absen =  $absen->row()->status_absen3;
                    if ($status_absen == NULL) {
                        $data = array(
                            'jam_absen3' => date('Y-m-d H:i:s'),
                            'latitude3' => $latitude,
                            'longitude3' => $longitude,
                            'status_absen3' => 1
                        );

                        $id = $absen->row()->id_absen;

                        $save = $this->M_absen_siswa->update($id, $data);

                        if ($save == true) {
                            $err .= '<div class="alert alert-success">
                            <strong>Sukses!</strong> Kamu Sudah Absen Sesi Ketiga,Terimakasih Telah Melakukan Absen Hari Ini !.
                        </div>';
                        } else {
                            $err .= '<div class="alert alert-danger">
                            <strong>Failed!</strong> Data Gagal Disimpan Silahkan Coba Kembali !.
                        </div>';
                        }
                    } else {
                        $err .= '<div class="alert alert-danger">
                        <strong>Failed!</strong> Anda Sudah Absen Di Sesi Ke Tiga.
                      </div>';
                    }
                }
            } else {
                $err .= '<div class="alert alert-danger">
            <strong>Failed!</strong> Kamu Di Luar Waktu Absen Yang Di tentukan !.
          </div>';
            }
        } else {

            $err .= '<div class="alert alert-danger">
            <strong>Failed!</strong> Nis Kamu Tidak Terdaftar.
          </div>';
        }

        echo json_encode($err);
    }


    function get_map($link)
    {
        $this->data['breadcrumb']  = 'Absen > Maps';
        $this->data['main_view']   = 'absen/v_maps';

        $url = explode("X", $link);
        $absen = $this->M_absen_siswa->get_absen_by_id($url[1])->row();
        $absen_rumah = $this->M_absen_siswa->get_siswa($absen->nis)->row();
        $this->data['identitas'] =  $url[0];
        $this->data['id'] =  $url[1];
        $this->data['absen'] = $absen;
        $this->data['absen_rumah'] = $absen_rumah;
        $this->load->view('template', $this->data);
    }


    function cek_absensi()
    {
        $cek_absensi = $this->input->post('button-cek1');

        $explode =  explode("-", $cek_absensi);
        $id = $explode[1];

        if ($explode[0] == "absen1") {
            $data = array('cek_absen1' => 1);

            $update = $this->M_absen_siswa->update($id, $data);
            if ($update == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">
                <strong>Success!</strong> Terimakasih Telah Memeriksa.
              </div>');
                redirect('Absen');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <strong>Failed!</strong> Proses Gagal Silahkan Coba Kembali.
              </div>');
                redirect('Absen');
            }
        } else if ($explode[0] == "absen2") {
            $data = array('cek_absen2' => 1);

            $update = $this->M_absen_siswa->update($id, $data);
            if ($update == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">
                <strong>Success!</strong> Terimakasih Telah Memeriksa.
              </div>');
                redirect('Absen');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <strong>Failed!</strong> Proses Gagal Silahkan Coba Kembali.
              </div>');
                redirect('Absen');
            }
        } else {
            $data = array('cek_absen3' => 1);

            $update = $this->M_absen_siswa->update($id, $data);
            if ($update == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">
                <strong>Success!</strong> Terimakasih Telah Memeriksa Data Seluruh Sesi.
              </div>');
                redirect('Absen');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
                <strong>Failed!</strong> Proses Gagal Silahkan Coba Kembali.
              </div>');
                redirect('Absen');
            }
        }
    }

    function edit_status($id_absen)
    {
        $this->data['breadcrumb']  = 'Absen > Edit Status';
        $this->data['main_view']   = 'absen/v_edit_status';
        $this->data['id']   = $id_absen;
        $this->load->view('template', $this->data);
    }

    function proses_edit_status()
    {
        $status = $this->input->post('ubah_status');
        if ($status == "") {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <strong>Failed!</strong> Silahkan Pilih Status Terlebih dahulu.
          </div>');
            redirect('Absen_sisswa/edit_status');
        }

        $id = $this->input->post('id');

        $data = array('konfirmasi' => $status);

        $update = $this->M_absen_siswa->update($id, $data);
        if ($update == true) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">
            <strong>Success!</strong> Terimakasih Telah Memeriksa Data Seluruh Sesi.
          </div>');
            redirect('absen');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger">
            <strong>Failed!</strong> Proses Gagal Silahkan Coba Kembali.
          </div>');
            redirect('absen');
        }
    }
}
