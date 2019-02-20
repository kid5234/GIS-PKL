<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{
	public $page;
	public function __construct()
	{
		parent::__construct();

		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());
		$this->load->model('m_jenis');
		$this->page = $this->input->get('page');
	}

	public function index()
	{
		$this->data = array(
			'title' => "PKL GIS: Dashboard"
		);	

		$this->load->view('pages/main-index', $this->data);
	}

	public function location()
	{
		$this->data = array(
			'title' => "PKL GIS: Location"
		);	

		$this->load->view('pages/main-index', $this->data);

	}	

	public function addlocation()
	{
		$this->data = array(
			'title' => "PKL GIS: Location"
		);
		//$marker = array();
		//$marker['draggable'] = true;
		//$marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
		//$config['center'] = '-0.4959538,117.1562388';
		//$config['zoom'] = 'auto';
		//$config['places'] = TRUE;
		//$config['placesAutocompleteInputID'] = 'pac-input';
		//$config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
		//$config['placesAutocompleteOnChange'] = "";
        //$this->googlemaps->add_marker($marker);
		//$this->googlemaps->initialize($config);
		//$this->data['map'] = $this->googlemaps->create_map();

		$this->data['province'] = $this->m_jenis->getProvinces();
		$this->data['jenis'] = $this->m_jenis->getall();

		$this->load->view('pages/loc_add_content', $this->data);

	}

	public function mahasiswa()
	{
		$this->data = array(
			'title' => "PKL GIS: Mahasiswa"
		);	

		$this->load->view('pages/mahasiswa-content', $this->data);

	}

	public function dosen()
	{
		$this->data = array(
			'title' => "PKL GIS: Dosen"
		);	

		$this->load->view('pages/dosen-content', $this->data);

	}
	
	public function pkl()
	{
		$this->data = array(
			'title' => "pages/PKL GIS: PKL"
		);	

		$this->load->view('pages/main-index', $this->data);
	}

	public function addpkl()
	{
		$this->data = array(
			'title' => "pages/PKL GIS: PKL"
		);	

		$this->load->view('pages/pkl_add_content', $this->data);
	}

	public function getreg($id){
		$data = $this->m_jenis->getRegencies($id);
		echo json_encode($data);
	}

	public function account()
	{
		$this->data = array(
			'title' => "Pengaturan Akun",
			'user' => $this->madmin->getAccount()
		);	
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('email', 'E-Mail', 'trim|valid_email|required');
		$this->form_validation->set_rules('new_pass', 'Password Baru', 'trim|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('old_pass', 'Password Lama', 'trim|required|callback_validate_password');
		if ($this->form_validation->run() == TRUE) 
		{
			$this->madmin->setAccount();
			
			redirect(current_url());
		}
		$this->load->view('account', $this->data);
	}

	/**
	 * Cek kebenaran password
	 *
	 * @return Boolean
	 **/
	public function validate_password()
	{
		$user = $this->madmin->getAccount();

		if(password_verify($this->input->post('old_pass'), $user->password))
		{
			return true;
		} else {
			$this->form_validation->set_message('validate_password', 'Password lama anda tidak cocok!');
			return false;
		}
	}
	
	
}
