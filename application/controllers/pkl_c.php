<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkl_c extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->has_userdata('admin_login')==FALSE) 
			redirect(site_url());
		$this->load->model('m_pkl','pkl');
	}

	public function pkl_ajax_list()
	{
		$list = $this->pkl->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pkl) {
			$no++;
			$row = array();
			$row[] = str_replace(',', ',<br />', $pkl->mhsnama);
			$row[] = $pkl->dosen_nama;
			$row[] = $pkl->loc_nama;
			$row[] = $pkl->pkl_tglawal;
			$row[] = $pkl->pkl_tglakhir;

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$pkl->idkelompok."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$pkl->idkelompok."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->pkl->count_all(),
			"recordsFiltered" => $this->pkl->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function pkl_ajax_edit($id)
	{
		$data = $this->pkl->get_by_id($id);
		echo json_encode($data);
	}

	public function pkl_ajax_add()
	{
		$id = $this->pkl->idPkl($this->input->post('tglawal'));
		$this->_validate();
		$mhsdata = $this->input->post('mhs');
		$data = array();
		for($i = 0; $i < count($mhsdata); $i++)
		{
			$data = array(
				'idkelompok' => $id,
				'mhs_nim' => $mhsdata[$i],
				'dosen_nip' => $this->input->post('dosen'),
				'loc_id' => $this->input->post('lokasi'),
				'pkl_tglawal' => $this->input->post('tglawal'),
				'pkl_tglakhir' => $this->input->post('tglakhir')
			);
			$this->pkl->save($data);
		}
		echo json_encode(array("status" => TRUE));
	}

	public function pkl_ajax_update() {
		$this->_validate();
		$mhsdata = $this->input->post('mhs');
		$data = array();
		$id = $this->input->post('idkelompok');
		$dbnim = $this->pkl->selectnim($id);
		$arrnim = array();

		foreach ($dbnim as $data) { 
			$nim = $data->mhs_nim;
			if (!in_array($nim,$mhsdata)) {
				$this->pkl->delete_by_idnim($id,$nim);
			}
			$arrnim[] = $data->mhs_nim;
		}
		
		for($i = 0; $i < count($mhsdata); $i++) {		
			if (in_array($mhsdata[$i], $arrnim)) {			
				$data = array(
					'dosen_nip' => $this->input->post('dosen'),
					'loc_id' => $this->input->post('lokasi'),
					'pkl_tglawal' => $this->input->post('tglawal'),
					'pkl_tglakhir' => $this->input->post('tglakhir')
				);
				$this->pkl->update($id,$mhsdata[$i],$data);

			} else {
				$data= array(
					'idkelompok' => $id,
					'mhs_nim' => $mhsdata[$i],
					'dosen_nip' => $this->input->post('dosen'),
					'loc_id' => $this->input->post('lokasi'),
					'pkl_tglawal' => $this->input->post('tglawal'),
					'pkl_tglakhir' => $this->input->post('tglakhir')
				);
				$this->pkl->save($data);
			}
		}
		
		echo json_encode(array("status" => TRUE));
	}

	public function pkl_ajax_delete($id)
	{
		$this->pkl->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('mhs') == '')
		{
			$data['inputerror'][] = 'Mahasiswa';
			$data['error_string'][] = 'Mahasiswa is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dosen') == '')
		{
			$data['inputerror'][] = 'Dosen';
			$data['error_string'][] = 'Dosen is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('lokasi') == '')
		{
			$data['inputerror'][] = 'Lokasi';
			$data['error_string'][] = 'Lokasi is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tglawal') == '')
		{
			$data['inputerror'][] = 'Tanggal Awal';
			$data['error_string'][] = 'Tanggal Awal is required';
			$data['status'] = FALSE;
		}
		
		if($this->input->post('tglakhir') == '')
		{
			$data['inputerror'][] = 'Tanggal Selesai';
			$data['error_string'][] = 'Tanggal Selesai is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}