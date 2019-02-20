<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{  
		parent::__construct();  
		$this->load->model('m_jenis');
	}
	
	//index function
	public function index()
	{
		$this->data['title'] = "SIGPKL";
		$config['center'] = '-0.4959538,117.1562388';
		$config['zoom'] = 'auto';
		$config['styles'] = array(
			array(
				"name"=>"No Businesses", 
				"definition"=> array(
					array(
						"featureType"=>"poi", 
						"elementType" => 
						"business", 
						"stylers"=> array(
							array(
								"visibility"=>"off"
							)
						)
					)
				)
			)
		);
		$this->googlemaps->initialize($config);
		$this->data['map'] = $this->googlemaps->create_map();
		$this->load->view('homepage', $this->data);
	}

	//get DB_RESULT into json
	public function getjenis(){
		$data = $this->m_jenis->getall();
		echo json_encode($data);
	}
}

/* End of file Welcome.php */
/* Location: ./application/controllers/Welcome.php */
