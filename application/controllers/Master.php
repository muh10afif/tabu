<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

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
        $this->setting();
    }

    // 28-10-2020
    public function setting()
    {
        $data 	= ['title'  => 'Setting',
                   'set'    => $this->master->get_data_order('mst_setting', '', '')->row_array()
                  ];

        $this->template->load('template/index','master/seting/lihat', $data);
    }

    // 02-11-2020
    public function ambil_data_setting($id_setting)
    {
        $data = $this->master->cari_data('mst_setting', ['id' => $id_setting])->row_array();

        echo json_encode($data);
    }

    // 02-11-2020
    public function simpan_data_setting()
    {
        $p = $this->input->post();

        $data = ['harga'    => str_replace('.','',$p['harga']),
                 'no_telp'  => $p['no_telp'],
                 'alamat'   => $p['alamat'],
                 'judul'    => $p['judul']
                ];
        
        $this->master->ubah_data('mst_setting', $data, ['id' => $p['id_setting']]);

        echo json_encode(['status' => true]);
    }

    // 28-10-2020
    public function hari_besar()
    {
        $data 	= ['title'  => 'Judul Hari Besar'
                  ];

        $this->template->load('template/index','master/hari_besar/lihat', $data);
    }

    // 02-11-2020
    // menampilkan list hari_besar 
    public function tampil_data_hari_besar()
    {
        $list = $this->master->get_data_hari_besar();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = date('d-M-Y', strtotime($o['tgl_awal']));
            $tbody[]    = date('d-M-Y', strtotime($o['tgl_akhir']));
            $tbody[]    = $o['judul'];
            $tbody[]    = "<button class='btn btn-success btn-sm mr-2 edit-hari-besar' data-id='".$o['id']."'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btn-sm hapus-hari-besar' data-id='".$o['id']."'><i class='fas fa-trash'></i></button>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->master->jumlah_semua_hari_besar(),
                    "recordsFiltered"  => $this->master->jumlah_filter_hari_besar(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 02-11-2020
    public function simpan_data_hari_besar()
    {
        $p = $this->input->post();

        $data = ['tgl_awal'     => date("Y-m-d", strtotime($p['tgl_awal'])),
                 'tgl_akhir'    => date("Y-m-d", strtotime($p['tgl_akhir'])),
                 'judul'        => $p['judul'],
                 'created_at'   => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        if ($p['aksi'] == 'tambah') {
            $this->master->input_data('mst_hari_besar', $data);
        } elseif ($p['aksi'] == 'ubah') {
            $this->master->ubah_data('mst_hari_besar', $data, ['id' => $p['id_hari_besar']]);
        } else {
            $this->master->hapus_data('mst_hari_besar', ['id' => $p['id_hari_besar']]);
        }

        echo json_encode(['status' => true]);
    }

    // 02-11-2020
    public function ambil_data_hari_besar($id)
    {
        $dt = $this->master->cari_data('mst_hari_besar', ['id' => $id])->row_array();

        // $data = ['tgl_awal'     => $dt['tgl_awal'],
        //          'tgl_akhir'    => date("d-m-Y", strtotime($dt['tgl_akhir'])),
        //          'judul'        => $dt['judul'],
        //          'id'           => $dt['id']
        //         ];

        echo json_encode($dt);
    }

    // 28-10-2020
    public function kategori()
    {
        $data 	= ['title'  => 'Kategori'
                  ];

        $this->template->load('template/index','master/kategori/lihat', $data);
    }

    // 28-10-2020
    public function grup_pengunjung()
    {
        $data 	= ['title'  => 'Grup Pengunjung'
                  ];

        $this->template->load('template/index','master/grup_pengunjung/lihat', $data);
    }


}

/* End of file Master.php */
