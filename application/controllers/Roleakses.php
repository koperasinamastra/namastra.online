<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roleakses extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $data['halaman'] = 'Role Akses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['roledata'] = $this->db->get('role_id')->result();

        $this->form_validation->set_rules('role', 'Role', 'required', [
            'required' => 'Role tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('role/view_role', $data);
            $this->load->view('templates/footer');
        } else {

            $this->db->insert('role_id', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Role Tersimpan
          </div>');
            redirect('roleakses');
        }
    }

    public function aksesrole($id)
    {
        $data['halaman'] = 'Input Akses';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('role_id', ['id' => $id])->row_array();

        $this->db->where('id  !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('role/input_role', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $role_id = $this->input->post('roleId');
        $menu_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
        Role Akses Berhasil diubah!!
      </div>');
    }
}
