<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();   
        $this->load->model('Wilayah_model', 'wilayah');     
        //is_logged_in();
    }

    public function showKab($id){

        $data['q'] = $this->wilayah->getKab($id);
        
        foreach($data['q'] as $dtKab){

            echo '<option value="'.$dtKab['kd_kab'].'">'.$dtKab['nm_kab'].'</option>';

        }
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
