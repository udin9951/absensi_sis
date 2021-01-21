<?php

class Rekap_model extends CI_Model
{

	public $db_tabel = 'absen';

	// cari data absen di kelas yang dipilih pada semester yang sedang aktif
	function get_kelas()
	{
		return $this->db->get('kelas');
	}

	function export($date)
	{
		$this->db->where('bulan', $date);
		return $this->db->get('absen');
	}
}
/* End of file rekap_model.php */
/* Location: ./application/models/rekap_model.php */