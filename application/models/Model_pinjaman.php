<?php

class Model_pinjaman extends CI_Model
{
    function getDataPinjaman()
    {
        return $this->db->get('pinjaman');
    }

    function ImportData($datapinjaman)
    {
        $jumlah = count($datapinjaman);
        if ($jumlah > 0) {
            $this->db->replace('pinjaman', $datapinjaman);
        }
    }

    function hapusAllPinajaman()
    {
        $hapus = $this->db->empty_table('pinjaman');
        if ($hapus) {
            return 1;
        } else {
            return 0;
        }
    }

    function totalPinjaman($index_data = null)
    {
        $query = " SELECT pinjaman.`cabang`,SUM(fasilitas) AS tot_pinjaman
        FROM pinjaman
        WHERE cabang ='$index_data'";
        return $this->db->query($query);
    }

    function admintotalPinjaman()
    {
        $this->db->select("SUM(fasilitas) AS tot_pinjaman");
        $this->db->from('pinjaman');
        return $this->db->get();
    }

    function getPinjamanGrafik($index_data = null)
    {
        $tahun = date('Y');
        $query = "SELECT id_bulan,namabulan,tot_pinjaman,cabang FROM bulan
        LEFT JOIN(
        SELECT MONTH(tgl_pinjam)AS bulan,SUM(fasilitas) AS tot_pinjaman,cabang FROM pinjaman
        WHERE  YEAR(tgl_pinjam)='$tahun' AND cabang = '$index_data'
        GROUP BY MONTH(tgl_pinjam)
        )pnj ON (bulan.id_bulan = pnj.bulan)";

        return $this->db->query($query);
    }
    function getAdminPinjamanGrafik()
    {
        $tahun = date('Y');
        $query = "SELECT id_bulan,namabulan,tot_pinjaman FROM bulan
        LEFT JOIN(
        SELECT MONTH(tgl_pinjam)AS bulan,SUM(fasilitas) AS tot_pinjaman FROM pinjaman
         WHERE YEAR(tgl_pinjam) = '$tahun'
        GROUP BY MONTH(tgl_pinjam)
        )pnj ON (bulan.id_bulan = pnj.bulan)";

        return $this->db->query($query);
    }
}
