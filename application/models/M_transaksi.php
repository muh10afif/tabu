<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    // 03-11-2020
    public function get_harga()
    {
        $a = $this->db->get('mst_setting')->row_array();

        return $a['harga'];
    }

    // 03-11-2020
    public function get_jml_pengunjung()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));

        $this->db->select_sum('jml_pengunjung');
        $this->db->from('trn_transaksi');
        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tgl);
        
        $a = $this->db->get()->row_array();
        
        return $a['jml_pengunjung'] + 1;
    }

    // 03-11-2020
    public function cari_data_kd_tr($tabel, $where)
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where($where);
        $this->db->order_by('id', 'desc');

        return $this->db->get();
        
    }

}

/* End of file M_transaksi.php */
