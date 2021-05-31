<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PPembelajaranBpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("PPembelajaran_model");
        $this->load->model('Wilayah_model', 'wilayah');  
        $this->load->model('BPP_model', 'bpp');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $data["ppembelajaranbpp"] = $this->PPembelajaran_model->getAll();
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/ppembelajaranbpp/list", $data);
        $this->load->view('templates/footer');
    }

    public function searchBPP()
    {
        $post = $this->input->post();
        if(($post['bpp_id'])=="") redirect('kinerjaBPP/PPembelajaranBpp');
        //if($bpp_id=="") redirect('kinerjaBPP/PgppBpp');
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $data["ppembelajaranbpp"] = $this->PPembelajaran_model->getbyBPP();
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $data['bpp_detail'] = $this->bpp->getBPPbyID();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/ppembelajaranbpp/list", $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $ppembelajaranbpp = $this->PPembelajaran_model;
        $validation = $this->form_validation;
        $validation->set_rules($ppembelajaranbpp->rules());

        if($validation->run()) {
            $ppembelajaranbpp->save();
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/ppembelajaranbpp/new_form");
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if(!isset($id)) redirect('kinerjaBPP/PPembelajaranBpp');

        $ppembelajaranbpp = $this->PPembelajaran_model;
        $validation = $this->form_validation;
        $validation->set_rules($ppembelajaranbpp->rules());

        if($validation->run()) {
            //$pgppbpp->update();
            if($ppembelajaranbpp->update($id)){
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            } else {
                $this->session->set_flashdata('fail', 'Controller gagal menyimpan');
            }
        }

        $data["ppembelajaranbpp"] = $ppembelajaranbpp->getById($id);
        if(!$data["ppembelajaranbpp"]) show_404();
        $data['title'] = 'Pusat Data & Informasi - BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/ppembelajaranbpp/edit_form", $data);
        $this->load->view('templates/footer');
    }


 

    public function delete($id = null)
    {
        if (!isset($id)) show_404();
        
        if ($this->PPembelajaran_model->delete($id)) {
            redirect(site_url('kinerjaBPP/PPembelajaranBpp'));
        }
    }




}    