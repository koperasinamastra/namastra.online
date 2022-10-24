<?php

function check_access($id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
