<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pkl extends CI_Model {

	var $table = 'pkl_data';
	var $column_order = array('mhs_nama','dosen_nama','loc_name','pkl_tglawal','pkl_tglakhir'); //set column field database for datatable orderable
	var $column_search = array('mhs_nama','dosen_nama'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('idkelompok' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
				}
				$i++;
			}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$this->db->select('idkelompok, GROUP_CONCAT(mhs_data.mhs_nama) as mhsnama, dosen_data.dosen_nama, loc_data.loc_nama, pkl_tglawal, pkl_tglakhir'); 
		//$this->db->from($this->table);   
		$this->db->join('mhs_data', 'pkl_data.mhs_nim = mhs_data.nim' ,'left');
		$this->db->join('dosen_data', 'pkl_data.dosen_nip = dosen_data.nip', 'left');
		$this->db->join('loc_data', 'pkl_data.loc_id = loc_data.loc_id', 'left');
		$this->db->group_by('idkelompok');
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function getall()
	{
		$this->db->from($this->table);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_id($id)
	{
		$this->db->select('idkelompok, GROUP_CONCAT(mhs_nim) as mhsnim, dosen_nip, loc_id, pkl_tglawal, pkl_tglakhir');
		$this->db->from($this->table);
		$this->db->where('idkelompok',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function selectnim($id)
	{
		$this->db->select('mhs_nim');
		$this->db->where('idkelompok', $id);
		$q = $this->db->get($this->table);
		return $q->result();
	}

	public function update($id, $nim,  $data)
	{
		$this->db->where('idkelompok', $id);
		$this->db->where('mhs_nim', $nim);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('idkelompok', $id);
		$this->db->delete($this->table);
	}	

	public function delete_by_idnim($id,$nim)
	{
		$this->db->where('idkelompok', $id);
		$this->db->where('mhs_nim', $nim);
		$this->db->delete($this->table);
	}

	public function idPkl($string)
	{
		$q = $this->db->query("select MAX(RIGHT(idkelompok,4)) as idpkl, DATE_FORMAT(pkl_tglawal, '%y') as tglawal from pkl_data");
		$tgl = date('y', strtotime($string));
		$kd = "0001";
		
		foreach($q->result() as $k)
		{	
			$tglawal = $k->tglawal;				
			if ($tgl==$tglawal){
				$id=$k->idpkl;
					if ($kd!=$id){
						$tmp = ((int)$id+1);
						$kd = sprintf("%04s", $tmp);
				}
			}				
		return "PKL-".$tgl."-".$kd;
		}			
	}
}
