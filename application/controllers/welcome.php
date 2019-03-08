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
		   				//"elementType" => "business", 
		   				"stylers"=> array(
		   					array(
		   						"visibility"=>"off"
		   					)
		   				)
		   			)
		  		)
		  	)
		);
		foreach($this->searchQuery() as $key => $value) :
		$marker = array();
		$marker['position'] = "{$value->loc_lat}, {$value->loc_lang}";
		$marker['animation'] = 'DROP';
		$marker['infowindow_content'] = '<div class="media" style="width:250px;">';
		$marker['infowindow_content'] .= '<div class="media-left">';
		$marker['infowindow_content'] .= '</div>';
		$marker['infowindow_content'] .= '<div class="media-body">';
		$marker['infowindow_content'] .= '<h7 class="media-heading"><b>'.$value->loc_nama.'</b></h7><hr>';
		$marker['infowindow_content'] .= '<p>Jml Mahasiswa PKL : <strong>'.number_format($value->mhs).'</strong></p>';
		//$marker['infowindow_content'] .= '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore tempora nihil doloremque saepe eos natus incidunt minus voluptatum consequatur maiores!</p>';
		$marker['infowindow_content'] .= '</div>';
		$marker['infowindow_content'] .= '</div>';
		$this->googlemaps->add_marker($marker);
		endforeach;
		$this->googlemaps->initialize($config);
		$this->data['map'] = $this->googlemaps->create_map();
		$this->load->view('homepage', $this->data);
	}

	//get DB_RESULT into json
	public function getjenis(){
		$data = $this->m_jenis->getall();
		echo json_encode($data);
	}

	public function searchQuery()
	{
		$this->db->select('idkelompok, COUNT(m.mhs_nama) as mhs, l.loc_nama, j.loc_category_id, pkl_tglawal, pkl_tglakhir, l.loc_lat, l.loc_lang');
		$this->db->join('loc_data l', 'pkl_data.loc_id = l.loc_id', 'left');
		$this->db->join('mhs_data m', 'pkl_data.mhs_nim = m.nim', 'left');
		$this->db->join('loc_category j', 'l.loc_category_id = j.loc_category_id', 'left');

		$this->db->group_by('l.loc_nama');

		$tipe =  $this->input->get('listtype');
		if (!empty($tipe)){
		$this->db->where('l.loc_category_id', $this->input->get('listtype'));
		}

		$this->db->where('l.loc_lat !=', NULL)
				 ->where('l.loc_lang !=', NULL);
		$q = $this->db->get("pkl_data");
		//print_r($tipe);
		return $q->result();
	}
}

/* End of file Welcome.php */
/* Location: ./application/controllers/Welcome.php */
