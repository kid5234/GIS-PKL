<?php
class M_jenis extends CI_Model {


	public function getall(){
		$q = $this->db->get('loc_category');      
		return $q->result();
	}

	public function getProvinces()
	{
		$this->db->order_by('id');
		$q = $this->db->get('provinces');      
		return $q->result();	
	}

	public function getRegencies($id)
	{
		$this->db->where('province_id',$id);
		$q = $this->db->get('regencies');      
		return $q->result();
	}
	
}