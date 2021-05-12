<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();   
        $this->load->model('Wilayah_model', 'wilayah');     
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index2', $data);
        $this->load->view('templates/footer');
    }

    // public function iqfast()
    // {
    //     $data['title'] = 'Data PNBP Iqfast';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('admin/iqfast', $data);
    //     $this->load->view('templates/footer');
    // }

    public function rekapbpp()
    {
      
        $data['title'] = 'Rekap BPP';
        $data['q'] = $this->wilayah->getProv();
       //$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekapbpp', $data);
        $this->load->view('templates/footer');
    }


    public function caribpp($kab)
    {
        $postdata = http_build_query(
            array(
                'prop' => substr($kab,0,2).'00',
                'kab' => $kab    
                )
        );
          

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
          );

        $context  = stream_context_create($opts);
            
        $result = file_get_contents('https://app2.pertanian.go.id/simluh2014/api/bpp', false, $context);
   
        echo $result;
        //return $json; 
     
    }

    public function cari_pnbp($karantina,$d1,$d2)
    {
        $data['q'] = $karantina;
        $data['d1'] = $d1;
        $data['d2'] = $d2;

        $this->load->view('admin/pnbp_view', $data);
    }

    public function ajax_user_list()
    {
        $list = $this->usermodel->get_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $users) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $users->nama_user;
            $row[] = $users->nip;
            $row[] = $users->unitkerja;
            $row[] = $users->email;
            $row[] = $users->hp;
            $row[] = $users->created_at;
            $row[] = '<button type="button" id="btnHapusUser" data-id=' . $users->id . ' class="btn btn-danger btn-sm">Hapus</button>
                      <button type="button" id="btnEditUser" data-id=' . $users->id . ' class="btn btn-primary btn-sm">Edit</button>';     
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->usermodel->count_all(),
                        "recordsFiltered" => $this->usermodel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }



    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }
	
	public function test(){
		echo 'test';
	}
}
