<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Kebersihanruang_model extends CI_Model {

	protected $table = 'kebersihan_ruang';
	
	public function rules()
	{
		return [
			[
				'field' => 'date',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'shift',
				'label' => 'Shift'
			],
			[
				'field' => 'lokasi',
				'label' => 'Location',
				'rules' => 'required'
			],
			[
				'field' => 'bagian[]',
				'label' => 'Part'
			],
			[
				'field' => 'kondisi[]',
				'label' => 'Condition'
			],
			[
				'field' => 'problem[]',
				'label' => 'Problem'
			],
			[
				'field' => 'tindakan[]',
				'label' => 'Corrective Action'
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
		$lokasi = $this->input->post('lokasi');

		$bagian = $this->input->post('bagian');
		$kondisi = $this->input->post('kondisi');
		$problem = $this->input->post('problem');
		$tindakan = $this->input->post('tindakan');

		$detail = [];
		for ($i = 0; $i < count($bagian); $i++) {
			$detail[] = [
				'bagian' => $bagian[$i],
				'kondisi' => isset($kondisi[$i]) ? $kondisi[$i] : '',
				'problem' => isset($problem[$i]) ? $problem[$i] : '',
				'tindakan' => isset($tindakan[$i]) ? $tindakan[$i] : '',
			];
		}

		$status_spv = "0";
		$status_produksi = "1";

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'plant' => $plant,
			'date' => $date,
			'shift' => $shift,
			'lokasi' => $lokasi,
			'detail' => json_encode($detail), 
			'status_produksi' => $status_produksi, 
			'nama_produksi' => $nama_produksi,
			'status_spv' => $status_spv,
			'created_at' => date("Y-m-d H:i:s"),
			'modified_at' => date("Y-m-d H:i:s")
		);

		$this->db->insert('kebersihan_ruang', $data);
		return ($this->db->affected_rows() > 0) ? true : false;
	}


	public function update($uuid)
	{
    // Ambil data detail dari form
		$bagian    = $this->input->post('bagian');
		$kondisi   = $this->input->post('kondisi');
		$problem   = $this->input->post('problem');
		$tindakan  = $this->input->post('tindakan');

		$detail = [];
		foreach ($bagian as $i => $b) {
			$detail[] = [
				'bagian'   => $b,
				'kondisi'  => $kondisi[$i],
				'problem'  => $problem[$i],
				'tindakan' => $tindakan[$i],
			];
		}

		$updateData = [
			'date'       => $this->input->post('date'),
			'shift'      => $this->input->post('shift'),
			'username'      => $this->session->userdata('username'),
			'detail'     => json_encode($detail),
			'modified_at' => date('Y-m-d H:i:s'),
		];

		$this->db->where('uuid', $uuid);
		$this->db->update('kebersihan_ruang', $updateData);

		return ($this->db->affected_rows() > 0);
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

		$this->db->update('kebersihan_ruang', $data, array('uuid' => $uuid));
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

		$this->db->update('kebersihan_ruang', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC');
		$data = $this->db->get('kebersihan_ruang')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('kebersihan_ruang', array('uuid' => $uuid))->row();
		return $data;
	}

	public function get_bagian_by_uuid($uuid)
	{
		return $this->db->get_where('kebersihan_ruang', ['uuid' => $uuid])->result_array();
	}

	public function get_details_by_uuid($uuid)
	{
		return $this->db->get_where('kebersihanruang_detail', ['uuid_kebersihanruang' => $uuid])->result_array();
	}


	public function get_by_uuid_kebersihanruang($uuid_array)
	{
		if (empty($uuid_array)) {
			return false; 
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('kebersihan_ruang');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_kebersihanruang_verif($uuid_array)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, shift, nama_produksi, status_produksi, tgl_update_produksi');
		$this->db->where_in('uuid', $uuid_array);
		$this->db->order_by('tgl_update_spv', 'DESC');   
		$this->db->limit(1);  
		$query = $this->db->get('kebersihan_ruang');

		$data_kebersihan_ruang = $query->row();  
		return $data_kebersihan_ruang; 
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('kebersihan_ruang', ['plant' => $plant])->result();
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('kebersihan_ruang');
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
		$query = $this->db->get('kebersihan_ruang');

		log_message('debug', 'Query get_by_date: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}

	public function get_last_verif_by_date($tanggal, $plant = null)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, shift, nama_produksi, status_produksi, tgl_update_produksi');
		$this->db->where('DATE(date)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('plant', $plant); 
		}

		$this->db->order_by('tgl_update_spv', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('kebersihan_ruang');

		return $query->row();
	}
}