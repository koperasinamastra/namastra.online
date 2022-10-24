<?php

use Mpdf\Mpdf;




defined('BASEPATH') or exit('No direct script access allowed');
class Pipeline extends CI_Controller
{



    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pipeline');
        $this->load->model('Model_divisi');
        $this->load->model('Model_divisi');
    }

    public function index()
    {
        $data['halaman'] = 'Data Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pipeline'] = $this->Model_pipeline->getDataPipeline()->result();
        $data['userdata'] = $this->Model_pipeline->getDataByCabang($data['user']['kode_cabang'])->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pipeline/view_pipeline', $data);
        $this->load->view('templates/footer');
    }
    public function allpipeline()
    {
        $data['halaman'] = 'Data Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pipeline'] = $this->Model_pipeline->getDataPipeline()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pipeline/view_all_pipeline', $data);
        $this->load->view('templates/footer');
    }

    public function inputpipeline()
    {

        $data['halaman'] = 'Input Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cabang'] = $this->db->get('cabang')->result();
        $data['produk'] = $this->db->get('produk')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pipeline/input_pipeline', $data);
        $this->load->view('templates/footer');
    }

    public function editpipeline($id_pipline)
    {

        $data['halaman'] = 'Edit Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pipeline'] = $this->Model_pipeline->getByPipeline($id_pipline)->row_array();
        $data['produk'] = $this->db->get('produk')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pipeline/edit_pipeline', $data);
        $this->load->view('templates/footer');
    }

    public function simpanpipeline()
    {

        $data['halaman'] = 'Input Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cabang'] = $this->db->get('cabang')->result();

        $this->form_validation->set_rules('tgl_prospek', 'Tgl_prospek', 'required|trim', [
            'required' => 'Tanggal Prospek tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tlfunding', 'Tlfunding', 'required|trim', [
            'required' => 'Nama TL Funding tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('namaprospek', 'Namaprospek', 'required|trim', [
            'required' => 'Nama Prospek tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => 'Alamat tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nohp', 'Nohp', 'required|trim', [
            'required' => 'No Hp tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('prospek', 'Prospek', 'required|trim', [
            'required' => 'Prospek tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('produk', 'Produk', 'required|trim', [
            'required' => 'Produk tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pipeline/input_pipeline', $data);
            $this->load->view('templates/footer');
        } else {
            $config['upload_path']          = './uploads/prospek';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 30000;
            $config['max_width']            = 20000;
            $config['max_height']           = 20000;
            $config['file_name'] = 'doc' . time();
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
                Gambar gagal Upload...!!
                   </div>');
                redirect('pipeline');
            } else {
                $tgl_prospek = $this->input->post('tgl_prospek');
                $kode_cabang = $this->input->post('kode_cabang');
                $tlfunding = $this->input->post('tlfunding');
                $fofunding = $this->input->post('fofunding');
                $namaprospek = $this->input->post('namaprospek');
                $alamat = $this->input->post('alamat');
                $nohp = $this->input->post('nohp');
                $estimasiclosing = $this->input->post('estimasiclosing');
                $closing = $this->input->post('closing');
                $prospek = $this->input->post('prospek');
                $produk = $this->input->post('produk');
                $gambar = $this->upload->data();
                $gambar = $gambar['file_name'];
                $data = array(
                    'tgl_input' => date('Y-m-d'),
                    'tgl_prospek' => $tgl_prospek,
                    'kode_cabang' => $kode_cabang,
                    'tl_funding' => $tlfunding,
                    'funding_officer' => $fofunding,
                    'nama_prospek' => $namaprospek,
                    'alamat' => $alamat,
                    'nohp' => $nohp,
                    'estimasi_close' => $estimasiclosing,
                    'closing' => $closing,
                    'pipline' => $prospek,
                    'id_produk' => $produk,
                    'upload_img' => $gambar
                );

                $this->Model_pipeline->simpanpipeline($data);
                $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
           Data Telah Tersimpan...!!
         </div>');
                redirect('pipeline');
            }
        }
    }

    public function hapuspipeline()
    {
        $id_pipline = $this->uri->segment(3);
        $hapus = $this->Model_pipeline->deletePipeline($id_pipline);

        if ($hapus) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus..!!
          </div>');
            redirect('pipeline');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Gagal Dihapus..!!
          </div>');
            redirect('pipeline');
        }
    }

    function updatepipeline()
    {
        $data['halaman'] = 'Input Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['cabang'] = $this->db->get('cabang')->result();

        $this->form_validation->set_rules('produk', 'Produk', 'required|trim', [
            'required' => 'Produk tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pipeline/edit_pipeline', $data);
            $this->load->view('templates/footer');
        } else {
            $id_pipline = $this->input->post('id_pipline');
            $tgl_prospek = $this->input->post('tgl_prospek');
            $kode_cabang = $this->input->post('kode_cabang');
            $tlfunding = $this->input->post('tlfunding');
            $fofunding = $this->input->post('fofunding');
            $namaprospek = $this->input->post('namaprospek');
            $alamat = $this->input->post('alamat');
            $nohp = $this->input->post('nohp');
            $estimasiclosing = $this->input->post('estimasiclosing');
            $closing = $this->input->post('closing');
            $prospek = $this->input->post('prospek');
            $produk = $this->input->post('produk');
            $data = array(
                'id_pipline' => $id_pipline,
                'tgl_input' => date('Y-m-d'),
                'tgl_prospek' => $tgl_prospek,
                'kode_cabang' => $kode_cabang,
                'tl_funding' => $tlfunding,
                'funding_officer' => $fofunding,
                'nama_prospek' => $namaprospek,
                'alamat' => $alamat,
                'nohp' => $nohp,
                'estimasi_close' => $estimasiclosing,
                'closing' => $closing,
                'pipline' => $prospek,
                'id_produk' => $produk
            );
            $simpan = $this->Model_pipeline->updatetpipline($data, $id_pipline);
            if ($simpan) {
                $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
                Data Berhasil diupdate..!!
              </div>');
                redirect('pipeline');
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
                Data gagal diupdate..!!
              </div>');
                redirect('pipeline');
            }
        }
    }

    public function approvelpipeline()
    {
        $data['halaman'] = 'Data Pipeline';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pipeline'] = $this->Model_pipeline->getDataPipeline()->result();
        $data['userdata'] = $this->Model_pipeline->getDataByCabang($data['user']['kode_cabang'])->result();
        $data['status'] = $this->db->get('status')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pipeline/approvel_pipeline', $data);
        $this->load->view('templates/footer');
    }

    public function updateapprove()
    {
        $id_pipline = $this->input->post('id_pipline');
        $notepc = $this->input->post('notepc');
        $id_status = $this->input->post('status');
        $data = array(
            'NotePC' => $notepc,
            'id_status' => $id_status
        );
        $simpan = $this->Model_pipeline->updatetapprove($data, $id_pipline);
        if ($simpan) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Data Berhasil diupdate..!!
          </div>');
            redirect('pipeline/approvelpipeline');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Data gagal diupdate..!!
          </div>');
            redirect('pipeline/approvelpipeline');
        }
    }

    public function cetakpipeline()
    {
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 20,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);
        $pipeline = $this->Model_pipeline->getDataPipeline()->result();
        $data = $this->load->view('pipeline/cetak_pipeline', ['pipeline' => $pipeline], true);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetWatermarkText("confidential");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($data);

        $mpdf->Output();
    }

    public function cetakdetailpipeline($id_pipline)
    {
        // $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['pipeline'] = $this->Model_pipeline->getByPipeline($id_pipline)->row_array();;
        // $this->load->view('pipeline/CetakDetailPipeline', $data);

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 15,
            'margin_top' => 20,
            'margin_bottom' => 25,
            'margin_header' => 10,
            'margin_footer' => 10
        ]);

        $pipeline = $this->Model_pipeline->getByPipeline($id_pipline)->row_array();
        $cetak = $this->load->view('pipeline/CetakDetailPipeline', ['pipeline' => $pipeline], true);


        $mpdf->SetProtection(array('print'));
        $mpdf->SetWatermarkText("confidential");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($cetak);

        $mpdf->Output();
    }
}
