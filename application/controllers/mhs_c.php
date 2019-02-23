<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhs_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());
		$this->load->model('m_mhs','mhs');
	}

	public function mhs_ajax_list()
	{
		$list = $this->mhs->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $mhs) {
			$no++;
			$row = array();
			$row[] = $mhs->nim;
			$row[] = $mhs->mhs_nama;
			$row[] = $mhs->mhs_alamat;
			$row[] = $mhs->mhs_notelp;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$mhs->nim."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$mhs->nim."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->mhs->count_all(),
			"recordsFiltered" => $this->mhs->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function mhs_ajax_edit($id)
	{
		$data = $this->mhs->get_by_id($id);
		echo json_encode($data);
	}

	public function mhs_ajax_add()
	{
		$this->_validate();
		$data = array(
			'nim' => $this->input->post('nim'),
			'mhs_nama' => $this->input->post('nama'),
			'mhs_alamat' => $this->input->post('alamat'),
			'mhs_notelp' => $this->input->post('telepon'),
		);
		$insert = $this->mhs->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function mhs_ajax_update()
	{
		$this->_validate();
		$data = array(
			'nim' => $this->input->post('nim'),
			'mhs_nama' => $this->input->post('nama'),
			'mhs_alamat' => $this->input->post('alamat'),
			'mhs_notelp' => $this->input->post('telepon'),
		);
		$this->mhs->update(array('nim' => $this->input->post('nim')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function mhs_ajax_delete($id)
	{
		$this->mhs->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nim') == '')
		{
			$data['inputerror'][] = 'nim';
			$data['error_string'][] = 'NIM is required';
			$data['status'] = FALSE;
		}

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