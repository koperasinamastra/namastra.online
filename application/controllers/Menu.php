<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Menu');
        $this->load->model('Model_Submenu');

        is_logged_in();
    }

    public function index()
    {
        $data['halaman'] = 'Manage Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Model_Menu->getDataMenu()->result();

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim', [
            'required' => 'Menu tidak boleh kosong'
        ]);

        $this->form_validation->set_rules('icon', 'Icon', 'required|trim', [
            'required' => 'Icon tidak boleh kosong'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/view_menu', $data);
            $this->load->view('templates/footer');
        } else { {
                $data = [
                    'menu' => $this->input->post('menu', true),
                    'icon' => $this->input->post('icon', true),
                ];
                $this->db->insert('user_menu', $data);
                $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Menu Tersimpan
          </div>');
                redirect('menu');
            }
        }
    }

    function hapusmenu($id)
    {
        $id = $this->uri->segment(3);
        $hapus = $this->Model_Menu->deleteMenu($id);

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
}
