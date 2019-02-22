<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkl_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());
		$this->load->model('m_dosen','dosen');
	}

	public function index()
	{
		# code...
	}

	public function dosen_ajax_list()
	{
		$list = $this->dosen->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $dosen) {
			$no++;
			$row = array();
			$row[] = $dosen->nip;
			$row[] = $dosen->dosen_nama;
			$row[] = $dosen->dosen_alamat;
			$row[] = $dosen->dosen_notelp;
			$row[] = $dosen->dosen_jabatan;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$dosen->nip."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$dosen->nip."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->dosen->count_all(),
			"recordsFiltered" => $this->dosen->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function dosen_ajax_edit($id)
	{
		$data = $this->dosen->get_by_id($id);
		echo json_encode($data);
	}

	public function dosen_ajax_add()
	{
		$this->_validate();
		$data = array(
			'nip' => $this->input->post('nip'),
			'dosen_nama' => $this->input->post('nama'),
			'dosen_alamat' => $this->input->post('alamat'),
			'dosen_notelp' => $this->input->post('telepon'),
			'dosen_jabatan' => $this->input->post('jabatan'),
		);
		$insert = $this->dosen->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function dosen_ajax_update()
	{
		$this->_validate();
		$data = array(
			'nip' => $this->input->post('nip'),
			'dosen_nama' => $this->input->post('nama'),
			'dosen_alamat' => $this->input->post('alamat'),
			'dosen_notelp' => $this->input->post('notelp'),
			'dosen_jabatan' => $this->input->post('jabatan'),
		);
		$this->dosen->update(array('nip' => $this->input->post('nip')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function dosen_ajax_delete($id)
	{
		$this->dosen->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nip') == '')
		{
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP is required';
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