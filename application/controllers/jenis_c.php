<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());
		$this->load->model('m_jenis','jenis');
	}

	public function jenis_ajax_list()
	{
		$list = $this->jenis->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $jenis) {
			$no++;
			$row = array();
			$row[] = $jenis->loc_category_id;
			$row[] = $jenis->loc_category_name;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$jenis->loc_category_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$jenis->loc_category_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->jenis->count_all(),
			"recordsFiltered" => $this->jenis->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function jenis_ajax_edit($id)
	{
		$data = $this->jenis->get_by_id($id);
		echo json_encode($data);
	}

	public function jenis_ajax_add()
	{
		$this->_validate();
		$data = array(
			'loc_category_id' => $this->input->post('id'),
			'loc_category_name' => $this->input->post('nama'),
		);
		$insert = $this->jenis->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function jenis_ajax_update()
	{
		$this->_validate();
		$data = array(
			'loc_category_id' => $this->input->post('id'),
			'loc_category_name' => $this->input->post('nama'),

		);
		$this->jenis->update(array('loc_category_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function jenis_ajax_delete($id)
	{
		$this->jenis->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}