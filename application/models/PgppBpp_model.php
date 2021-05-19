<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class PgppBpp_model extends CI_Model
{
    private $_table = "tr_pusat_gerakan_pembangunan_pertanian";

    public $id;
    public $tahun;
    public $bulan;
    public $bpp_id;
    public $jenis_kegiatan;
    public $nama_kegiatan;
    public $tempat_pelaksanaan;
    public $narasumber;
    public $materi_sektor;
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

            ['field' => 'bpp_id',
            'label' => 'BPP',
            'rules' => 'required'],

            ['field' => 'jenis_kegiatan',
            'label' => 'Jenis Kegiatan',
            'rules' => 'required'],

            ['field' => 'nama_kegiatan',
            'label' => 'Nama Kegiatan',
            'rules' => 'required'],

            ['field' => 'tempat_pelaksanaan',
            'label' => 'Tempat Pelaksanaan',
            'rules' => 'required'],
            
            ['field' => 'narasumber',
            'label' => 'Narasumber',
            'rules' => 'required'],

            ['field' => 'materi_sektor',
            'label' => 'Materi Sektor',
            'rules' => 'required'],

            ['field' => 'pembiayaan',
            'label' => 'Pembiayaan',
            'rules' => 'required'],


        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id = uniqid();
        $this->tahun = $post["tahun"];
        $this->bulan = $post["bulan"];
        $this->bpp_id = $post["bpp_id"];
        $this->jenis_kegiatan = $post["jenis_kegiatan"];
        $this->nama_kegiatan = $post["nama_kegiatan"];
        $this->tempat_pelaksanaan = $post["tempat_pelaksanaan"];
        $this->narasumber = $post["narasumber"];
        $this->materi_sektor = $post["materi_sektor"];
        $this->pembiayaan = $post["pembiayaan"];
        $this->foto = $post["foto"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->tahun = $post["tahun"];
        $this->bulan = $post["bulan"];
        $this->bpp_id = $post["bpp_id"];
        $this->jenis_kegiatan = $post["jenis_kegiatan"];
        $this->nama_kegiatan = $post["nama_kegiatan"];
        $this->tempat_pelaksanaan = $post["tempat_pelaksanaan"];
        $this->narasumber = $post["narasumber"];
        $this->materi_sektor = $post["materi_sektor"];
        $this->pembiayaan = $post["pembiayaan"];
        $this->foto = $post["foto"];
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($id)
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->status = 0;
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }
    



}