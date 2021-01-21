<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guru extends MY_Controller
{
    public $data = array(
        'modul'         => 'Guru',
        'breadcrumb'    => 'Guru',
        'pesan'         => '',
        'pagination'    => '',
        'tabel_data'    => '',
        'main_view'     => 'guru/guru',
        'form_action'   => '',
        'form_value'    => '',
        'option_kelas'  => '',
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model', 'siswa', TRUE);
        $this->load->model('Kelas_model', 'kelas', TRUE);
        $this->load->model('Guru_model', 'guru', TRUE);
    }

    function index($offset = 0)
    {
        // hapus data temporary proses update
        $this->session->unset_userdata('nis_sekarang', '');

        // cari data siswa
        $guru = $this->guru->cari_semua($offset);

        // ada data siswa, tampilkan
        if ($guru) {
            $tabel = $this->guru->buat_tabel($guru);
            $this->data['tabel_data'] = $tabel;

            // Paging
            // http://localhost/absensi2014/siswa/halaman/2
            $this->data['pagination'] = $this->guru->paging(site_url('guru/halaman'));
        }
        // tidak ada data siswa
        else {
            $this->data['pesan'] = 'Tidak ada data siswa.';
        }
        $this->load->view('template', $this->data);
    }

    public function tambah()
    {
        $this->data['breadcrumb']  = 'Guru > Tambah';
        $this->data['main_view']   = 'guru/guru_form';
        $kelas = $this->kelas->cari_semua();
        $wali_kelas = $this->siswa->get_wali_kelas()->result();
        $this->data['select'] = $kelas;
        $this->data['wali_kelas'] = $wali_kelas;

        $this->load->view('template', $this->data);
    }

    function tambah_data()
    {
        $nopeg = $this->input->post('nopeg');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
        $id_kelas = $this->input->post('id_kelas');

        $data = array(
            'nopeg' => $nopeg,
            'nama' => $nama,
            'password' => md5($password),
            'wali_kelas' => $id_kelas
        );

        $save = $this->guru->tambah($data);

        if ($save == true) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Proses tambah data berhasil.</div>');
            redirect('guru/tambah');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Proses tambah data gagal.</div>');
            redirect('guru/tambah');
        }
    }


    public function edit($nis = NULL)
    {
        $this->data['breadcrumb']  = 'Guru > Edit';
        $this->data['main_view']   = 'guru/guru_edit_form';
        $kelas = $this->kelas->cari_semua();
        $guru = $this->guru->cari($nis);
        $wali_kelas = $this->siswa->get_wali_kelas()->result();
        $this->data['select'] = $kelas;
        $this->data['guru'] = $guru;
        $this->data['wali_kelas'] = $wali_kelas;
        $this->data['form_action'] = 'guru/edit/' . $nis;

        $this->load->view('template', $this->data);
    }
}
