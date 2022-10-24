<?php
class Model_divisi extends CI_Model
{

    function get_divisi()
    {
        $hasil = $this->db->query("SELECT * FROM divisi");
        return $hasil;
    }

    function get_produk($id)
    {
        $hasil = $this->db->query("SELECT * FROM produk WHERE id_divisi='$id'");
        return $hasil->result();
    }
}
