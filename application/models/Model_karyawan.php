<?php

class Model_karyawan extends CI_Model
{
    function getDataKaryawan()
    {
        return $this->db->get('karyawan');
    }
}
