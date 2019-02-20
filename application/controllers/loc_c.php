<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loc_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
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
			$row[] = $loc->nip;
			$row[] = $loc->loc_nama;
			$row[] = $loc->loc_alamat;
			$row[] = $loc->loc_notelp;
			$row[] = $loc->loc_jabatan;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$loc->nip."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$loc->nip."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

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
			'nip' => $this->input->post('nip'),
			'loc_nama' => $this->input->post('nama'),
			'loc_alamat' => $this->input->post('alamat'),
			'loc_notelp' => $this->input->post('telepon'),
			'loc_jabatan' => $this->input->post('jabatan'),
		);
		$insert = $this->loc->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function loc_ajax_update()
	{
		$this->_validate();
		$data = array(
			'nip' => $this->input->post('nip'),
			'loc_nama' => $this->input->post('nama'),
			'loc_alamat' => $this->input->post('alamat'),
			'loc_notelp' => $this->input->post('notelp'),
			'loc_jabatan' => $this->input->post('jabatan'),
		);
		$this->loc->update(array('nip' => $this->input->post('nip')), $data);
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