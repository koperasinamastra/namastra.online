<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['halaman'] = 'My Dashboard';
        $data['role'] = $this->Model_user->getRole()->result();
        $data['jmlDeposito'] = $this->Model_depo->admintotalDepo()->row_array();
        $data['jmlPinjaman'] = $this->Model_pinjaman->admintotalPinjaman()->row_array();
        $data['penempatandepo'] = $this->Model_depo->getadminDepoGrafik()->Result();
        $data['fasilitaspinjaman'] = $this->Model_pinjaman->getAdminPinjamanGrafik()->result();
        $data['totalclosing'] = $this->Model_pipeline->AdmintotalClosing()->row_array();
        $data['totalestimasi'] = $this->Model_pipeline->AdmintotalEstimasi()->row_array();
        $data['produk'] = $this->Model_user->getProduk()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/admin', $data);
        $this->load->view('templates/footer', $data);
    }

    public function view_user()
    {
        $data['halaman'] = 'Manage User';
        $data['datauser'] = $this->Model_user->getDataUser()->result();
        $data['user'] = $this->Model_user->getUser()->row_array();
        $data['role'] = $this->Model_user->getRole()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/view_user', $data);
        $this->load->view('templates/footer');
    }

    function InputUser()
    {

        $data['user'] = $this->Model_user->getDataUser()->result();
        $this->load->view('admin/input_user', $data);
    }

    function simpanuser()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Bukan Format Email',
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'required' => 'Password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim', [
            'required' => 'Password tidak boleh kosong',
        ]);


        if ($this->form_validation->run() == false) {

            $data['judul'] = 'My Dashboard';
            $data['datauser'] = $this->Model_user->getDataUser()->result();
            $data['user'] = $this->Model_user->getUser()->row_array();
            $data['role'] = $this->Model_user->getRole()->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('admin/view_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role_id'),
                'is_active' => $this->input->post('is_active'),
                'date' => time()

            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Selamat...Akun anda telah terdaftar, silahkan untuk login
          </div>');
            redirect('admin/view_user');
        }
    }

    function hapususer($id)
    {
        $id = $this->uri->segment(3);
        $hapus = $this->Model_user->deleteUser($id);

        if ($hapus) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus..!!
          </div>');
            redirect('admin/view_user');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Gagal Dihapus..!!
          </div>');
            redirect('admin/view_user');
        }
    }

    public function aktivasi($id)
    {

        $id = $this->uri->segment(3);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $is_active = 1;
        $data = array(
            'is_active' => $is_active
        );

        $simpan = $this->db->update('user', $data, array('id' => $id));

        if ($simpan) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            User berhasil aktivasi..!!
          </div>');


            redirect('admin/view_user');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            user gagal aktivasi..!!
          </div>');
            redirect('admin/view_user');
        }
    }

    public function roleakses()
    {

        $data['halaman'] = 'Role Akses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('role_id')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/view_role', $data);
        $this->load->view('templates/footer');
    }

    public function edituser()
    {
        $data['halaman'] = 'Edit User';
        $data['user'] = $this->Model_user->getUser()->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates/footer');
    }
}
