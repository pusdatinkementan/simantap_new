<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();   
        $this->load->model('Wilayah_model', 'wilayah');     
        //is_logged_in();
    }

    public function Profilbpp(){

        $data['title'] = 'Profil BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('bpp/profil', $data);
        $this->load->view('templates/footer');
    }
	
	public function test(){
		echo 'test 123';
	}

    public function oke(){
		echo 'ok 321';
	}

    public function Pusatgerakanpembangunan(){
		redirect(site_url('kinerjaBPP/PgppBpp'));
	}

    


    
}
