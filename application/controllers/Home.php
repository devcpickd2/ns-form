<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('auth_model');
        $this->load->model('produksi_model');
        $this->load->model('kontaminasi_model');
        $this->load->model('suhu_model');
        $this->load->model('pegawai_model');

        if (!$this->auth_model->current_user()) {
            redirect('login');
        }
    }

    public function index()
    {
        $pegawai = $this->auth_model->current_user();

        // 🔥 Ambil data suhu hari ini -> sudah diformat di model
        $suhu_data = $this->suhu_model->get_suhu_hari_ini();

        // Ambil data pegawai produksi sesuai plant user login
        $pegawai_produksi = $this->pegawai_model->get_produksi_by_plant($pegawai->plant);

        // Cek apakah user sudah input produksi hari ini
        $show_modal = !$this->session->userdata('produksi_input');

        $data = [
            'nama_pegawai'        => $pegawai ? $pegawai->nama : "Tamu",
            'latest_today'        => $this->produksi_model->get_latest_today(),
            'count_batch'         => $this->produksi_model->count_today_same_product(),
            'jumlah_temuan'       => $this->kontaminasi_model->get_temuan_per_hari(),
            'temuan'              => $this->kontaminasi_model->get_latest_temuan_bulan_ini(),

            // 🔥 Kirim data chart ke view
            'chart_labels'        => !empty($suhu_data['labels']) ? $suhu_data['labels'] : [],
            'chart_suhu_produksi' => !empty($suhu_data['suhu_produksi']) ? $suhu_data['suhu_produksi'] : [],
            'chart_suhu_fg'       => !empty($suhu_data['suhu_fg']) ? $suhu_data['suhu_fg'] : [],
            'chart_rh_produksi'   => !empty($suhu_data['rh_produksi']) ? $suhu_data['rh_produksi'] : [],
            'chart_rh_fg'         => !empty($suhu_data['rh_fg']) ? $suhu_data['rh_fg'] : [],

            'active_nav'          => 'home',
            'pegawai_produksi'    => $pegawai_produksi,
            'show_modal'          => $show_modal
        ];

        $this->load->view('partials/head', $data);
        $this->load->view('home/home', $data);
        $this->load->view('partials/footer');
    }

    public function set_produksi_data()
    {
        $tanggal       = $this->input->post('tanggal');
        $shift         = $this->input->post('shift');
        $nama_produksi = $this->input->post('nama_produksi');

        if ($tanggal && $shift && $nama_produksi) {
            $this->session->set_userdata('produksi_input', [
                'tanggal'       => $tanggal,
                'shift'         => $shift,
                'nama_produksi' => $nama_produksi
            ]);

            $this->session->set_flashdata('success_msg', 'Data produksi berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error_msg', 'Semua field wajib diisi.');
        }

        redirect('home');
    }

//     public function set_produksi_data()
//     {
//         $tanggal       = $this->input->post('tanggal');
//         $shift         = $this->input->post('shift');
//         $nama_produksi = $this->input->post('nama_produksi');

//     // Tetapkan default jika nama_produksi kosong
//         if (!$nama_produksi) {
//         $nama_produksi = null; // atau bisa pakai string kosong ''
//     }

//     if ($tanggal && $shift) { // nama_produksi tidak wajib
//         $this->session->set_userdata('produksi_input', [
//             'tanggal'       => $tanggal,
//             'shift'         => $shift,
//             'nama_produksi' => $nama_produksi
//         ]);

//         $this->session->set_flashdata('success_msg', 'Data produksi berhasil disimpan.');
//     } else {
//         $this->session->set_flashdata('error_msg', 'Tanggal dan shift wajib diisi.');
//     }

//     redirect('home');
// }

public function get_suhu_by_date()
{
    $tanggal = $this->input->post('tanggal');
    $data    = $this->suhu_model->get_suhu_by_date($tanggal);

        // 🔥 Pastikan hasil JSON aman
    if (empty($data)) {
        $data = [
            'labels'        => [],
            'suhu_produksi' => [],
            'suhu_fg'       => [],
            'rh_produksi'   => [],
            'rh_fg'         => []
        ];
    }

    echo json_encode($data);
}
}
