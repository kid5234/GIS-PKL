<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		
	}
	//login rule
	public function auth()
	{
		$userLogin = $this->getUserLogin($this->input->post('identity'));

		if( $userLogin ) 
		{
			if (password_verify($this->input->post('pwd'), $userLogin->pwd) ) 
			{
				$user_session = array(
				 	'admin_login' => TRUE,
				 	'level' => $userLogin->level,
				 	'user' => $userLogin->userid,
				 	'nama' => $userLogin->nama
				);	

				$this->session->set_userdata( $user_session );

				redirect(base_url('dashboard'));
			} else {
				$this->session->set_flashdata('message', 'Kombinasi Username/E-Mail dan Password tidak cocok.');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('message', 'Username/E-Mail tidak terdaftar.');
			redirect(base_url());
		}
	}

	public function getUserLogin($identity = '')
	{
		if (filter_var($identity, FILTER_VALIDATE_EMAIL)) 
		{
			return $this->db->get_where('user', array('email' => $identity))->row();
		} else {
			return $this->db->get_where('user', array('userid' => $identity))->row();
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', 'Anda berhasil keluar.');
		redirect(base_url());
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */