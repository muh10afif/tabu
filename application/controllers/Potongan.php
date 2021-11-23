<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Potongan extends CI_Controller {

    // 28-10-2020
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
        $this->kupon();
    }

    // 28-10-2020
    public function kupon()
    {
        $data 	= ['title'  => 'Kupon'
                  ];

        $this->template->load('template/index','potongan/kupon/lihat', $data);
    }

}

/* End of file Potongan.php */
