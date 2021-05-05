<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah_model extends CI_Model
{
    public function getProv()
    {
        $query = "SELECT * FROM tblm_prov ORDER BY kd_prov";
        return $this->db->query($query)->result_array();
    }

    public function getKab($id)
    {
        $query = "SELECT * FROM tblm_kab WHERE kd_kab LIKE '".$id."%' ORDER BY kd_kab";
        return $this->db->query($query)->result_array();
    }

    public function getKec($id)
    {
        $query = "SELECT * FROM tblm_kec WHERE kd_kec LIKE '".$id."%' ORDER BY kd_kec";
        return $this->db->query($query)->result_array();
    }

    public function getDesa($id)
    {
        $query = "SELECT * FROM tblm_desa WHERE kd_desa LIKE '".$id."%' ORDER BY kd_desa";
        return $this->db->query($query)->result_array();
    }
}
