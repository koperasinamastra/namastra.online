<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class Deposito extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('Model_depo');
    }

    public function index()
    {
        $data['halaman'] = 'Data Deposito';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['deposito'] = $this->Model_depo->getDataDepo()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('deposito/view_deposito', $data);
        $this->load->view('templates/footer');
    }

    function uploaddata()
    {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::CreateXLSXReader();
            $reader->setShouldFormatDates(false); // default value
            $reader->setShouldFormatDates(true); // will return formatted dates
            $reader->open('upload/' . $file['file_name']);

            foreach ($reader->getSheetIterator() as $sheet) {
                $numrow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numrow > 1) {
                        $datadepo = array(
                            'id_depo' => $row->getCellAtIndex(0),
                            'no_anggota' => $row->getCellAtIndex(1),
                            'cabang' => $row->getCellAtIndex(2),
                            'Produk' => $row->getCellAtIndex(3),
                            'no_rekening' => $row->getCellAtIndex(4),
                            'nobilyet' => $row->getCellAtIndex(5),
                            'nama_anggota' => $row->getCellAtIndex(6),
                            'tgl_penempatan' => $row->getCellAtIndex(7),
                            'jangka_waktu' => $row->getCellAtIndex(8),
                            'jatem' => $row->getCellAtIndex(9),
                            'nominal' => $row->getCellAtIndex(10),
                        );

                        $this->Model_depo->ImportData($datadepo);
                    }
                    $numrow++;
                }
                $reader->close();
                unlink('upload/' . $file['file_name']);
                $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
                <!-- SVG icon code with class="mr-1" -->
                Data Berhasil Di import
              </div>');
                redirect('deposito');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            <!-- SVG icon code with class="mr-1" -->
            File belum di pilih....silahkan pilih File terlebih dahulu..!!
          </div>');
            redirect('deposito');
        };
    }

    function hapusDepoAll()
    {
        $hapus = $this->Model_depo->hapusAllDepo();
        if ($hapus) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success" role="alert">
            <!-- SVG icon code with class="mr-1" -->
            Semua data berhasil dihapus..!!!
          </div>'
            );
            redirect('deposito');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            <!-- SVG icon code with class="mr-1" -->
            Data gagal dihapus
          </div>');
        }
    }
}
