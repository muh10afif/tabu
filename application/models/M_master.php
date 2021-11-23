<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

    // 02-11-2020
    public function get_data_order($tabel, $field, $urut)
    {
        if ($field != '' & $urut != '') {
            $this->db->order_by($field, $urut);
        }

        return $this->db->get($tabel);
        
    }

    // 02-11-2020
    public function cari_data($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    // 02-11-2020
    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    // 02-11-2020
    public function ubah_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    // 02-11-2020
    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }

    // 02-11-2020
    // Menampilkan list hari_besar
    public function get_data_hari_besar()
    {
        $this->_get_datatables_query_hari_besar();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_hari_besar = [null, 'tgl_awal', 'tgl_akhir', 'judul'];
    var $kolom_cari_hari_besar  = ['tgl_awal', 'tgl_akhir', 'LOWER(judul)'];
    var $order_hari_besar       = ['id' => 'asc'];

    public function _get_datatables_query_hari_besar()
    {
        $this->db->from('mst_hari_besar'); 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_hari_besar;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_hari_besar;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_hari_besar)) {
            
            $order = $this->order_hari_besar;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_hari_besar()
    {
        $this->db->from('mst_hari_besar');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_hari_besar()
    {
        $this->_get_datatables_query_hari_besar();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_master.php */
