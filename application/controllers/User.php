<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_user');
        $this->load->library('form_validation');
        $this->load->model('Model_depo');
        $this->load->model('Model_pinjaman');
        $this->load->model('Model_pipeline');
    }

    public function index()
    {


        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['halaman'] = 'Halaman User';
        $data['role'] = $this->Model_user->getRole()->result();
        $data['jmlDeposito'] = $this->Model_depo->totalDepo($data['user']['kode_cabang'])->row_array();
        $data['jmlPinjaman'] = $this->Model_pinjaman->totalPinjaman($data['user']['kode_cabang'])->row_array();
        $data['penempatandepo'] = $this->Model_depo->getDepoGrafik($data['user']['kode_cabang'])->Result();
        $data['fasilitaspinjaman'] = $this->Model_pinjaman->getPinjamanGrafik($data['user']['kode_cabang'])->result();
        $data['totalclosing'] = $this->Model_pipeline->totalClosing($data['user']['kode_cabang'])->row_array();
        $data['totalestimasi'] = $this->Model_pipeline->totalEstimasi($data['user']['kode_cabang'])->row_array();
        $data['userdata'] = $this->Model_pipeline->getDataByCabang($data['user']['kode_cabang'])->result();
        $data['produkcab'] = $this->Model_user->getProdukcab($data['user']['kode_cabang'])->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editprofile()
    {
        $data['halaman'] = 'Halaman Edit profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/edit_profile', $data);
        $this->load->view('templates/footer');
    }
}
