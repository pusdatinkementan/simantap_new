<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class PpembelajaranBpp_model extends CI_Model
{
    private $_table = "tr_pusat_pembelajaran";

    public $id;
    public $tahun;
    public $bulan;
    public $bpp_id;
    public $bpp_name;
    public $metode;
    public $nama_kegiatan;
    public $tempat_pelaksanaan;
    public $tanggal;
    public $sektor;
    public $peserta_poktan;
    public $peserta_petani;
    public $manfaat;
    public $potensi_peningkatan;
    public $pembiayaan;
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

            ['field' => 'metode',
            'label' => 'Metode',
            'rules' => 'required'],

            ['field' => 'nama_kegiatan',
            'label' => 'Nama Kegiatan',
            'rules' => 'required'],

            ['field' => 'tempat_pelaksanaan',
            'label' => 'Tempat Pelaksanaan',
            'rules' => 'required'],

            ['field' => 'tanggal',
            'label' => 'Tanggal',
            'rules' => 'required'],

            ['field' => 'sektor',
            'label' => 'Sektor',
            'rules' => 'required'],

            ['field' => 'peserta_poktan',
            'label' => 'Jumlah Peserta Poktan',
            'rules' => 'required'],

            ['field' => 'peserta_petani',
            'label' => 'Jumlah Peserta Petani',
            'rules' => 'required'],

            ['field' => 'manfaat',
            'label' => 'Manfaat',
            'rules' => 'required'],

            ['field' => 'potensi_peningkatan',
            'label' => 'Potensi Peningkatan',
            'rules' => 'required'],

            ['field' => 'pembiayaan',
            'label' => 'Pembiayaan',
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
        $this->metode = $post["metode"];
        $this->nama_kegiatan = $post["nama_kegiatan"];
        $this->tempat_pelaksanaan = $post["tempat_pelaksanaan"];
        $this->materi_sektor = $post["sektor"];
        $this->tanggal = $post["tanggal"];
        $this->peserta_poktan = $post["peserta_poktan"];
        $this->peserta_petani = $post["peserta_petani"];
        $this->manfaat = $post["manfaat"];
        $this->potensi_peningkatan = $post["potensi_peningkatan"];
        $this->pembiayaan = $post["pembiayaan"];
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
        $this->metode = $post["metode"];
        $this->nama_kegiatan = $post["nama_kegiatan"];
        $this->tempat_pelaksanaan = $post["tempat_pelaksanaan"];
        $this->materi_sektor = $post["sektor"];
        $this->tanggal = $post["tanggal"];
        $this->peserta_poktan = $post["peserta_poktan"];
        $this->peserta_petani = $post["peserta_petani"];
        $this->manfaat = $post["manfaat"];
        $this->potensi_peningkatan = $post["potensi_peningkatan"];
        $this->pembiayaan = $post["pembiayaan"];
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