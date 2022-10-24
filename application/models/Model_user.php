<?php

class Model_user extends CI_Model
{
    function getDataUser()
    {
        $query = "SELECT `user`.*,`role_id`.`role`
        FROM `user` JOIN `role_id`
        ON `user`.`role_id` = `role_id`.`id`
        ";

        return $this->db->query($query);
    }

    function getUser()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')]);
    }


    function insertUser($data)
    {
        return $this->db->insert('user', $data);
    }

    function deleteUser($id)
    {
        return $this->db->delete('user', array('id' => $id));
    }

    function getRole()
    {
        return $this->db->get('role_id');
    }

    function getProduk()
    {
        $query = "SELECT produk.`nama_produk`,SUM(pipeline.`estimasi_close`) AS tot_estimasi,SUM(pipeline.`closing`)AS tot_closing
        FROM pipeline
        INNER JOIN produk ON pipeline.`id_produk`=produk.`id_produk`
        GROUP BY produk.`nama_produk`";

        return $this->db->query($query);
    }
    function getProdukcab($index_data = null)
    {
        $query = "SELECT produk.`id_produk`,pipeline.`id_pipline`,produk.`nama_produk`,SUM(pipeline.`estimasi_close`) AS tot_estimasi,SUM(pipeline.`closing`)AS tot_closing
        FROM pipeline
        INNER JOIN produk ON pipeline.`id_produk`=produk.`id_produk`
        WHERE pipeline.`kode_cabang`='$index_data'
        GROUP BY produk.`nama_produk`";

        return $this->db->query($query);
    }
}
