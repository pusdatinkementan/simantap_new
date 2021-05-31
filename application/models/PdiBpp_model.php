<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class PdiBpp_model extends CI_Model
{
    private $_table = "tr_pusatdata_informasi";

    public $id;
    public $tahun;
    public $bulan;
    public $bpp_id;
    public $bpp_name;
    public $tipe_data_info;
    public $infolain;
    public $ket_foto;
    public $kebaruan_info;
    public $foto = "default.jpg";
    public $status = 1;

    public function rules()
    {
        return [
            ['field' => 'tahun',
            'label' => 'Tahun',
            'rules' => 'required'],

            ['field' => 'bulan',
            'label' => 'Bulan',
            'rules' => 'required'],

            ['field' => 'bpp',
            'label' => 'BPP',
            'rules' => 'required'],

            ['field' => 'tipe_data_info',
            'label' => 'Jenis Kegiatan',
            'rules' => 'required'],

            ['field' => 'ket_foto',
            'label' => 'Keterangan Foto',
            'rules' => 'required'],

            ['field' => 'kebaruan_info',
            'label' => 'Kebaruan Informasi',
            'rules' => 'required']        
        ];
    }

    public function getAll()
    {
        return $this->db->get_where($this->_table, ["status" => 1])->result();
    }

    public function getByBPP()
    {
        $post = $this->input->post();
        $bpp_id = $post["bpp_id"];
        return $this->db->get_where($this->_table, ["bpp_id" => $bpp_id, "status" => 1])->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        //$this->id = uniqid();
        $this->tahun = $post["tahun"];
        $this->bulan = $post["bulan"];
        $this->bpp_id = $post["bpp_id"];
        $this->bpp_name = $post["bpp_name"];
        $this->tipe_data_info = $post["tipe_data_info"];
        $this->infolain = $post["infolain"];
        $this->ket_foto = $post["ket_foto"];
        $this->kebaruan_info = $post["kebaruan_info"];
        $this->foto = $this->_uploadImage();
        return $this->db->insert($this->_table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->tahun = $post["tahun"];
        $this->bulan = $post["bulan"];
        $this->bpp_id = $post["bpp_id"];
        $this->bpp_name = $post["bpp_name"];
        $this->tipe_data_info = $post["tipe_data_info"];
        $this->infolain = $post["infolain"];
        $this->ket_foto = $post["ket_foto"];
        $this->kebaruan_info = $post["kebaruan_info"];
        //$this->foto = $post["foto"];
        if (!empty($_FILES["foto"]["name"])) {
            $this->foto = $this->_uploadImage();
        } else {
            $this->foto = $post["old_image"];
        }
        //return print_r($post);
        //$this->db->where('id', $this->id);
        //$this->db->update($this->_table, $this);
        //return $this->db->affected_rows();
        return $this->db->update($this->_table, $this, array('id' => $id));
        //return $this->db->update($this->_table, $this, array("id" => $post["id"]));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
    
    private function _uploadImage()
    {
        $config['upload_path']          = './assets/img/bpp/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $this->id.$this->nama_kegiatan;
        $config['overwrite']			= true;
        $config['max_size']             = 2048; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }



}