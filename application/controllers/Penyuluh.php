<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyuluh extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();   
        $this->load->model('Wilayah_model', 'wilayah');     
        $this->load->model('Penyuluh_model', 'penyuluh');
    }

    public function profil(){

        $data['title'] = 'Profil Penyuluh';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        

        $data['penyuluh'] = $this->penyuluh->getPenyuluhbysatminkal();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('penyuluh/profil', $data);
		$this->load->view('templates/footer');
        
    }
	
	public function detail($nip="")
    {
		$list = $this->penyuluh->getPenyuluhbynip($nip);
		$txt = 'hae';
        echo $txt;
    }

    public function showKec($id){

        $data['q'] = $this->wilayah->getKec($id);

        foreach($data['q'] as $dtKec){

            echo '<option value="'.$dtKec['kd_kec'].'">'.$dtKec['nm_kec'].'</option>';

        }
    }

    public function showDesa($id){

        $data['q'] = $this->wilayah->getDesa($id);

        foreach($data['q'] as $dtDesa){

            echo '<option value="'.$dtDesa['kd_desa'].'">'.$dtDesa['nm_desa'].'</option>';

        }
    }

    
}
