<?php
if(!function_exists('get_name_marketing')) {
    function get_name_marketing($idmarketing){
        $CI = &get_instance();
        $CI->load->database();

        $CI->db->select('nama');
        $CI->db->from('tb_marketing');
        $CI->db->where('id', $idmarketing);
        $query = $CI->db->get();

        if($query->num_rows() > 0) {
            $name = $query->row()->nama;
        } else {
            $name = NULL;
        }

        return $name;
    }
}

if(!function_exists('get_name_kustomer')) {
    function get_name_kustomer($idkustomer){
        $CI = &get_instance();
        $CI->load->database();

        $CI->db->select('nama');
        $CI->db->from('tb_kustomer');
        $CI->db->where('id', $idkustomer);
        $query = $CI->db->get();

        if($query->num_rows() > 0) {
            $name = $query->row()->nama;
        } else {
            $name = NULL;
        }

        return $name;
    }
}

if(!function_exists('get_name_marketing_from_kustomer')) {
    function get_name_marketing_from_kustomer($idkustomer){
        $CI = &get_instance();
        $CI->load->database();

        $CI->db->select('m.nama');
        $CI->db->from('tb_kustomer k');
        $CI->db->join('tb_marketing m', 'k.idmarketing = m.id', 'left');
        $CI->db->where('k.id', $idkustomer);
        $query = $CI->db->get();

        if($query->num_rows() > 0) {
            $name = $query->row()->nama;
        } else {
            $name = NULL;
        }

        return $name;
    }
}
?>