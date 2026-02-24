<?php

class Auth_model extends CI_Model
{
	private $_table = 'pegawai';
	const SESSION_KEY = 'user_uuid';

	public function rules()
	{
		return [
			[
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			]
		];
	}
	
	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$query = $this->db->get($this->_table);
		$user = $query->row();

		if (!$user) {
			return FALSE;
		}

		if (!password_verify($password, $user->password)) {
			return FALSE;
		}

		$this->session->set_userdata([
			self::SESSION_KEY => $user->uuid,
			'username' => $user->username,
			'nama' => $user->nama,
			'tipe_user' => $user->tipe_user,
			'plant' => $user->plant,
			'foto' => $user->foto ?? 'profil.png'
		]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_uuid = $this->session->userdata(self::SESSION_KEY);

		$this->db->select('pegawai.*, plant.plant as nama_plant, departemen.departemen as nama_departemen');
		$this->db->from('pegawai');
		$this->db->join('plant', 'plant.uuid = pegawai.plant', 'left');
		$this->db->join('departemen', 'departemen.uuid = pegawai.departemen', 'left');
		$this->db->where('pegawai.uuid', $user_uuid);

		return $this->db->get()->row();
	}

	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}