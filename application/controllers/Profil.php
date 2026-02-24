<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Profil Pengguna';
        $data['active_nav'] = 'profil';
        $data['pegawai'] = $this->auth_model->current_user();

        $this->load->view('partials/head', $data);
        $this->load->view('profil/index', $data);
        $this->load->view('partials/footer');
    }

public function update()
{
    $pegawai = $this->auth_model->current_user();
    if (!$pegawai) redirect('auth/login');

    // Validasi input
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');

    if (!empty($this->input->post('password')) || !empty($this->input->post('confirm_password'))) {
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'matches[password]', [
            'matches' => 'Konfirmasi password tidak cocok.'
        ]);
    }

    // Jika validasi gagal, tampilkan form ulang
    if ($this->form_validation->run() == FALSE) {
        $data['title'] = 'Edit Profil';
        $data['active_nav'] = 'profil';
        $data['pegawai'] = $pegawai;
        $this->load->view('partials/head', $data);
        $this->load->view('profil/index', $data);
        $this->load->view('partials/footer');
        return;
    }

    // === Upload Foto ===
    $foto = $pegawai->foto;
    if (!empty($_FILES['foto']['name'])) {
        $config['upload_path'] = './uploads/foto/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'foto_' . time();
        $config['overwrite'] = FALSE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            // Hapus foto lama jika bukan default
            if ($foto && $foto != 'profil.png' && file_exists(FCPATH . 'uploads/foto/' . $foto)) {
                unlink(FCPATH . 'uploads/foto/' . $foto);
            }
            $foto = $this->upload->data('file_name');
        } else {
            // Jika upload gagal, tampilkan error dan kembali
            $this->session->set_flashdata('error_msg', strip_tags($this->upload->display_errors()));
            redirect('profil');
        }
    }

    // Data yang akan diupdate
    $update = [
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'foto' => $foto
    ];

    if (!empty($this->input->post('password'))) {
        $update['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    }

    // Update database
    $this->db->where('uuid', $pegawai->uuid);
    $this->db->update('pegawai', $update);

    // Update session (biar foto & nama langsung ter-refresh)
    $this->session->set_userdata('nama', $update['nama']);
    $this->session->set_userdata('username', $update['username']);
    $this->session->set_userdata('foto', $foto);

    $this->session->set_flashdata('success_msg', 'Profil berhasil diperbarui.');
    redirect('home');
}



    public function username_check($username)
    {
        $pegawai = $this->auth_model->current_user();
        $this->db->where('username', $username);
        $this->db->where('uuid !=', $pegawai->uuid);
        $exists = $this->db->get('pegawai')->row();

        if ($exists) {
            $this->form_validation->set_message('username_check', 'Username sudah digunakan oleh pengguna lain.');
            return FALSE;
        }

        return TRUE;
    }

}
