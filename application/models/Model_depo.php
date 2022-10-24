<?php

class Model_depo extends CI_Model
{
    function getDataDepo()
    {
        return $this->db->get('deposito');
    }

    function getBulan()
    {
        return $this->db->get('bulan');
    }

    function ImportData($datadepo)
    {
        $jumlah = count($datadepo);
        if ($jumlah > 0) {
            $this->db->replace('deposito', $datadepo);
        }
    }

    function hapusAllDepo()
    {
        $hapus = $this->db->empty_table('deposito');
        if ($hapus) {
            return 1;
        } else {
            return 0;
        }
    }

    function totalDepo($index_data = null)
    {
        $query = " SELECT deposito.`cabang`,SUM(nominal) AS tot_depo
        FROM deposito
        WHERE cabang ='$index_data'";
        return $this->db->query($query);
    }

    function admintotalDepo($index_data = null)
    {
        $this->db->select("SUM(nominal) AS tot_depo");
        $this->db->from('deposito');
        return $this->db->get();
    }

    function getDepoGrafik($index_data = null)
    {
        $tahun = date('Y');
        $query = "SELECT id_bulan,namabulan,tot_nominal,cabang FROM bulan
        LEFT JOIN(
        SELECT MONTH(tgl_penempatan)AS bulan,SUM(nominal) AS tot_nominal,cabang FROM deposito
        WHERE  YEAR(tgl_penempatan)='$tahun' AND cabang = '$index_data'
        GROUP BY MONTH(tgl_penempatan)
        )pnj ON (bulan.id_bulan = pnj.bulan)";

        return $this->db->query($query);
    }

    function getadminDepoGrafik()
    {
        $tahun = date('Y');
        $query = "SELECT id_bulan,namabulan,tot_nominal FROM bulan
        LEFT JOIN(
        SELECT MONTH(tgl_penempatan)AS bulan,SUM(nominal) AS tot_nominal FROM deposito
        Where year(tgl_penempatan) = '$tahun'
        GROUP BY MONTH(tgl_penempatan)
        )pnj ON (bulan.id_bulan = pnj.bulan)";

        return $this->db->query($query);
    }
}
