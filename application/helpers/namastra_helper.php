<?php

function is_logged_in()
{

    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');

        $menu = $ci->uri->segment(1);

        $qeuryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();

        $menu_id = $qeuryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

if (!function_exists('format_indo')) {
    function format_indo($date)
    {
        date_default_timezone_set('Asia/Jakarta');
        // array hari dan bulan
        $Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

        // pemisahan tahun, bulan, hari, dan waktu
        $tahun = substr($date, 0, 4);
        $bulan = substr($date, 5, 2);
        $tgl = substr($date, 8, 2);
        $waktu = substr($date, 11, 5);
        $result =  $tgl . " " . $Bulan[(int)$bulan - 1] . " " . $tahun . " " . $waktu;

        return $result;
    }

    if (!function_exists('dateFormat')) {
        function dateFormat($format = 'd-m-Y', $givenDate = null)
        {
            return date($format, strtotime($givenDate));
        }
    }
}
