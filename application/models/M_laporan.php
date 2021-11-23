<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    public function __construct()
    {
        $this->id_user  = $this->session->userdata('id_user');
        $this->tgl      = date("Y-m-d", now('Asia/Jakarta'));
    }

    // 04-11-2020
    public function get_pendapatan()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));
        
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);    
        
        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {
            $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } else {
            if ($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == '') {
                
            } else {
                $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $this->tgl);
            }
        }
        
        $a = $this->db->get()->row_array();
        
        return $a['total_transaksi'];
    }

    // 05-11-2020
    public function tot_pendapatan_chart($tgl, $aksi)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);    
        
        if ($aksi == 'tanggal') {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tgl);
        } else {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $tgl);
        }
        
        $a = $this->db->get()->row_array();
        
        return $a['total_transaksi'];
    }

    // 04-11-2020
    public function get_pendapatan_2()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));
        
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);    
        
        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $this->tgl);
        
        $a = $this->db->get()->row_array();
        
        return $a['total_transaksi'];
    }

    // 04-11-2020
    public function get_pendapatan_download($tgl_awal, $tgl_akhir, $id_user)
    {
        $this->db->select_sum('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $id_user);    
        
        if ($tgl_awal != '' && $tgl_akhir != '') {
            $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } 
        
        $a = $this->db->get()->row_array();
        
        return $a['total_transaksi'];
    }

    // 04-11-2020
    public function get_pengunjung()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));
        
        $this->db->select_sum('jml_pengunjung');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);        
        
        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {
            $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } else {
            if ($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == '') {
                
            } else {
                $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $this->tgl);
            }
        }
        
        $a = $this->db->get()->row_array();
        
        return $a['jml_pengunjung'];
    }

    // 05-11-2020
    public function tot_pengunjung_chart($tgl, $aksi)
    {
        $this->db->select_sum('jml_pengunjung');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);    
        
        if ($aksi == 'tanggal') {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tgl);
        } else {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $tgl);
        }
        
        $a = $this->db->get()->row_array();
        
        return $a['jml_pengunjung'];
    }

    // 04-11-2020
    public function get_pengunjung_2()
    {
        $tgl = date("Y-m-d", now('Asia/Jakarta'));
        
        $this->db->select_sum('jml_pengunjung');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);        
        
        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $this->tgl);
        
        $a = $this->db->get()->row_array();
        
        return $a['jml_pengunjung'];
    }

    // 04-11-2020
    public function get_pengunjung_download($tgl_awal, $tgl_akhir, $id_user)
    {
        $this->db->select_sum('jml_pengunjung');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $id_user);        
        
        if ($tgl_awal != '' && $tgl_akhir != '') {
            $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } 
        
        $a = $this->db->get()->row_array();
        
        return $a['jml_pengunjung'];
    }

    // 04-11-2020
    public function get_tot_transaksi()
    {
        $this->db->select('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);        
        
        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {
            $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } else {
            if ($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == '') {
                
            } else {
                $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $this->tgl);
            }
        }
        
        return $this->db->get()->num_rows();
    }

    // 05-11-2020
    public function tot_transaksi_chart($tgl, $aksi)
    {
        $this->db->select('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);        
        
        if ($aksi == 'tanggal') {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $tgl);
        } else {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $tgl);
        }
        
        return $this->db->get()->num_rows();
    }

    // 04-11-2020
    public function get_tot_transaksi_2()
    {
        $this->db->select('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $this->id_user);        
        
        $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') =", $this->tgl);
        
        return $this->db->get()->num_rows();
    }

    // 04-11-2020
    public function get_transaksi_download($tgl_awal, $tgl_akhir, $id_user)
    {
        $this->db->select('total_transaksi');
        $this->db->from('trn_transaksi');
        $this->db->where('id_user', $id_user);        
        
        if ($tgl_awal != '' && $tgl_akhir != '') {
            $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
            $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } 
        
        return $this->db->get()->num_rows();
    }

    // 04-11-2020
    public function get_report_transaksi($tgl_awal, $tgl_akhir, $id_user)
    {
        $awal   = date("Y-m-d", strtotime($tgl_awal));
        $akhir  = date("Y-m-d", strtotime($tgl_akhir)); 

        $this->db->select('*, (SELECT harga from mst_setting LIMIT 1) as harga');
        $this->db->from('trn_transaksi'); 
        $this->db->where('id_user', $id_user);

        if ($tgl_awal != '' && $tgl_akhir != '') {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } 

        return $this->db->get();
    }
    
    // 04-11-2020
    // Menampilkan list report
    public function get_data_report()
    {
        $this->_get_datatables_query_report();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_report = [null, 'created_at', 'kode_transaksi', 'jml_pengunjung', 'total_transaksi'];
    var $kolom_cari_report  = ['created_at', 'kode_transaksi', 'jml_pengunjung', 'total_transaksi'];
    var $order_report       = ['created_at' => 'desc'];

    public function _get_datatables_query_report()
    {   
        $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
        $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir'))); 

        $this->db->select('*, (SELECT harga from mst_setting LIMIT 1) as harga');
        $this->db->from('trn_transaksi'); 
        $this->db->where('id_user', $this->id_user);

        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        } 

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_report;

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

            $kolom_order = $this->kolom_order_report;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_report)) {
            
            $order = $this->order_report;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_report()
    {
        $awal   = date("Y-m-d", strtotime($this->input->post('tgl_awal')));
        $akhir  = date("Y-m-d", strtotime($this->input->post('tgl_akhir')));

        $this->db->select('*');
        $this->db->from('trn_transaksi'); 
        $this->db->where('id_user', $this->id_user);

        if ($this->input->post('tgl_awal') != '' && $this->input->post('tgl_akhir') != '') {
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m-%d') BETWEEN '$awal' AND '$akhir'");
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_report()
    {
        $this->_get_datatables_query_report();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_laporan.php */
