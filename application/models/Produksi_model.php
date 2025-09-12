<?php 
date_default_timezone_set('Asia/Jakarta');
use Ramsey\Uuid\Uuid;


class Produksi_model extends CI_Model {
	
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
				'field' => 'nama_produk',
				'label' => 'Produk Name', 
				'rules' => 'required'
			],
			[
				'field' => 'kode_produksi',
				'label' => 'Product Code',
				'rules' => 'required'
			],	
			[
				'field' => 'hasil_mixing',
				'label' => 'Result of Mixed'
			],
			[
				'field' => 'waktu_mixing_premix',
				'label' => 'Time of mixing'
			],
			[
				'field' => 'sens_rasa',
				'label' => 'Tasted Sensory'
			],
			[
				'field' => 'sens_aroma',
				'label' => 'Aroma Sensory'
			],
			[
				'field' => 'sens_tekstur',
				'label' => 'Texture Sensory'
			],
			[
				'field' => 'sens_warna',
				'label' => 'Color Sensory'
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
		$nama_produk = $this->input->post('nama_produk');
		$kode_produksi = $this->input->post('kode_produksi');
		$hasil_mixing = $this->input->post('hasil_mixing');
		$waktu_mixing_premix = $this->input->post('waktu_mixing_premix');
		$sens_rasa = $this->input->post('sens_rasa');
		$sens_aroma = $this->input->post('sens_aroma');
		$sens_tekstur = $this->input->post('sens_tekstur');
		$sens_warna = $this->input->post('sens_warna');
		$catatan = $this->input->post('catatan');

		$status_produksi = "1";
		$status_spv = "0";

    // --- AMBIL DATA PREMIX ---
		$nama_premix = $this->input->post('premix_nama') ?? [];
		$kode_premix = $this->input->post('premix_kode') ?? [];
		$berat_premix = $this->input->post('premix_berat') ?? [];
		$sens_premix = $this->input->post('premix_sens') ?? [];

		$premix = [];
		foreach ($kode_premix as $i => $kode) {
			$premix[] = [
				'nama'  => $nama_premix[$i] ?? '',
				'kode'  => $kode,
				'berat' => $berat_premix[$i] ?? '-',
				'sens'  => $sens_premix[$i] ?? '-',
			];
		}

    // --- AMBIL DATA RAW MATERIAL ---
		$raw_nama  = $this->input->post('raw_nama') ?? [];
		$raw_kode  = $this->input->post('raw_kode') ?? [];
		$raw_berat = $this->input->post('raw_berat') ?? [];
		$raw_sens  = $this->input->post('raw_sens') ?? [];

		$raw_mat = [];
		foreach ($raw_kode as $i => $kode) {
			$raw_mat[] = [
				'nama'  => $raw_nama[$i]  ?? '',
				'kode'  => $kode,
				'berat' => $raw_berat[$i] ?? '-',
				'sens'  => $raw_sens[$i]  ?? '-',
			];
		}

		$data = [
			'uuid' => $uuid,
			'username' => $username,
			'plant' => $plant,
			'date' => $date,
			'shift' => $shift,
			'nama_produk' => $nama_produk,
			'kode_produksi' => $kode_produksi,
			'hasil_mixing' => $hasil_mixing,
			'waktu_mixing_premix' => $waktu_mixing_premix,
			'premix' => json_encode($premix),
			'raw_mat' => json_encode($raw_mat),
			'sens_rasa' => $sens_rasa,
			'sens_aroma' => $sens_aroma,
			'sens_tekstur' => $sens_tekstur,
			'sens_warna' => $sens_warna,
			'catatan' => $catatan,
			'status_spv' => $status_spv,
			'status_produksi' => $status_produksi,
			'nama_produksi' => $nama_produksi,
		];

		$this->db->insert('mixing', $data);
		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function update($uuid)
	{
		$data = [
			'date'                => $this->input->post('date'),
			'shift'               => $this->input->post('shift'),
			'nama_produk'         => $this->input->post('nama_produk'),
			'kode_produksi'       => $this->input->post('kode_produksi'),
			'hasil_mixing'        => $this->input->post('hasil_mixing'),
			'waktu_mixing_premix' => $this->input->post('waktu_mixing_premix'),
			'sens_rasa'           => $this->input->post('sens_rasa'),
			'sens_aroma'          => $this->input->post('sens_aroma'),
			'sens_tekstur'        => $this->input->post('sens_tekstur'),
			'sens_warna'          => $this->input->post('sens_warna'),
			'catatan'             => $this->input->post('catatan'),
			'modified_at'         => date("Y-m-d H:i:s"),
		];

		$premix = [];
		$premix_nama  = $this->input->post('premix_nama') ?? [];
		$premix_kode  = $this->input->post('premix_kode') ?? [];
		$premix_berat = $this->input->post('premix_berat') ?? [];
		$premix_sens  = $this->input->post('premix_sens') ?? [];

		foreach ($premix_kode as $i => $kode) {
			$premix[] = [
				'nama'  => $premix_nama[$i] ?? '',
				'kode'  => $kode,
				'berat' => $premix_berat[$i] ?? '',
				'sens'  => $premix_sens[$i] ?? '',
			];
		}
		$data['premix'] = json_encode($premix);

		$raw = [];
		$raw_nama  = $this->input->post('raw_nama') ?? [];
		$raw_kode  = $this->input->post('raw_kode') ?? [];
		$raw_berat = $this->input->post('raw_berat') ?? [];
		$raw_sens  = $this->input->post('raw_sens') ?? [];

		foreach ($raw_kode as $i => $kode) {
			$raw[] = [
				'nama'  => $raw_nama[$i] ?? '',
				'kode'  => $kode,
				'berat' => $raw_berat[$i] ?? '',
				'sens'  => $raw_sens[$i] ?? '',
			];
		}
		$data['raw_mat'] = json_encode($raw);

		$this->db->where('uuid', $uuid);
		$this->db->update('mixing', $data);

		return ($this->db->affected_rows() > 0);
	}

	public function rules_packing()
	{
		return [
			[
				'field' => 'date_packing',
				'label' => 'Date',
				'rules' => 'required'
			],
			[
				'field' => 'shift_packing',
				'label' => 'Packing Shift',
				'rules' => 'required'
			],
			[
				'field' => 'pukul_packing',
				'label' => 'Packing Time',
				'rules' => 'required'
			],
			[
				'field' => 'kondisi_produk', 
				'label' => 'Product Condition',
				'rules' => 'required'
			],
			[
				'field' => 'kondisi_seal', 
				'label' => 'Product Seal',
				'rules' => 'required'
			],
			[
				'field' => 'jenis_packing', 
				'label' => 'Packing Type',
				'rules' => 'required'
			],
			[
				'field' => 'berat', 
				'label' => 'Weight',
				'rules' => 'required'
			],
			[
				'field' => 'berat_kotor_karton', 
				'label' => 'Gross Weight',
				'rules' => 'required',
			],
			[
				'field' => 'labelisasi_karton', 
				'label' => 'Carton Labels',
				'rules' => 'callback_file_check'
			],
			[
				'field' => 'kondisi_seal_karton', 
				'label' => 'Carton Seal Condition'
			],
			[
				'field' => 'catatan', 
				'label' => 'Notes'
			]
		];
	}

	public function pack($uuid, $file_name)
	{
		$username = $this->session->userdata('username');
		$pukul = $this->input->post('pukul_packing');
		if (!empty($pukul)) {
			$pukul = date("H:i:s", strtotime($pukul)); 
		} else {
			$pukul = null;
		}

		$data = array(
			'username'            => $username,
			'date_packing'        => $this->input->post('date_packing'),
			'shift_packing'       => $this->input->post('shift_packing'),
			'pukul_packing'       => $pukul,
			'kondisi_produk'      => $this->input->post('kondisi_produk'),
			'kondisi_seal'        => $this->input->post('kondisi_seal'),
			'jenis_packing'       => $this->input->post('jenis_packing'),
			'berat'               => $this->input->post('berat'),
			'berat_kotor_karton'  => $this->input->post('berat_kotor_karton'),
			'labelisasi_karton'   => $file_name,
			'kondisi_seal_karton' => $this->input->post('kondisi_seal_karton'),
			'catatan'             => $this->input->post('catatan'),
			'modified_at'         => date("Y-m-d H:i:s")
		);

		$this->db->where('uuid', $uuid);
		return $this->db->update('mixing', $data);
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
			'tgl_update' => date("Y-m-d H:i:s")
		);

		$this->db->update('mixing', $data, array('uuid' => $uuid));
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
			'tgl_update_prod' => date("Y-m-d H:i:s")
		);

		$this->db->update('mixing', $data, array('uuid' => $uuid));
		return($this->db->affected_rows() > 0) ? true :false;

	}

	// public function get_all()
	// {
	// 	$this->db->order_by('created_at', 'DESC');
	// 	$data = $this->db->get('mixing')->result();
	// 	return $data;
	// }

	public function get_all()
	{
		$this->db->select('mixing.*, produk.nama_produk'); 
		$this->db->from('mixing');
		$this->db->join('produk', 'produk.uuid = mixing.nama_produk', 'left');  
		$this->db->order_by('mixing.created_at', 'DESC');

		return $this->db->get()->result();
	}

	public function get_produksi()
	{
		$this->db->order_by('created_at', 'DESC');
		$data = $this->db->get('mixing')->result();
		return $data;
	}

	public function get_by_uuid($uuid)
	{
		$this->db->select('m.*, p.nama_produk as nama_produk_asli');
		$this->db->from('mixing m');
		$this->db->join('produk p', 'm.nama_produk = p.uuid', 'left');
		$this->db->where('m.uuid', $uuid);
		$data = $this->db->get()->row();

		if ($data) {
			$data->raw_mat = !empty($data->raw_mat) ? json_decode($data->raw_mat) : [];
			$data->premix  = !empty($data->premix) ? json_decode($data->premix) : [];
		}

		return $data;
	}

	public function get_by_uuid_produksi($uuid_array)
	{
		if (empty($uuid_array)) {
			return false;
		}
		log_message('debug', 'Array UUID yang diterima: ' . print_r($uuid_array, true));

		$this->db->where_in('uuid', $uuid_array);
		$query = $this->db->get('mixing');

		log_message('debug', 'Query yang dijalankan: ' . $this->db->last_query());

		if ($query->num_rows() > 0) {
			return $query->result(); 
		}	
		return false;  
	}

	public function get_by_uuid_produksi_verif($uuid_array)
	{
		$this->db->select('nama_spv, tgl_update, date, shift, nama_produk, catatan, status_spv, username, premix, nama_produksi, tgl_update_prod, status_produksi');
		$this->db->where_in('uuid', $uuid_array);
		$this->db->order_by('tgl_update', 'DESC');  
		$this->db->limit(1);  
		$query = $this->db->get('mixing');

		$data_produksi = $query->row();  
		return $data_produksi; 
	}

	public function get_latest_today() {
		$plant = $this->session->userdata('plant');

		$this->db->where('date', date('Y-m-d'));
		$this->db->where('plant', $plant);
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('mixing', 1);

		return $query->row_array();
	}

	public function count_today_same_product() {
		$plant = $this->session->userdata('plant'); 

		$this->db->select('nama_produk');
		$this->db->where('plant', $plant);
		$this->db->order_by('created_at', 'DESC'); 
		$this->db->limit(1); 
		$last_updated_product = $this->db->get('mixing')->row_array();

		if (!$last_updated_product) {
			return 0;
		}

		$this->db->where('date', date('Y-m-d'));
		$this->db->where('nama_produk', $last_updated_product['nama_produk']);
		$this->db->where('plant', $plant);
		return $this->db->count_all_results('mixing');
	}

	public function get_data_by_plant()
	{
		$this->db->select('mixing.*, produk.nama_produk'); 
		$this->db->from('mixing');
		$this->db->join('produk', 'produk.uuid = mixing.nama_produk', 'left'); 
		$this->db->where('mixing.plant', $this->session->userdata('plant'));
		$this->db->order_by('mixing.created_at', 'DESC');

		return $this->db->get()->result();
	}

	public function get_last_kode_by_date($date)
	{
		$this->db->select('kode_produksi');
		$this->db->from('mixing');
		$this->db->where('date', $date);
		$this->db->order_by('created_at', 'DESC');
		$this->db->limit(1);

		return $this->db->get()->row();
	}

	public function delete_by_uuid($uuid)
	{
		$this->db->where('uuid', $uuid);
		return $this->db->delete('mixing');
	}

	public function get_by_date_and_produk($tanggal, $produk_uuid, $plant = null)
	{
		if (empty($tanggal) || empty($produk_uuid)) return false;

    $this->db->select('m.*, p.nama_produk AS nama_produk_asli'); // ambil nama asli dari tabel produk
    $this->db->from('mixing m');
    $this->db->join('produk p', 'm.nama_produk = p.uuid', 'left'); // join tabel produk
    $this->db->where('DATE(m.date)', $tanggal);
    $this->db->where('m.nama_produk', $produk_uuid);

    if (!empty($plant)) $this->db->where('m.plant', $plant);

    $this->db->order_by('m.date', 'ASC');
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->result() : false;
}

public function get_last_verif_by_date_and_produk($tanggal, $produk_uuid, $plant = null)
{
	if (empty($tanggal) || empty($produk_uuid)) return false;

	$this->db->select('nama_spv, tgl_update, date, shift, nama_produk, catatan, status_spv, username, premix, nama_produksi, tgl_update_prod, status_produksi, date_packing, shift_packing, pukul_packing');
	$this->db->where('DATE(date)', $tanggal);
    $this->db->where('nama_produk', $produk_uuid); // gunakan UUID

    if (!empty($plant)) $this->db->where('plant', $plant);

    $this->db->order_by('tgl_update', 'DESC');
    $this->db->limit(1);
    $query = $this->db->get('mixing');

    return $query->row();
}

public function get_produk_by_date($tanggal, $plant = null)
{
	$this->db->distinct();
    $this->db->select('p.uuid, p.nama_produk'); // ambil UUID dan nama asli
    $this->db->from('mixing m');
    $this->db->join('produk p', 'm.nama_produk = p.uuid', 'left'); // join ke tabel produk
    $this->db->where('DATE(m.date)', $tanggal);

    if (!empty($plant)) {
    	$this->db->where('m.plant', $plant);
    }

    $query = $this->db->get();
    return $query->result();
}



}