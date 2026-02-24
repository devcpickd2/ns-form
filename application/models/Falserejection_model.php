<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Falserejection_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'date_false_rejection',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'shift_monitoring',
				'label' => 'Shift',
				'rules' => 'required'
			], 
			[
				'field' => 'no_mesin',
				'label' => 'Machine'
			], 
			[
				'field' => 'jumlah_tidak_lolos',
				'label' => 'Did not pass'
			], 
			[
				'field' => 'jumlah_kontaminasi',
				'label' => 'Amount of Contamination'
			],
			[
				'field' => 'jenis_kontaminasi',
				'label' => 'Types of Contamination'
			],
			[
				'field' => 'posisi_kontaminasi',
				'label' => 'Position of Contamination'
			],
			[
				'field' => 'false_rejection',
				'label' => 'False Rejection'
			],
			[
				'field' => 'catatan',
				'label' => 'Notes'
			] 
		];
	}

	public function update($uuid)
	{
		$username = $this->session->userdata('username');
		$produksi_input = $this->session->userdata('produksi_input');
		$nama_produksi = $produksi_input['nama_produksi'] ?? null;
		$date_false_rejection = $this->input->post('date_false_rejection');
		$shift_monitoring = $this->input->post('shift_monitoring');
		$no_mesin = $this->input->post('no_mesin');
		$jumlah_tidak_lolos = $this->input->post('jumlah_tidak_lolos');
		$jumlah_kontaminasi = $this->input->post('jumlah_kontaminasi');
		$jenis_kontaminasi = $this->input->post('jenis_kontaminasi');
		$posisi_kontaminasi = $this->input->post('posisi_kontaminasi');
		$false_rejection = $this->input->post('false_rejection');
		$catatan = $this->input->post('catatan');

		$data = array(
			'username_2' => $username,
			'date_false_rejection' => $date_false_rejection,
			'shift_monitoring' => $shift_monitoring,
			'no_mesin' => $no_mesin,
			'jumlah_tidak_lolos' => $jumlah_tidak_lolos,
			'jumlah_kontaminasi' => $jumlah_kontaminasi,
			'jenis_kontaminasi' => $jenis_kontaminasi,
			'posisi_kontaminasi' => $posisi_kontaminasi,
			'false_rejection' => $false_rejection,
			'nama_produksi_false' => $nama_produksi,
			'catatan' => $catatan,

			'modified_at_false' => date("Y-m-d H:i:s")
		);

		$this->db->update('metal', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function rules_verifikasi()
	{
		return[
			[
				'field' => 'status_spv_false',
				'label' => 'Status',
				'rules' => 'required'
			],
			[
				'field' => 'catatan_spv_false',
				'label' => 'Notes'
			]
			
		];
	}


	public function verifikasi_update($uuid)
	{

		$nama_spv = $this->session->userdata('username');
		$status_spv_false = $this->input->post('status_spv_false');
		$catatan_spv_false = $this->input->post('catatan_spv_false');

		$data = array(
			'nama_spv_false' => $nama_spv,
			'status_spv_false' => $status_spv_false,
			'catatan_spv_false' => $catatan_spv_false,
			'tgl_update_spv_false' => date("Y-m-d H:i:s")
		);

		$this->db->update('metal', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function rules_diketahui()
	{
		return[
			[
				'field' => 'status_produksi_false',
				'label' => 'Status',
				'rules' => 'required'
			],
			[
				'field' => 'catatan_produksi_false',
				'label' => 'Notes'
			]
			
		];
	}


	public function diketahui_update($uuid)
	{

		$nama_produksi = $this->session->userdata('username');
		$status_produksi = $this->input->post('status_produksi_false');
		$catatan_produksi = $this->input->post('catatan_produksi_false');

		$data = array(
			'nama_produksi_false' => $nama_produksi,
			'status_produksi_false' => $status_produksi,
			'catatan_produksi_false' => $catatan_produksi,
			'tgl_update_produksi_false' => date("Y-m-d H:i:s")
		);

		$this->db->update('metal', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}


	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC');
		$data = $this->db->get('metal')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('metal', array('uuid' => $uuid))->row();
		return $data;
	}

	public function get_by_uuid_falserejection($uuid_array)
	{
		if (empty($uuid_array)) {
			return false; 
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('metal');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_falserejection_verif($uuid_array)
	{
		$this->db->select('nama_spv_false, tgl_update_spv_false, no_mesin, username_2, nama_produksi_false, tgl_update_produksi_false');
		$this->db->where_in('uuid', $uuid_array);
		$this->db->order_by('tgl_update_spv_false', 'DESC');   
		$this->db->limit(1);  
		$query = $this->db->get('metal');

		$data_falserejection = $query->row();  
		return $data_falserejection; 
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('metal', ['plant' => $plant])->result();
	}

	public function get_by_date($tanggal, $plant = null) 
	{
		if (empty($tanggal)) {
			return false;
		}

		$this->db->where('DATE(date_false_rejection)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('plant', $plant); 
		}

		$this->db->order_by('date_false_rejection', 'ASC');
		$query = $this->db->get('metal');

		log_message('debug', 'Query get_by_date: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}

	public function get_last_verif_by_date($tanggal, $plant = null)
	{
		$this->db->select('nama_spv_false, tgl_update_spv_false, no_mesin, username_2, nama_produksi_false, tgl_update_produksi_false, status_produksi_false');
		$this->db->where('DATE(date_false_rejection)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('plant', $plant); 
		}

		$this->db->order_by('tgl_update_spv_false', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('metal');

		return $query->row();
	}
}