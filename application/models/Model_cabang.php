<?php

class Model_cabang extends CI_Model
{
    function getDataCabang()
    {
        return $this->db->get('cabang');
    }
}
