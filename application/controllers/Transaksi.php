<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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
    // 03-11-2020
    public function index()
    {
        $default_tanggal	= date('dmy', now('Asia/Jakarta'));
        $id_user            = $this->session->userdata('id_user');

        $transaksi          = $this->transaksi->cari_data_kd_tr('trn_transaksi', ['id_user' => $id_user])->row_array();

		$bagian_tanggal 	= substr($transaksi['kode_transaksi'], 3, 6);
		$bagian_urutan 		= substr($transaksi['kode_transaksi'], 9, 7);
		
		if($default_tanggal == $bagian_tanggal)
		{
			$kode = $bagian_urutan + 1;
		}
		else
		{
			$kode = '1';
		}

		$generated_code		= str_pad($kode, 5, '0', STR_PAD_LEFT);
        $kode_transaksi		= "TRN$default_tanggal$generated_code";

        // cari judul setting
        $jd = $this->master->cari_data('mst_setting', ['id' => 1])->row_array();
        
        $data 	= ['title'      => 'Transaksi',
                   'harga'      => $this->transaksi->get_harga(),
                   'jml_p'      => $this->transaksi->get_jml_pengunjung(),
                   'kode_tr'    => $kode_transaksi,
                   'judul_set'  => $jd['judul'],
                   'judul_hb'   => $this->judul_hb()    
                  ];

        $this->template->load('template/index','transaksi/lihat', $data);
    }

    // 06-11-2020
    public function ambil_kode_tr()
    {
        $default_tanggal	= date('dmy', now('Asia/Jakarta'));
        $id_user            = $this->session->userdata('id_user');

        $transaksi          = $this->transaksi->cari_data_kd_tr('trn_transaksi', ['id_user' => $id_user])->row_array();

		$bagian_tanggal 	= substr($transaksi['kode_transaksi'], 3, 6);
		$bagian_urutan 		= substr($transaksi['kode_transaksi'], 9, 7);
		
		if($default_tanggal == $bagian_tanggal)
		{
			$kode = $bagian_urutan + 1;
		}
		else
		{
			$kode = '1';
		}

		$generated_code		= str_pad($kode, 5, '0', STR_PAD_LEFT);
        $kode_transaksi		= "TRN$default_tanggal$generated_code";

        echo json_encode(['kode_tr' => $kode_transaksi]);
    }

    // 06-11-2020
    public function judul_hb()
    {
        $tgl_today  = date('Y-m-d', now('Asia/Jakarta'));
        // $tgl_today  = "2020-05-24";
        // $tgl_awal   = "2020-11-01";
        // $tgl_akhir  = "2020-11-05";

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
    public function simpan_transaksi()
    {
        $post = $this->input->post();

        // $this->cetak_transaksi($post);

		$this->fun_simpan_transaksi($post);

        echo json_encode(['status' => true]);
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
    public function cetak_transaksi($post)
	{
		$harga      = $post['harga'];
        $jml_p      = $post['jml_p'];
        $kode_tr    = $post['kode_tr'];
        $judul_set  = $post['judul_set'];
        $judul_hb   = $post['judul_hb'];
        $tgl        = date("d/m/Y H:i", now('Asia/Jakarta'));

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
			$ms_ber = sprintf('%1$-15s %2$-16s','Masa Berlaku', ": ".date("d/m/Y", now('Asia/Jakarta')));
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

			$this->fun_simpan_transaksi($post);

			/* ---------------------------------------------------------
			* Menyelesaikan printer
			*/
			$printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
			$printer->close();

		// akhir print
	}

    // 03-11-2020
    public function fun_simpan_transaksi($post)
    {
        $total              = $post['total'];
        $diskon             = ($post['diskon']) ? $post['diskon'] : '0';
        $tunai              = $post['tunai'];
        $jml_p              = $post['jml_p'];
        $kode_tr            = $post['kode_tr'];
        $default_tanggal	= date('dmy', now('Asia/Jakarta'));

        $id_user    = $this->session->userdata('id_user');

        // $transaksi  = $this->transaksi->cari_data_kd_tr('trn_transaksi', ['id_user' => $id_user])->row_array();

		// $bagian_tanggal 	= substr($transaksi['kode_transaksi'], 3, 6);
		// $bagian_urutan 		= substr($transaksi['kode_transaksi'], 9, 7);
		
		// if($default_tanggal == $bagian_tanggal)
		// {
		// 	$kode = $bagian_urutan + 1;
		// }
		// else
		// {
		// 	$kode = '1';
		// }

		// $generated_code		= str_pad($kode, 5, '0', STR_PAD_LEFT);
		// $kode_transaksi		= "TRN$default_tanggal$generated_code";

        $data = ['kode_transaksi'   => $kode_tr,
                 'total_transaksi'  => $total,
                 'total_discount'   => $diskon,
                 'jml_pengunjung'   => $jml_p,
                 'tunai'            => $tunai,
                 'id_user'          => $id_user,
                 'created_by'       => $this->session->userdata('id_user'),
                 'created_at'       => date("Y-m-d H:i:s", now('Asia/Jakarta'))  
                ];

        $this->master->input_data('trn_transaksi', $data);
        
        return $kode_tr;
    }

    // 06-11-2020
    

}

/* End of file Transaksi.php */
