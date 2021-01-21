<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Guru_model extends CI_Model
{

    public $db_tabel    = 'guru';
    public $per_halaman = 10;
    public $offset      = 0;

    // rules form validasi, proses TAMBAH
    private function load_form_rules_tambah()
    {
        $form = array(
            array(
                'field' => 'nopeg',
                'label' => 'Nopeg',
                'rules' => "required|exact_length[4]|numeric|is_unique[$this->db_tabel.nopeg]"
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|max_length[50]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|max_length[50]'
            ),
            array(
                'field' => 'id_kelas',
                'label' => 'Kelas',
                'rules' => 'required'
            ),
        );
        return $form;
    }

    // rules form validasi, proses EDIT
    private function load_form_rules_edit()
    {
        $form = array(
            array(
                'field' => 'nopeg',
                'label' => 'nopeg',
                'rules' => "required|exact_length[4]|numeric|callback_is_nopeg_exist"
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|max_length[50]'
            ),
            array(
                'field' => 'id_kelas',
                'label' => 'Kelas',
                'rules' => 'required'
            ),
        );
        return $form;
    }

    // jalankan proses validasi, untuk operasi TAMBAH
    public function validasi_tambah()
    {
        $form = $this->load_form_rules_tambah();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // jalankan proses validasi, untuk operasi EDIT
    public function validasi_edit()
    {
        $form = $this->load_form_rules_edit();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cari_semua($offset)
    {
        /**
         * $offset start
         * Gunakan hanya jika class 'PAGINATION' menggunakan option
         * 'use_page_numbers' => TRUE
         * Jika tidak, beri comment
         */
        if (is_null($offset) || empty($offset)) {
            $this->offset = 0;
        } else {
            $this->offset = ($offset * $this->per_halaman) - $this->per_halaman;
        }
        // $offset end

        return $this->db->select('*')
            ->from($this->db_tabel)
            ->join('kelas', 'kelas.id_kelas = guru.wali_kelas')
            ->limit($this->per_halaman, $this->offset)
            ->order_by('nopeg', 'DESC')
            ->get()
            ->result();
    }

    public function cari($nopeg)
    {
        return $this->db->where('nopeg', $nopeg)
            ->limit(1)
            ->get($this->db_tabel)
            ->row();
    }

    public function buat_tabel($data)
    {
        $this->load->library('table');

        // buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        // heading tabel
        $this->table->set_heading('No', 'Nopeg', 'Nama', 'Kelas Ajar', 'Aksi');

        // no urut data
        $no = 0 + $this->offset;

        foreach ($data as $row) {
            $this->table->add_row(
                ++$no,
                $row->nopeg,
                $row->nama,
                $row->kelas,
                anchor('guru/edit/' . $row->nopeg, '<i class="zmdi zmdi-edit"></i> Edit', array('class' => 'edit')) . ' ' .
                    anchor('guru/hapus/' . $row->nopeg, '<i class="zmdi zmdi-delete"></i> Hapus', array('class' => 'delete', 'onclick' => "return confirm('Anda yakin akan menghapus data ini?')"))
            );
        }
        $tabel = $this->table->generate();

        return $tabel;
    }

    public function paging($base_url)
    {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $this->hitung_semua(),
            'per_page'         => $this->per_halaman,
            'num_links'        => 4,
            'use_page_numbers' => TRUE,
            'first_link'       => 'First',
            'last_link'        => 'Last',
            'next_link'        => 'Next',
            'prev_link'        => 'Prev',
            'full_tag_open'    => '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">',
            'full_tag_close'   => '</ul></nav></div>',
            'num_tag_open'     => '<li class="page-item"><span class="page-link">',
            'num_tag_close'    => '</span></li>',
            'cur_tag_open'     => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close'    => '<span class="sr-only">(current)</span></span></li>',
            'next_tag_open'    => '<li class="page-item"><span class="page-link">',
            'next_tagl_close'  => '<span aria-hidden="true">&raquo;</span></span></li>',
            'prev_tag_open'    => '<li class="page-item"><span class="page-link">',
            'prev_tagl_close'  => '</span>Next</li>',
            'first_tag_open'   => '<li class="page-item"><span class="page-link">',
            'first_tagl_close' => '</span></li>',
            'last_tag_open'    => '<li class="page-item"><span class="page-link">',
            'last_tagl_close'  => '</span></li>',
        );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function hitung_semua()
    {
        return $this->db->count_all($this->db_tabel);
    }

    public function tambah($data)
    {


        return $this->db->insert($this->db_tabel, $data);
    }

    function get_wali_kelas()
    {
        return $this->db->get('guru');
    }

    public function edit($nopeg)
    {
        $siswa = array(
            'nis' => $this->input->post('nis'),
            'nama' => $this->input->post('nama'),
            'id_kelas' => $this->input->post('id_kelas'),
            'wali_kelas' => $this->input->post('wali_kelas'),
        );

        // update db
        $this->db->where('nopeg', $nopeg);
        $this->db->update($this->db_tabel, $siswa);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hapus($nopeg)
    {
        $this->db->where('nopeg', $nopeg)->delete($this->db_tabel);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
/* End of file siswa_model.php */
/* Location: ./application/models/siswa_model.php */