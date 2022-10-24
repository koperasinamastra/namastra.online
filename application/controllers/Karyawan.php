<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_karyawan');
    }

    public function index()
    {
        $data['halaman'] = 'Data Karyawan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['karyawan'] = $this->Model_karyawan->getDatakaryawan()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('karyawan/view_karyawan', $data);
        $this->load->view('templates/footer');
    }
}
