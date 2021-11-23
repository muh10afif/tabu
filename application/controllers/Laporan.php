<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    // 28-10-2020
    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
    }
    
    // 28-10-2020
    public function index()
    {
        // cari judul setting
        $jd = $this->master->cari_data('mst_setting', ['id' => 1])->row_array();

        $data 	= ['title'      => 'Laporan',
                   'pendapatan' => $this->laporan->get_pendapatan(),
                   'transaksi'  => $this->laporan->get_tot_transaksi(),
                   'pengunjung' => $this->laporan->get_pengunjung(),
                   'judul_set'  => $jd['judul']
                  ];

        $this->template->load('template/index','laporan/lihat', $data);
    }

    // 04-11-2020
    public function tampil_report()
	{
		$list = $this->laporan->get_data_report();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $dt = ['tgl'        => date("d F Y H:i:s", strtotime($o['created_at'])),
                   'kode_tr'    => $o['kode_transaksi'],
                   'jml_p'      => $o['jml_pengunjung'],
                   'harga'      => $o['harga'],
                   'tunai'      => $o['tunai'],
                   'diskon'     => $o['total_discount'],
                   'total'      => $o['total_transaksi'],
                   'kembali'    => $o['tunai'] - $o['total_transaksi']
                  ];

            $jdl_hb = $this->judul_hb($o['created_at']);

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = nice_date($o['created_at'], 'd-M-Y H:i:s');
			$tbody[]    = $o['kode_transaksi'];
            $tbody[]    = "<div align='center'>".$o['jml_pengunjung']."</div>";
			$tbody[]    = "Rp. ".number_format($o['total_transaksi'],0,'.','.');
            $tbody[]    = "<span style='cursor:pointer' class='text-primary detail-report' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' tgl='".$dt['tgl']."' kode_tr='".$dt['kode_tr']."' jml_p='".$dt['jml_p']."' tunai='".$dt['tunai']."' harga='".$dt['harga']."' diskon='".$dt['diskon']."' total='".$dt['total']."' kembali='".$dt['kembali']."' judul_hb='".$jdl_hb."'><i class='mdi mdi-information-outline mdi-24px'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "tgl_awal"         => $this->input->post('tgl_awal'),
                    "recordsTotal"     => $this->laporan->jumlah_semua_report(),
                    "recordsFiltered"  => $this->laporan->jumlah_filter_report(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 06-11-2020
    public function judul_hb($tgl)
    {
        $tgl_today  = date("Y-m-d", strtotime($tgl));

        // list hari besar
        $hari = $this->db->get('mst_hari_besar')->result_array();
        
        foreach ($hari as $h) {

            if ($tgl_today >= $h['tgl_awal']) {
                if ($tgl_today <= $h['tgl_akhir']) {
                    $judul = $h['judul'];
                }
            } else {
                $judul = "";
            }
        }

        return $judul;
    }

    // 06-11-2020
    public function get_text($text)
	{
		// panjang text awal
		$text = $text." ";
		$lng = strlen($text);

		// panjang text kertas
		if ($lng < 32) {
			$num_char = $lng;
		} else {
			$num_char = 32;
		}

        // memotong yang kata yang terpotong
        $char     = $text{$num_char - 1};
        while($char != ' ') {
            $char = $text{--$num_char}; // Cari spasi pada posisi 49, 48, 47, dst...
		}
		$str_1 = substr($text, 0, $num_char);

		return $str_1;
	}
	
	// 06-11-2020
	public function ambil_string($text)
    {
		// $text = "Jln. Gunung Bandung No. 25 Kec.Cicendo";

        // panjang text awal
		$lng = strlen($text);
		
		$tot = ceil($lng / 32);

		$arr = [];

		// panjang text kertas
		if ($lng < 32) {
			$num_char = $lng;
		} else {
			$num_char = 32;
		}

        // memotong yang kata yang terpotong
        $char     = $text{$num_char - 1};
        while($char != ' ') {
            $char = $text{--$num_char}; // Cari spasi pada posisi 49, 48, 47, dst...
		}
		$str_1 = substr($text, 0, $num_char);

		array_push($arr, $str_1);
		
		$l_str = strlen($str_1);

		$t_str_2 	= (substr($text, $l_str));

		// ambil string kedua
		$str_2 		= $this->get_text($t_str_2);
		$l_str_2 	= strlen($str_2);

		if (count($arr) <= $tot) {
			array_push($arr, trim($str_2));
		}

		$t_str_3 	= substr($text, $l_str + $l_str_2);
		$str_3 		= $this->get_text($t_str_3);
		$l_str_3 	= strlen($str_3);

		if (count($arr) <= $tot) {
			array_push($arr, trim($str_3));
		}

		$t_str_4 	= substr($text, ($l_str + $l_str_2 + $l_str_3));
		$str_4 		= $this->get_text($t_str_4);
		$l_str_4 	= strlen($str_4);

		if (count($arr) <= $tot) {
			array_push($arr, trim($str_4));
		}

		return $arr;
	}

    // 06-11-2020 
    public function cetak_transaksi()
	{
        $post       = $this->input->post();
        
		$harga      = number_format($post['harga']);
        $jml_p      = $post['jml_p'];
        $kode_tr    = $post['kode_tr'];
        $judul_set  = $post['judul_set'];
        $judul_hb   = $post['judul_hb'];
        $tgl        = date("d/m/Y H:i", strtotime($post['tgl']));

		// untuk print

			// me-load library escpos
			$this->load->library('escpos');

			// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
			$connector 	= new Escpos\PrintConnectors\WindowsPrintConnector("Printer-POS-58-2");

			// membuat objek $printer agar dapat di lakukan fungsinya
			$printer 	= new Escpos\Printer($connector);

			/* Cut the receipt and open the cash drawer */
			// $printer->cut();
			$printer->pulse();

			// $gambar = "\depo.png";

			// $path  = __DIR__;

			// $path2 = str_replace("application\controllers","",$path);

			// $path3 = $path2."assets\img$gambar";

			// $tux = Escpos\EscposImage::load($path3);

			// $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
			// $printer->bitImageColumnFormat($tux);
			// $printer->setReverseColors(true);
			// $printer->text("\n");

			$printer->initialize();
			$printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
			$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
			$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            $printer->text("TAMAN BATU \n");
            
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            $printer->text("TIKET MASUK \n REGULAR");

            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->text($kode_tr." ".$tgl."\n");

			$hg = sprintf('%1$-15s %2$-16s','Harga', ": ".$harga);
			$printer->text("$hg\n");
			$ms_ber = sprintf('%1$-15s %2$-16s','Masa Berlaku', ": ".date("d/m/Y", strtotime($post['tgl'])));
			$printer->text("$ms_ber\n");
			$ks = sprintf('%1$-15s %2$-16s','Kasir', ": ".$this->session->userdata('username'));
            $printer->text("$ks\n\n");
            
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->text("Hanya Untuk ".$jml_p." Orang Pengunjung\n\n");

            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            $printer->text("$judul_set\n");

            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);

            $dt_judul = $this->ambil_string($judul_hb);

            foreach ($dt_judul as $d) {
				if($d == '')
				{
					unset($d);
				} else {
					$printer->text($d."\n");
				}
			}

            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
			$printer->text("\n"); 
            $printer->text("Terima Kasih Atas Kunjugan Anda\n");
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
			$printer->text("Powered By BAGJA INDONESIA\n");

			/* ---------------------------------------------------------
			* Menyelesaikan printer
			*/
			$printer->feed(4);
			$printer->close();

		// akhir print
	}
    
    // 04-11-2020
    public function ambil_total()
    {
        $data 	= [
                   'pendapatan' => ($this->laporan->get_pendapatan()) ? $this->laporan->get_pendapatan() : '0',
                   'transaksi'  => $this->laporan->get_tot_transaksi(),
                   'pengunjung' => ($this->laporan->get_pengunjung()) ? $this->laporan->get_pengunjung() : '0',
                   'tgl'        => date("d-m-Y", now('Asia/Jakarta'))
                  ];

        echo json_encode($data);
    }

    // 04-11-2020
    public function download_file()
    {
        $tgl_awal   	= $this->input->post('tgl_awal');
        $tgl_akhir  	= $this->input->post('tgl_akhir');
        
        $id_user  		= $this->session->userdata('id_user');
        $jns        	= $this->input->post('jns');

		$tot_pendapatan = $this->laporan->get_pendapatan_download($tgl_awal, $tgl_akhir, $id_user);
		$tot_transaksi  = $this->laporan->get_transaksi_download($tgl_awal, $tgl_akhir, $id_user);
		$tot_pengunjung = $this->laporan->get_pengunjung_download($tgl_awal, $tgl_akhir, $id_user);

        $data   = [ 'report'        => 'Report Transaksi',
                    'tgl_awal'      => $tgl_awal,
                    'tgl_akhir'     => $tgl_akhir,
                    'jns'           => $jns,
					'judul'         => 'Report Transaksi',
					'tot_pendapatan'=> ($tot_pendapatan) ? $tot_pendapatan : '0',
                    'tot_pengunjung'=> ($tot_pengunjung) ? $tot_pengunjung : '0',
                    'tot_transaksi' => $tot_transaksi,
                    'trn'        	=> $this->laporan->get_report_transaksi($tgl_awal, $tgl_akhir, $id_user)->result_array()
                  ]; 

        if ($jns == 'excel') {

            $temp = 'template/template_excel';
            $this->template->load("$temp", 'laporan/V_export_transaksi', $data);

        } else {

            ob_start();
            $this->load->view('laporan/V_export_transaksi', $data);
            $html = ob_get_contents();
                ob_end_clean();
				require_once('./assets/html2pdf/html2pdf.class.php');
				
            $pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
			$pdf->WriteHTML($html);
			
			$pdf->Output('LaporanTransaksi.pdf', 'FI');

        } 
        
    }

}

/* End of file Laporan.php */
