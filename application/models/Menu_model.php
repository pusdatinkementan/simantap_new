<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";
        return $this->db->query($query)->result_array();
    }

    public function getSubMenuById($id)
    {
        $query = "SELECT * FROM user_sub_menu WHERE id = $id";
        return $this->db->query($query)->row_array();
    }

    public function getMasterMenu($id)
    {
        $query = "SELECT * FROM user_menu WHERE id = $id";
        return  $this->db->query($query)->row_array();
    }

    public function editMasterMenu($id, $menu)
    {
       
        $data = array(
            'menu' => $menu       
            );
           
            $this->db->where('id', $id);
            $this->db->update('user_menu', $data);
            return $this->db->affected_rows();
   
    }
}
