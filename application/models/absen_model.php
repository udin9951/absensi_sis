<?php
class Absen_model extends CI_Model
{

    public $db_tabel    = 'absen';
    public $per_halaman = 10;
    public $offset      = 0;

    private function load_form_rules_tambah()
    {
        $form = array(
            array(
                'field' => 'nis',
                'label' => 'NIS',
                'rules' => 'required|exact_length[4]|callback_is_siswa_exist'
            ),
            array(
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required|callback_is_format_tanggal|callback_is_double_entry_tambah'
            ),
            array(
                'field' => 'absen',
                'label' => 'Absen',
                'rules' => 'required'
            ),
        );
        return $form;
    }

    private function load_form_rules_edit()
    {
        $form = array(
            array(
                'field' => 'nis',
                'label' => 'NIS',
                'rules' => 'required|exact_length[4]|callback_is_siswa_exist'
            ),
            array(
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required|callback_is_format_tanggal|callback_is_double_entry_edit'
            ),
            array(
                'field' => 'absen',
                'label' => 'Absen',
                'rules' => 'required'
            ),
        );
        return $form;
    }

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

    public function cari_semua($offset, $id_semester, $nopeg)
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

        if ($nopeg != "admin") {
            return $this->db->select('*')
                ->from('absen,
                        siswa,
                        kelas,
                        semester')
                ->where('siswa.id_kelas = kelas.id_kelas')
                ->where('absen.nis = siswa.nis')
                ->where('semester.id_semester = absen.id_semester')
                ->where('absen.id_semester', $id_semester)
                ->where('absen.wali_kelas', $nopeg)
                ->where('absen.tanggal', date('Y-m-d'))
                ->order_by('absen.id_absen', 'desc')
                ->limit($this->per_halaman, $this->offset)
                ->get()->result();
        } else {
            return $this->db->select('*')
                ->from('absen,
                        siswa,
                        kelas,
                        semester')
                ->where('siswa.id_kelas = kelas.id_kelas')
                ->where('absen.nis = siswa.nis')
                ->where('semester.id_semester = absen.id_semester')
                ->where('absen.id_semester', $id_semester)
                ->where('absen.tanggal', date('Y-m-d'))
                ->order_by('absen.id_absen', 'desc')
                ->limit($this->per_halaman, $this->offset)
                ->get()->result();
        }
    }

    public function cari($id_absen)
    {
        return $this->db->where('id_absen', $id_absen)
            ->limit(1)
            ->get($this->db_tabel)
            ->row();
    }

    public function buat_tabel($absen)
    {
        $this->load->library('table');

        // Buat class zebra di <tr>,untuk warna selang-seling
        $tmpl = array('row_alt_start'  => '<tr class="zebra">');
        $this->table->set_template($tmpl);

        /// Buat heading tabel
        $this->table->set_heading(
            'No',
            'Hari, Tanggal',
            'No Induk',
            'Nama',
            'Kelas',
            'Latitude dan Longitude Rumah',
            'Latitude dan longitude Masuk Sesi 1',
            'Latitude dan longitude Masuk Sesi 2',
            'Latitude dan longitude Masuk Sesi 3',
            'status',
            'Aksi'
        );

        // $i = 0 + $offset;
        $no = 0 + $this->offset;
        foreach ($absen as $row) {
            // Konversi hari dan tanggal ke dalam format Indonesia (dd-mm-yyyy)
            $hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
            $hr = date('w', strtotime($row->tanggal));
            $hari = $hari_array[$hr];
            $tgl = date('d-m-Y', strtotime($row->tanggal));
            $hr_tgl = "$hari, $tgl";

            $this->db->where('nis', $row->nis);
            $db = $this->db->get('siswa');
            $get = $db->row();

            if ($row->konfirmasi == NULL) {
                $status = '<div class="alert alert-warning">
                <strong>Belum Di Proses!</strong>
              </div>';
            } else if ($row->konfirmasi == 1) {
                $status = '<div class="alert alert-primary">
                <strong>Sudah Di Proses Dan Cocok!</strong>
              </div>';
            } else {
                $status = '<div class="alert alert-danger">
                <strong>Sudah Di Proses Namun Data tidak Cocok!</strong>
              </div>';
            }



            if ($get->latitude_rumah == "" && $get->longitude_rumah == "") {
                $latud_rumah = "";
            } else {
                $latud_rumah = $get->latitude_rumah . '+' . $get->longitude_rumah . '&nbsp;&nbsp; ';
            }

            if ($row->latitude1 == "" && $row->longitude1 == "") {
                $latud1 = "";
            } else {
                $latud1 = $row->latitude1 . '+' . $row->longitude1 . '&nbsp;&nbsp; <a href="' . base_url('Absen_siswa/get_map') . '/absen1X' . $row->id_absen . '" class="btn btn-primary" id="print" target="_blank" ><i class="zmdi zmdi-eye"></i></a>';
            }

            if ($row->latitude2 == "" && $row->longitude2 == "") {
                $latud2 = "";
            } else {
                $latud2 = $row->latitude2 . '+' . $row->longitude2 . '&nbsp;&nbsp; <a href="' . base_url('Absen_siswa/get_map') . '/absen2X' . $row->id_absen . '" class="btn btn-primary" id="print" target="_blank" ><i class="zmdi zmdi-eye"></i></a>';
            }

            if ($row->latitude3 == "" && $row->longitude3 == "") {
                $latud3 = "";
            } else {
                $latud3 = $row->latitude3 . '+' . $row->longitude3 . '&nbsp;&nbsp; <a href="' . base_url('Absen_siswa/get_map') . '/absen3X' . $row->id_absen . '" class="btn btn-primary" id="print" target="_blank" ><i class="zmdi zmdi-eye"></i></a>';
            }

            if ($row->cek_absen1 == NULL || $row->cek_absen2 == NULL || $row->cek_absen3 == NULL) {
                $cek1 = "";
                $cek2 = "";
                $cek3 = "";

                if ($row->cek_absen1 == NULL) {
                    $cek1 .= "Belum Di Cek";
                } else {
                    $cek1 .= "Sudah Di cek";
                }

                if ($row->cek_absen2 == NULL) {
                    $cek2 .= "Belum Di Cek";
                } else {
                    $cek2 .= "Sudah Di cek";
                }

                if ($row->cek_absen3 == NULL) {
                    $cek3 .= "Belum Di Cek";
                } else {
                    $cek3 .= "Sudah Di cek";
                }
                $cek_status_absen = '<a href="#" data-toggle="popover" title="Cek Status Absen" data-content="
                status absen 1 =' . $cek1 . '&emsp;&emsp;&emsp;
                status absen 2 =' . $cek2 . '&emsp;&emsp;&emsp;
                status absen 3 =' . $cek3 . '&emsp;&emsp;&emsp;
                ">Ubah Satus</a>';
            } else {
                $cek_status_absen = anchor('Absen_siswa/edit_status/' . $row->id_absen, 'Ubah Status', array('class' => 'edit'));
            }
            $this->table->add_row(
                ++$no,
                $hr_tgl,
                $row->nis,
                $row->nama,
                $row->kelas,
                $latud_rumah,
                $latud1,
                $latud2,
                $latud3,
                $status,

                $cek_status_absen
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
            'first_link'       => '&#124;&lt; First',
            'last_link'        => 'Last &gt;&#124;',
            'next_link'        => 'Next &gt;',
            'prev_link'        => '&lt; Prev',
        );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function hitung_semua()
    {
        $id_semester = $this->db->select('id_semester')
            ->where('status', 'Y')
            ->limit(1)
            ->get('semester')
            ->row()->id_semester;

        return $this->db->select('absen.id_absen,
		                          absen.tanggal,
		                          absen.absen,
		                          siswa.nis,
		                          siswa.nama,
		                          kelas.kelas')
            ->from('absen,
                                    siswa,
                                    kelas,
                                    semester')
            ->where('siswa.id_kelas = kelas.id_kelas')
            ->where('absen.nis = siswa.nis')
            ->where('semester.id_semester = absen.id_semester')
            ->where('absen.id_semester', $id_semester)
            ->order_by('absen.id_absen', 'desc')
            ->get()->num_rows();
    }

    function hapus($id_absen)
    {
        $this->db->where('id_absen', $id_absen)->delete($this->db_tabel);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function tambah()
    {
        // cek semester yang sedang aktif
        $smt = $this->semester->cari_semester_aktif();
        $id_semester = $smt->id_semester;

        $absen = array(
            'nis' => $this->input->post('nis'),
            'id_semester' => $id_semester,
            'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'absen' => $this->input->post('absen')
        );
        $this->db->insert($this->db_tabel, $absen);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit($id_absen)
    {
        // cek semester yang sedang aktif
        $smt = $this->semester->cari_semester_aktif();
        $id_semester = $smt->id_semester;

        $absen = array(
            'nis' => $this->input->post('nis'),
            'id_semester' => $id_semester,
            'tanggal'        => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'absen' => $this->input->post('absen'),
        );

        // update db
        $this->db->where('id_absen', $id_absen)->update($this->db_tabel, $absen);

        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
/* End of file absen_model.php */
/* Location: ./application/models/absen_model.php */