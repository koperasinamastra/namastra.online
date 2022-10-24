<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_cabang');
        $this->load->model('Model_jabatan');
        $this->load->model('Model_user');
    }


    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['halaman'] = 'Halaman Login';

        $this->form_validation->set_rules('email', 'Pmail', 'required|trim', [
            'required' => 'Email tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            //Validasi Sukses
            $this->_login();
        }
    }

    private function _login()
    {


        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {

            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'kode_cabang' => $user['kode_cabang']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
                    Password Salah..!!
                  </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
                Email belum diaktifasi
              </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
        Email Tidak Terdaftar..!!
      </div>');
            redirect('auth');
        }
    }


    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $data['halaman'] = 'Halaman Registration';

        $data['cabang'] = $this->Model_cabang->getDataCabang()->Result();
        $data['jabatan'] = $this->Model_jabatan->getDataJabatan()->Result();

        $this->form_validation->set_rules('name', 'Name', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Bukan Format Email',
            'is_unique' => 'Email sudah di database'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
            'matches' => 'Password tidak sama!',
            'required' => 'Password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('id_jabatan', 'Id_jabatan', 'required|trim', [
            'required' => 'Jabatan tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('kode_cabang', 'Kode_cabang', 'required|trim', [
            'required' => 'Cabang tidak boleh kosong'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration', $data);
            $this->load->view('templates/auth_footer', $data);
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'id_jabatan' => $this->input->post('id_jabatan', true),
                'kode_cabang' => $this->input->post('kode_cabang', true),
                'role_id' => 2,
                'is_active' => 0,
                'date' => time()

            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Selamat...Akun anda telah terdaftar, silahkan untuk login
          </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
        Anda telah Logout...!!!
      </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['halaman'] = 'Error 404';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/blocked');
        $this->load->view('templates/auth_footer');
    }
}
