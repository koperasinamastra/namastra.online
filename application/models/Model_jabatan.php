<?php

class Model_jabatan extends CI_Model
{
    function getDataJabatan()
    {
        return $this->db->get('jabatan');
    }
}
