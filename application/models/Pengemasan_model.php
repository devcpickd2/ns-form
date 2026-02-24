<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Pengemasan_model extends CI_Model {
	
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
				'field' => 'waktu',
				'label' => 'Time',
				'rules' => 'required'
			],
			[
				'field' => 'nama_produk',
				'label' => 'Product',
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
				'field' => 'kondisi_produk',
				'label' => 'Product Condition',
				// 'rules' => 'required'
			],
			[
				'field' => 'kondisi_seal',
				'label' => 'Seal Condition',
				// 'rules' => 'required'
			],
			[
				'field' => 'berat_pack',
				'label' => 'Pack Weight',
				// 'rules' => 'required'
			],
			[
				'field' => 'berat_renceng',
				'label' => 'Packs Weight',
				// 'rules' => 'required'
			],
			[
				'field' => 'berat_inner',
				'label' => 'Inner Weight',
				// 'rules' => 'required'
			],
			[
				'field' => 'berat_binded',
				'label' => 'Binded Weight',
				// 'rules' => 'required'
			],
			[
				'field' => 'berat_carton',
				'label' => 'Carton Weight',
				// 'rules' => 'required'
			],
			[
				'field' => 'labelilasi',
				'label' => 'Labeling',
				// 'rules' => 'required'
			],
			[
				'field' => 'kondisi_karton',
				'label' => 'Carton Condition',
				// 'rules' => 'required'
			],
			[
				'field' => 'keterangan',
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
		$waktu = $this->input->post('waktu');
		$nama_produk = $this->input->post('nama_produk');
		$kode_produksi = $this->input->post('kode_produksi');
		$best_before = $this->input->post('best_before');
		$kondisi_produk = $this->input->post('kondisi_produk');
		$kondisi_seal = $this->input->post('kondisi_seal');
		$berat_pack = $this->input->post('berat_pack');
		$berat_renceng = $this->input->post('berat_renceng');
		$berat_inner = $this->input->post('berat_inner');
		$berat_binded = $this->input->post('berat_binded');
		$berat_carton = $this->input->post('berat_carton');
		$labelisasi = $this->input->post('labelisasi');
		$kondisi_karton = $this->input->post('kondisi_karton');
		$keterangan = $this->input->post('keterangan');
		$status_produksi = "1";
		$status_spv = "0";

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'plant' => $plant,
			'date' => $date,
			'shift' => $shift,
			'waktu' => $waktu,
			'nama_produk' => $nama_produk,
			'kode_produksi' => $kode_produksi,
			'best_before' => $best_before,
			'kondisi_produk' => $kondisi_produk,
			'kondisi_seal' => $kondisi_seal,
			'berat_pack' => $berat_pack,
			'berat_renceng' => $berat_renceng,
			'berat_inner' => $berat_inner,
			'berat_binded' => $berat_binded,
			'berat_carton' => $berat_carton,
			'labelisasi' => $labelisasi,
			'kondisi_karton' => $kondisi_karton,
			'keterangan' => $keterangan,
			'status_produksi' => $status_produksi,
			'nama_produksi' => $nama_produksi,
			'status_spv' => $status_spv
		);

		$this->db->insert('pengemasan', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{
		$username = $this->session->userdata('username');
		$date = $this->input->post('date');
		$shift = $this->input->post('shift');
		$waktu = $this->input->post('waktu');
		$nama_produk = $this->input->post('nama_produk');
		$kode_produksi = $this->input->post('kode_produksi');
		$best_before = $this->input->post('best_before');
		$kondisi_produk = $this->input->post('kondisi_produk');
		$kondisi_seal = $this->input->post('kondisi_seal');
		$berat_pack = $this->input->post('berat_pack');
		$berat_renceng = $this->input->post('berat_renceng');
		$berat_inner = $this->input->post('berat_inner');
		$berat_binded = $this->input->post('berat_binded');
		$berat_carton = $this->input->post('berat_carton');
		$labelisasi = $this->input->post('labelisasi');
		$kondisi_karton = $this->input->post('kondisi_karton');
		$keterangan = $this->input->post('keterangan');

		$data = array(
			'username' => $username,
			'date' => $date,
			'shift' => $shift,
			'waktu' => $waktu,
			'nama_produk' => $nama_produk,
			'kode_produksi' => $kode_produksi,
			'best_before' => $best_before,
			'kondisi_produk' => $kondisi_produk,
			'kondisi_seal' => $kondisi_seal,
			'berat_pack' => $berat_pack,
			'berat_renceng' => $berat_renceng,
			'berat_inner' => $berat_inner,
			'berat_binded' => $berat_binded,
			'berat_carton' => $berat_carton,
			'labelisasi' => $labelisasi,
			'kondisi_karton' => $kondisi_karton,
			'keterangan' => $keterangan,

			'modified_at' => date("Y-m-d H:i:s") 
		);

		$this->db->update('pengemasan', $data, array('uuid' => $uuid));
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

		$this->db->update('pengemasan', $data, array('uuid' => $uuid));
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

		$this->db->update('pengemasan', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC');
		$data = $this->db->get('pengemasan')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('pengemasan', array('uuid' => $uuid))->row();
		return $data;
	}

	public function get_by_uuid_pengemasan($uuid_array)
	{
		if (empty($uuid_array)) {
			return false; 
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('pengemasan');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_pengemasan_verif($uuid_array)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, shift, nama_produksi, status_produksi, tgl_update_produksi');
		$this->db->where_in('uuid', $uuid_array);
		$this->db->order_by('tgl_update_spv', 'DESC');   
		$this->db->limit(1);  
		$query = $this->db->get('pengemasan');

		$data_pengemasan = $query->row();  
		return $data_pengemasan; 
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('pengemasan', ['plant' => $plant])->result();
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('pengemasan');
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
		$query = $this->db->get('pengemasan');

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
		$query = $this->db->get('pengemasan');

		return $query->row();
	}
}