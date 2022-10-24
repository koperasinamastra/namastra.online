<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Submenu');
        $this->load->model('Model_Menu');
    }
    public function index()
    {
        $data['halaman'] = 'Manage Submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['subMenu'] = $this->Model_Submenu->getSubMenu()->result();
        $data['menudata'] = $this->Model_Submenu->getMenu()->result();;

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('role_id', 'Role_id', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('is_active', 'Is_active', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('menu/view_submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title', true),
                'menu_id' => $this->input->post('role_id', true),
                'url' => $this->input->post('url', true),
                'is_active' => $this->input->post('is_active', true),
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Submenu tersimpan
          </div>');
            redirect('submenu');
        }
    }

    function hapusSubmenu($id)
    {
        $id = $this->uri->segment(3);
        $hapus = $this->Model_Submenu->deleteSubmenu($id);

        if ($hapus) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus..!!
          </div>');
            redirect('submenu');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Gagal Dihapus..!!
          </div>');
            redirect('submenu');
        }
    }
}
