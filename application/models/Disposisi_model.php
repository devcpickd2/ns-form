<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Disposisi_model extends CI_Model {
	
	public function rules()
	{
		return[
			[
				'field' => 'date',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'nomor',
				'label' => 'Number', 
				'rules' => 'required'
			],
			[
				'field' => 'kepada',
				'label' => 'Dear',
				'rules' => 'required'
			], 
			[
				'field' => 'disposisi',
				'label' => 'Disposition',
				'rules' => 'required'
			],
			[
				'field' => 'dasar_disposisi',
				'label' => 'Based Disposition'
			],
			[
				'field' => 'uraian_disposisi',
				'label' => 'Description'
			],
			[
				'field' => 'catatan',
				'label' => 'Notes'
			],
			[
				'field' => 'cc',
				'label' => 'CC'
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
		$nomor = $this->input->post('nomor');
		$kepada = $this->input->post('kepada');
		$disposisi = $this->input->post('disposisi');
		$dasar_disposisi = $this->input->post('dasar_disposisi');
		$uraian_disposisi = $this->input->post('uraian_disposisi');
		$catatan = $this->input->post('catatan');
		$cc = $this->input->post('cc');
		$status_produksi = "1";
		$status_spv = "0";

		$data = array(
			'uuid' => $uuid,
			'username' => $username,
			'plant' => $plant,
			'date' => $date,
			'nomor' => $nomor,
			'kepada' => $kepada,
			'disposisi' => $disposisi,
			'dasar_disposisi' => $dasar_disposisi,
			'uraian_disposisi' => $uraian_disposisi,
			'catatan' => $catatan,
			'cc' => $cc,
			'status_produksi' => $status_produksi,
			'nama_produksi' => $nama_produksi,
			'status_spv' => $status_spv
		);

		$this->db->insert('disposisi', $data);
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function update($uuid)
	{
		$username = $this->session->userdata('username');
		$date = $this->input->post('date');
		$nomor = $this->input->post('nomor');
		$kepada = $this->input->post('kepada');
		$disposisi = $this->input->post('disposisi');
		$dasar_disposisi = $this->input->post('dasar_disposisi');
		$uraian_disposisi = $this->input->post('uraian_disposisi');
		$catatan = $this->input->post('catatan');
		$cc = $this->input->post('cc');

		$data = array(
			'username' => $username,
			'date' => $date,
			'nomor' => $nomor,
			'kepada' => $kepada,
			'disposisi' => $disposisi,
			'dasar_disposisi' => $dasar_disposisi,
			'uraian_disposisi' => $uraian_disposisi,
			'catatan' => $catatan,
			'cc' => $cc,

			'modified_at' => date("Y-m-d H:i:s") 
		);

		$this->db->update('disposisi', $data, array('uuid' => $uuid));
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

		$this->db->update('disposisi', $data, array('uuid' => $uuid));
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

		$this->db->update('disposisi', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	public function get_all()
	{
		$this->db->order_by('created_at', 'DESC');
		$data = $this->db->get('disposisi')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$data = $this->db->get_where('disposisi', array('uuid' => $uuid))->row();
		return $data;
	}

	public function get_by_uuid_disposisi($uuid_array)
	{
		if (empty($uuid_array)) {
			return false; 
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('disposisi');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_disposisi_verif($uuid_array)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, nomor, kepada, disposisi, dasar_disposisi, uraian_disposisi, catatan, cc');
		$this->db->where_in('uuid', $uuid_array);
		$this->db->order_by('tgl_update_spv', 'DESC');   
		$this->db->limit(1);  
		$query = $this->db->get('disposisi');

		$data_disposisi = $query->row();  
		return $data_disposisi; 
	}

	public function get_data_by_plant()
	{
		$this->db->order_by('created_at', 'DESC');
		$plant = $this->session->userdata('plant');
		return $this->db->get_where('disposisi', ['plant' => $plant])->result();
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('disposisi');
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
		$query = $this->db->get('disposisi');

		log_message('debug', 'Query get_by_date: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result();
		}

		return false;
	}

	public function get_last_verif_by_date($tanggal, $plant = null)
	{
		$this->db->select('nama_spv, tgl_update_spv, username, date, nomor, kepada, disposisi, dasar_disposisi, uraian_disposisi, catatan, cc');
		$this->db->where('DATE(date)', $tanggal);

		if (!empty($plant)) {
			$this->db->where('plant', $plant); 
		}

		$this->db->order_by('tgl_update_spv', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('disposisi');

		return $query->row();
	}

}