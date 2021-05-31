<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PkaBpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Pka_model");
        $this->load->model('Wilayah_model', 'wilayah');  
        $this->load->model('BPP_model', 'bpp');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $data["pkabpp"] = $this->Pka_model->getAll();
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pkabpp/list", $data);
        $this->load->view('templates/footer');
    }

    public function searchBPP()
    {
        $post = $this->input->post();
        if(($post['bpp_id'])=="") redirect('kinerjaBPP/PkaBpp');
        //if($bpp_id=="") redirect('kinerjaBPP/PgppBpp');
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $data["pkabpp"] = $this->Pka_model->getbyBPP();
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $data['bpp_detail'] = $this->bpp->getBPPbyID();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pkabpp/list", $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $pkabpp = $this->Pka_model;
        $validation = $this->form_validation;
        $validation->set_rules($pkabpp->rules());

        if($validation->run()) {
            $pkabpp->save();
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pkabpp/new_form");
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if(!isset($id)) redirect('kinerjaBPP/PkaBpp');

        $pkabpp = $this->Pka_model;
        $validation = $this->form_validation;
        $validation->set_rules($pkabpp->rules());

        if($validation->run()) {
            //$pgppbpp->update();
            if($pkabpp->update($id)){
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            } else {
                $this->session->set_flashdata('fail', 'Controller gagal menyimpan');
            }
        }

        $data["pkabpp"] = $pkabpp->getById($id);
        if(!$data["pkabpp"]) show_404();
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pkabpp/edit_form", $data);
        $this->load->view('templates/footer');
    }


 

    public function delete($id = null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Pka_model->delete($id)) {
            redirect(site_url('kinerjaBPP/PkaBpp'));
        }
    }




}    