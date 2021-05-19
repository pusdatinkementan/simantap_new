<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }


    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function editsubmenu($id){

            $data['title'] = 'Edit Submenu';

            $data['subMenu'] = $this->menu->getSubMenuById($id);
            $data['menu'] = $this->db->get('user_menu')->result_array();
            // print_r($data['subMenu']);

            if($_POST){

                $data = [
                    'title' => $this->input->post('title'),
                    'menu_id' => $this->input->post('menu_id'),
                    'url' => $this->input->post('url'),
                    'icon' => $this->input->post('icon'),
                    'is_active' => $this->input->post('is_active')
                ];
                $this->db->where('id', $id);
                $this->db->update('user_sub_menu', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub menu edited!</div>');
                redirect('menu/submenu');

            }else{

                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('menu/editsubmenu', $data);
                $this->load->view('templates/footer');
            }
    
    }

    public function editmenu($id){

        $data['title'] = 'Edit Menu';

        $data['menu'] = $this->menu->getMasterMenu($id);

        if($_POST){

           // echo "aaa"; die;
            $data = array(
                'menu' => $this->input->post('menu')      
                );
               
                $this->db->where('id', $id);
                $this->db->update('user_menu', $data);

               // print_r($data); die;

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">menu edited!</div>');

                redirect('menu');

        }else{

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer');

        }      
      

    }

    public function deletemenu($id){

        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil di hapus</div>');
        redirect('menu');

    }

    public function deletesubmenu($id){

        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu berhasil di hapus</div>');
        redirect('menu/submenu');

    }
}
