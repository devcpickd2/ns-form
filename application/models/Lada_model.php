<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Lada_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'date',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'shift',
				'label' => 'Shift',
				'rules' => 'required'
			],
			[
				'field' => 'pukul',
				'label' => 'Times',
				'rules' => 'required'
			],
			[
				'field' => 'kode_produksi',
				'label' => 'Product Code',
				'rules' => 'required'
			],
			[
				'field' => 'suhu_produk',
				'label' => 'Product Temperature',
				'rules' => 'required'
			],
			[
				'field' => 'hasil_giling',
				'label' => 'Result of milled',
				'rules' => 'required'
			],
			[
				'field' => 'kadar_air',
				'label' => 'Water Content',
				'rules' => 'required'
			],
			[
				'field' => 'keterangan',
				'label' => 'Notes'
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
		$produksi_input = $this->session->userdata('produksi_input');
		$nama_produksi = $produksi_input['nama_produksi'] ?? null;
		$username = $this->session->userdata('username');
		$plant = $this->session->userdata('plant');
		$date = $this->input->post('date');
		$shift = $this->input->post('shift');
		$pukul = $this->input->post('pukul');
		$kode_produksi = $this->input->post('kode_produksi');
		$suhu_produk = $this->input->post('suhu_produk');
		$hasil_giling = $this->input->post('hasil_giling');
		$kadar_air = $this->input->post('kadar_air');
		$keterangan = $this->input->post('keterangan');
		$catatan = $this->input->post('catatan');
		$status_spv = "0";
		$status_produksi = "1";

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'plant' => $plant,
			'date' => $date,
			'shift' => $shift,
			'pukul' => $pukul,
			'kode_produksi' => $kode_produksi,
			'suhu_produk' => $suhu_produk,
			'hasil_giling' => $hasil_giling,
			'kadar_air' => $kadar_air,
			'keterangan' => $keterangan,
			'catatan' => $catatan,
			'status_produksi' => $status_produksi,
			'nama_produksi' => $nama_produksi,
			'status_spv' => $status_spv
		);

		$this->db->insert('lada', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{
		$username = $this->session->userdata('username');
		$date = $this->input->post('date');
		$shift = $this->input->post('shift');
		$pukul = $this->input->post('pukul');
		$kode_produksi = $this->input->post('kode_produksi');
		$suhu_produk = $this->input->post('suhu_produk');
		$hasil_giling = $this->input->post('hasil_giling');
		$kadar_air = $this->input->post('kadar_air');
		$keterangan = $this->input->post('keterangan');
		$catatan = $this->input->post('catatan');

		$data = array(
			'username' => $username,
			'date' => $date,
			'shift' => $shift,
			'pukul' => $pukul,
			'kode_produksi' => $kode_produksi,
			'suhu_produk' => $suhu_produk,
			'hasil_giling' => $hasil_giling,
			'kadar_air' => $kadar_air,
			'keterangan' => $keterangan,
			'catatan' => $catatan,

			'modified_at' => date("Y-m-d H:i:s") 
		);

		$this->db->update('lada', $data, array('uuid' => $uuid));
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

		$this->db->update('lada', $data, array('uuid' => $uuid));
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

		$this->db->update('lada', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC');
		$data = $this->db->get('lada')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('lada', array('uuid' => $uuid))->row();
		return $data;
	}

	public function get_by_uuid_lada($uuid_array)
	{
		if (empty($uuid_array)) {
			return false; 
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('lada');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_lada_verif($uuid_array)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, shift, nama_produksi, tgl_update_produksi, status_produksi');
		$this->db->where_in('uuid', $uuid_array);
		$this->db->order_by('tgl_update_spv', 'DESC');   
		$this->db->limit(1);  
		$query = $this->db->get('lada');

		$data_lada = $query->row();  
		return $data_lada; 
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('lada', ['plant' => $plant])->result();
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('lada');
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
		$query = $this->db->get('lada');

		log_message('debug', 'Query get_by_date: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}

	public function get_last_verif_by_date($tanggal, $plant = null)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, shift, nama_produksi, tgl_update_produksi, status_produksi');
		$this->db->where('DATE(date)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('plant', $plant); 
		}

		$this->db->order_by('tgl_update_spv', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('lada');

		return $query->row();
	}
}