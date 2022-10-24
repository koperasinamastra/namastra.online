<?php

class Model_Submenu extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                FROM `user_sub_menu` JOIN `user_menu`
                ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";

        return $this->db->query($query);
    }

    function getMenu()
    {
        return $this->db->get('user_menu');
    }

    function insertSubmenu($data)
    {
        $simpan = $this->db->insert('user_sub_menu', $data);
        if ($simpan) {
            return 1;
        } else {
            return 0;
        }
    }

    function deleteSubmenu($id)
    {
        return $this->db->delete('user_sub_menu', array('id' => $id));
    }
}
