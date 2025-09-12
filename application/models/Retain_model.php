<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Retain_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'date',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'plant',
				'label' => 'Plant',
				'rules' => 'required'
			], 
			[
				'field' => 'sample_type',
				'label' => 'Type of Sample',
				'rules' => 'required'
			], 
			[
				'field' => 'sample_storage',
				'label' => 'Storage of Sample',
				'rules' => 'required'
			],
			[
				'field' => 'deskripsi',
				'label' => 'Description',
				'rules' => 'required'
			], 
			[
				'field' => 'kode_produksi',
				'label' => 'Product Code',
				'rules' => 'required'
			],  
			[
				'field' => 'best_before',
				'label' => 'Best Before',
				'rules' => 'required'
			], 
			[
				'field' => 'quantity',
				'label' => 'Quantity (Gr)',
				'rules' => 'required'
			], 
			[
				'field' => 'remark',
				'label' => 'Remark'
			], 
			[
				'field' => 'catatan',
				'label' => 'Notes'
			]
		];
	}

	public function insert()
	{
		$uuid = Uuid::uuid4()->toString();
		$username = $this->session->userdata('username');
		$plant = $this->session->userdata('plant');
		$date = $this->input->post('date');
		$plant = $this->input->post('plant');
		$sample_type = $this->input->post('sample_type');
		$sample_storage = $this->input->post('sample_storage');
		$deskripsi = $this->input->post('deskripsi');
		$kode_produksi = $this->input->post('kode_produksi');
		$best_before = $this->input->post('best_before');
		$quantity = $this->input->post('quantity');
		$remark = $this->input->post('remark');		
		$catatan = $this->input->post('catatan');
		$status_spv = "0";

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'plant' => $plant,
			'date' => $date,
			'plant' => $plant,
			'sample_type' => $sample_type,
			'sample_storage' => $sample_storage,
			'deskripsi' => $deskripsi,
			'kode_produksi' => $kode_produksi,
			'best_before' => $best_before,
			'quantity' => $quantity,
			'remark' => $remark,
			'catatan' => $catatan,
			'status_spv' => $status_spv
		);

		$this->db->insert('retain', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{
		$username = $this->session->userdata('username');
		$date = $this->input->post('date');
		$plant = $this->input->post('plant');
		$sample_type = $this->input->post('sample_type');
		$sample_storage = $this->input->post('sample_storage');
		$deskripsi = $this->input->post('deskripsi');
		$kode_produksi = $this->input->post('kode_produksi');
		$best_before = $this->input->post('best_before');
		$quantity = $this->input->post('quantity');
		$remark = $this->input->post('remark');		
		$catatan = $this->input->post('catatan');

		$data = array(
			'username' => $username,
			'date' => $date,
			'plant' => $plant,
			'sample_type' => $sample_type,
			'sample_storage' => $sample_storage,
			'deskripsi' => $deskripsi,
			'kode_produksi' => $kode_produksi,
			'best_before' => $best_before,
			'quantity' => $quantity,
			'remark' => $remark,
			'catatan' => $catatan,

			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->update('retain', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function rules_verifikasi()
	{
		return[
			[
				'field' => 'status_spv',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'catatan_spv',
				'label' => 'Notes'
			]
			
		];
	}

	public function verifikasi_update($uuid)
	{

		$nama_spv = $this->session->userdata('username');
		$status_spv = $this->input->post('status_spv');
		$catatan_spv = $this->input->post('catatan_spv');

		$data = array(
			'nama_spv' => $nama_spv,
			'status_spv' => $status_spv,
			'catatan_spv' => $catatan_spv,
			'tgl_update_spv' => date("Y-m-d H:i:s")
		);

		$this->db->update('retain', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function rules_diketahui()
	{
		return[
			[
				'field' => 'status_produksi',
				'label' => 'Status',
				'rules' => 'required'
			],
			[
				'field' => 'catatan_produksi',
				'label' => 'Notes'
			]
			
		];
	}


	public function diketahui_update($uuid)
	{

		$nama_produksi = $this->session->userdata('username');
		$status_produksi = $this->input->post('status_produksi');
		$catatan_produksi = $this->input->post('catatan_produksi');

		$data = array(
			'nama_produksi' => $nama_produksi,
			'status_produksi' => $status_produksi,
			'catatan_produksi' => $catatan_produksi,
			'tgl_update_produksi' => date("Y-m-d H:i:s")
		);

		$this->db->update('retain', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}
	
	public function get_all()
	{
		$this->db->order_by('a.created_at', 'DESC');
		$this->db->select('a.*, b.plant');
		$this->db->from('retain a');
		$this->db->join('plant b', 'a.plant=b.uuid', 'left');

		$data = $this->db->get()->result();

		return $data;
	}

	public function get_retain_with_plant($uuid)
	{
		$this->db->select('retain.*, plant.plant');
		$this->db->from('retain');
		$this->db->join('plant', 'plant.uuid = retain.plant', 'left');
		$this->db->where('retain.uuid', $uuid);
		return $this->db->get()->row();
	}

	public function get_plant($uuid) {
		$this->db->where('plant', $uuid);
		$query = $this->db->get('retain');
		return $query->result_array();
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('retain', array('uuid' => $uuid))->row();
		return $data;
	}

	public function get_by_uuid_retain($uuid_array)
	{
		if (empty($uuid_array)) {
			return false; 
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('retain');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_retain_verif($uuid_array)
	{
		$this->db->select('retain.nama_spv, retain.tgl_update_spv, retain.username, retain.date, plant.plant AS plant, retain.sample_type, retain.sample_storage');
		$this->db->from('retain');
		$this->db->join('plant', 'plant.uuid = retain.plant', 'left');
		$this->db->where_in('retain.uuid', $uuid_array);
		$this->db->order_by('retain.tgl_update_spv', 'DESC');   
		$this->db->limit(1);  
		$query = $this->db->get();

		return $query->row(); 
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('a.created_at', 'DESC');
		$this->db->select('a.*, b.plant AS nama_plant'); 
		$this->db->from('retain a');
		$this->db->join('plant b', 'a.plant = b.uuid', 'left');

		$plant = $this->session->userdata('plant');
		$this->db->where('a.plant', $plant); 

		return $this->db->get()->result();
	}
	
	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('retain');
	}

	public function get_by_date($tanggal, $plant = null) 
	{
		if (empty($tanggal)) {
			return false;
		}

		$this->db->where('DATE(date)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('plant', $plant); 
		}

		$this->db->order_by('date', 'ASC');
		$query = $this->db->get('retain');

		log_message('debug', 'Query get_by_date: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}

	public function get_last_verif_by_date($tanggal, $plant = null)
	{
		$this->db->select('r.nama_spv, r.tgl_update_spv, r.username, r.date, r.plant AS plant_uuid, p.plant AS nama_plant, r.sample_type, r.sample_storage');
		$this->db->from('retain r');
		$this->db->join('plant p', 'r.plant = p.uuid', 'left');

		$this->db->where('DATE(r.date)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('r.plant', $plant); 
		}

		$this->db->order_by('r.tgl_update_spv', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row();
	}


}