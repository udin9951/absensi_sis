<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_absen_siswa extends CI_Model
{

    public $db_tabel = 'kelas';

    public function __construct()
    {
        parent::__construct();
    }

    function get_siswa($where)
    {
        $this->db->where('nis', $where);
        return $this->db->get('siswa');
    }

    function get_absen($nis, $date)
    {
        $this->db->where('nis', $nis);
        $this->db->where('tanggal', $date);
        return $this->db->get('absen');
    }

    function get_absen_by_id($id)
    {
        $this->db->where('id_absen', $id);
        return $this->db->get('absen');
    }

    function save($data)
    {
        return $this->db->insert('absen', $data);
    }

    function update($id, $data)
    {
        $this->db->where('id_absen', $id);
        return $this->db->update('absen', $data);
    }
}
