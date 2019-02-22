<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loc_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());
		$this->load->model('m_loc','loc');
	}

	public function index()
	{
		# code...
	}

	public function loc_ajax_list()
	{
		$list = $this->loc->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $loc) {
			$no++;
			$row = array();
			$row[] = $loc->loc_id;
			$row[] = $loc->loc_nama;
			$row[] = $loc->loc_alamat;
			$row[] = $loc->loc_category_id;
			$row[] = $loc->loc_prov_id;
			$row[] = $loc->loc_reg_id;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$loc->loc_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$loc->loc_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->loc->count_all(),
			"recordsFiltered" => $this->loc->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function loc_ajax_edit($id)
	{
		$data = $this->loc->get_by_id($id);
		echo json_encode($data);
	}

	public function loc_ajax_add()
	{
		$this->_validate();
		$data = array(
			'loc_id' => $this->input->post('placeid'),
			'loc_nama' => $this->input->post('nama'),
			'loc_alamat' => $this->input->post('alamat'),
			'loc_notelp' => $this->input->post('telepon'),
			'loc_category_id' => $this->input->post('jenis'),
			'loc_prov_id' => $this->input->post('prov'),
			'loc_reg_id' => $this->input->post('kota'),
			'loc_lat' => $this->input->post('lat'),
			'loc_lang' => $this->input->post('lng')
		);
		$insert = $this->loc->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function loc_ajax_update()
	{
		$this->_validate();
		$data = array(
			'loc_id' => $this->input->post('placeid'),
			'loc_nama' => $this->input->post('nama'),
			'loc_alamat' => $this->input->post('alamat'),
			'loc_notelp' => $this->input->post('telepon'),
			'loc_category_id' => $this->input->post('jenis'),
			'loc_prov_id' => $this->input->post('prov'),
			'loc_reg_id' => $this->input->post('kota'),
			'loc_lat' => $this->input->post('lat'),
			'loc_lang' => $this->input->post('lng')
		);
		$this->loc->update(array('loc_id' => $this->input->post('placeid')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function loc_ajax_delete($id)
	{
		$this->loc->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('placeid') == '')
		{
			$data['inputerror'][] = 'placeid';
			$data['error_string'][] = 'Place ID is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('prov') == '')
		{
			$data['inputerror'][] = 'prov';
			$data['error_string'][] = 'Provinsi is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('kota') == '')
		{
			$data['inputerror'][] = 'kota';
			$data['error_string'][] = 'Kota is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('jenis') == '')
		{
			$data['inputerror'][] = 'jenis';
			$data['error_string'][] = 'Jenis is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lat') == '')
		{
			$data['inputerror'][] = 'lat';
			$data['error_string'][] = 'Latitude is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('lng') == '')
		{
			$data['inputerror'][] = 'lng';
			$data['error_string'][] = 'Longitude is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}