<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('username') != null)
        {
            redirect('Dashboard');
        }
        else
        {
			$data = [
				'title'	=> 'Log In'
			];
			$this->load->view('V_login', $data);
		}
	}

	public function cek()
	{
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$jumlah 	= $this->user->get_user()->num_rows();
		if($jumlah > 0)
		{
			$user 	= $this->user->cek_user($username);
			if($user != null)
			{
				if(password_verify($password, $user->pass))
				{

					$array = array(
						'id_user'		=> $user->id,
						'username' 		=> $user->username,
						'role'			=> $user->id_role,
						'id_owner'		=> $user->id_owner
					);
					
					$this->session->set_userdata( $array );

	                echo json_encode(['status' => 1, 'pesan' => 'Berhasil']);
				}
				else
				{
					echo json_encode(['status' => 2, 'pesan' => 'Password Salah']);
				}
			}
			else
			{
				echo json_encode(['status' => 0, 'pesan' => 'Username Tidak Ditemukan']);
			}
		}
	}

	public function out()
	{
		$this->session->sess_destroy();
		redirect('Auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */