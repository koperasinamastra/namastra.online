<?php

class Model_Menu extends CI_Model
{
    function getDataMenu()
    {
        return $this->db->get('user_menu');
    }

    function deleteMenu($id)
    {
        return $this->db->delete('user_menu', array('id' => $id));
    }
}
