<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
	}

    public function index()
    {
        $bln = array();
		$day = array();

        $skrg 	= date("Y-m", now('Asia/Jakarta'));
        $skrg_t = date("Y-m-d", now('Asia/Jakarta'));

        for ($i=4; $i >= 0; $i--) { 

            $a = date('Y-m', strtotime("$skrg -$i months"));
			array_push($bln, date("M Y", strtotime($a)));
			
            $b = date('Y-m-d', strtotime("$skrg_t -$i days"));
			array_push($day, date("d-M-Y", strtotime($b)));
			
        }
        
        $pendapatan_b 	= array();
		$transaksi_b 	= array();
		$pengunjung_b 	= array();

        // bulan
		foreach ($bln as $b) {
            
            $bulan = date('Y-m', strtotime($b));

			$tt_pendapatan	= $this->laporan->tot_pendapatan_chart($bulan, 'bulan');
			$tt_transaksi   = $this->laporan->tot_transaksi_chart($bulan, 'bulan');
			$tt_pengunjung  = $this->laporan->tot_pengunjung_chart($bulan, 'bulan');

			array_push($pendapatan_b, ($tt_pendapatan) ? $tt_pendapatan : 0);
			array_push($transaksi_b, $tt_transaksi);
			array_push($pengunjung_b, ($tt_pengunjung) ? $tt_pengunjung : 0);
            
        }

        $pendapatan_h 	= array();
		$transaksi_h 	= array();
		$pengunjung_h 	= array();
        
        // hari
		foreach ($day as $d) {

            $tanggal = date('Y-m-d', strtotime($d));

            $tt_pendapatan_h    = $this->laporan->tot_pendapatan_chart($tanggal, 'tanggal');
            $tt_transaksi_h     = $this->laporan->tot_transaksi_chart($tanggal, 'tanggal');
            $tt_pengunjung_h    = $this->laporan->tot_pengunjung_chart($tanggal, 'tanggal');

            array_push($pendapatan_h, ($tt_pendapatan_h) ? $tt_pendapatan_h : 0);
            array_push($transaksi_h, $tt_transaksi_h);
            array_push($pengunjung_h, ($tt_pengunjung_h) ? $tt_pengunjung_h : 0);
			
        }
        
        $data 	= [ 'title'         => 'Dashboard',
                    'pendapatan'    => ($this->laporan->get_pendapatan_2()) ? $this->laporan->get_pendapatan_2() : '0',
                    'transaksi'     => $this->laporan->get_tot_transaksi_2(),
                    'pengunjung'    => ($this->laporan->get_pengunjung_2()) ? $this->laporan->get_pengunjung_2() : '0',
                    'bln'		    => $bln,
			        'day'		    => $day,
                    'pendapatan_h'  => $pendapatan_h,
                    'transaksi_h'   => $transaksi_h,
                    'pengunjung_h'  => $pengunjung_h,
                    'pendapatan_b'  => $pendapatan_b,
                    'transaksi_b'   => $transaksi_b,
                    'pengunjung_b'  => $pengunjung_b
                  ];

        $this->template->load('template/index','dashboard', $data);
    }

    public function tes()
	{
		$bln = array();
		$day = array();

        $skrg 	= date("Y-m", now('Asia/Jakarta'));
        $skrg_t = date("Y-m-d", now('Asia/Jakarta'));

        for ($i=4; $i >= 0; $i--) { 

            $a = date('Y-m', strtotime("$skrg -$i months"));
			array_push($bln, date("M Y", strtotime($a)));
			
            $b = date('Y-m-d', strtotime("$skrg_t -$i days"));
			array_push($day, date("d-M-Y", strtotime($b)));
			
		}

		foreach ($bln as $b) {
			$bulan[] = $b;
		}
		foreach ($day as $d) {
			$hari[] = $d;
		}
		
		echo json_encode($hari);
	}


}

/* End of file Dashboard.php */
