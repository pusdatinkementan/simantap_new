<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PgppBpp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("PgppBpp_model");
        $this->load->model('Wilayah_model', 'wilayah');  
        $this->load->model('BPP_model', 'bpp');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Pusat Gerakan Pembangunan Pertanian - BPP';
        $data["pgppbpp"] = $this->PgppBpp_model->getAll();
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pgppbpp/list", $data);
        $this->load->view('templates/footer');
    }

    public function searchBPP()
    {
        $post = $this->input->post();
        if(($post['bpp_id'])=="") redirect('kinerjaBPP/PgppBpp');
        //if($bpp_id=="") redirect('kinerjaBPP/PgppBpp');
        $data['title'] = 'Pusat Gerakan Pembangunan Pertanian - BPP';
        $data["pgppbpp"] = $this->PgppBpp_model->getbyBPP();
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $data['bpp_detail'] = $this->bpp->getBPPbyID();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pgppbpp/list", $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $pgppbpp = $this->PgppBpp_model;
        $validation = $this->form_validation;
        $validation->set_rules($pgppbpp->rules());

        if($validation->run()) {
            $pgppbpp->save();
            $this->session->set_flashdata('success', 'Data Berhasil disimpan');
        }
        $data['bpp'] = $this->bpp->getBPPbyWil();
        $data['title'] = 'Pusat Gerakan Pembangunan Pertanian - BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pgppbpp/new_form");
        $this->load->view('templates/footer');
    }

    public function edit($id = null)
    {
        if(!isset($id)) redirect('kinerjaBPP/PgppBpp');

        $pgppbpp = $this->PgppBpp_model;
        $validation = $this->form_validation;
        $validation->set_rules($pgppbpp->rules());

        if($validation->run()) {
            //$pgppbpp->update();
            if($pgppbpp->update($id)){
                $this->session->set_flashdata('success', 'Berhasil disimpan');
            } else {
                $this->session->set_flashdata('fail', 'Controller gagal menyimpan');
            }
        }

        $data["pgppbpp"] = $pgppbpp->getById($id);
        if(!$data["pgppbpp"]) show_404();
        $data['title'] = 'Pusat Gerakan Pembangunan Pertanian - BPP';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("bpp/kinerja/pgppbpp/edit_form", $data);
        $this->load->view('templates/footer');
    }


 

    public function delete($id = null)
    {
        if (!isset($id)) show_404();
        
        if ($this->PgppBpp_model->delete($id)) {
            redirect(site_url('kinerjaBPP/PgppBpp'));
        }
    }




}    