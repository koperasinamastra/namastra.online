<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Reader\Common\Creator\ReaderFactory;

class Pinjaman extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pinjaman');
    }

    public function index()
    {
        $data['halaman'] = 'Data Pinjaman';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pinjaman'] = $this->Model_pinjaman->getDataPinjaman()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pinjaman/view_pinjaman', $data);
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
                        $datapinjaman = array(
                            'id_pinjaman' => $row->getCellAtIndex(0),
                            'no_pasilitas' => $row->getCellAtIndex(1),
                            'no_anggota' => $row->getCellAtIndex(2),
                            'cabang' => $row->getCellAtIndex(3),
                            'no_perjanjian' => $row->getCellAtIndex(4),
                            'produk_pinjaman' => $row->getCellAtIndex(5),
                            'nama_anggota' => $row->getCellAtIndex(6),
                            'tgl_pinjam' => $row->getCellAtIndex(7),
                            'jatem' => $row->getCellAtIndex(8),
                            'jangka_waktu' => $row->getCellAtIndex(9),
                            'fasilitas' => $row->getCellAtIndex(10),
                            'saldo_akhir' => $row->getCellAtIndex(11),
                            'nama_ao' => $row->getCellAtIndex(12),
                        );

                        $this->Model_pinjaman->ImportData($datapinjaman);
                    }
                    $numrow++;
                }
                $reader->close();
                unlink('upload/' . $file['file_name']);
                $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
                <!-- SVG icon code with class="mr-1" -->
                Data Berhasil Di import
              </div>');
                redirect('pinjaman');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            <!-- SVG icon code with class="mr-1" -->
            File belum di pilih....silahkan pilih File terlebih dahulu..!!
          </div>');
            redirect('pinjaman');
        };
    }

    function hapusPinjamanAll()
    {
        $hapus = $this->Model_pinjaman->hapusAllPinajaman();
        if ($hapus) {
            $this->session->set_flashdata(
                'massage',
                '<div class="alert alert-success" role="alert">
            <!-- SVG icon code with class="mr-1" -->
            Semua data berhasil dihapus..!!!
          </div>'
            );
            redirect('pinjaman');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            <!-- SVG icon code with class="mr-1" -->
            Data gagal dihapus
          </div>');
            redirect('pinjaman');
        }
    }
}
