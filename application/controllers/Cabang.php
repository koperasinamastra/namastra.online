<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_cabang');
    }

    public function index()
    {
        $data['halaman'] = 'Manage Cabang';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cabang'] = $this->Model_cabang->getDataCabang()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('cabang/view_cabang', $data);
        $this->load->view('templates/footer');
    }
}
