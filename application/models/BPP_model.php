<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class BPP_model extends CI_Model
{
	var $api_key = 'f13914d292b53b10936b7a7d1d6f2406';
	var $api_url = 'https://api.pertanian.go.id/api/';
	

    //https://api.pertanian.go.id/api/simantap/getbpp/list?kode=3404&api-key=f13914d292b53b10936b7a7d1d6f2406
    public function getBPPbyWil($wil='3401')
    {
      $json = file_get_contents($this->api_url.'simantap/getbpp/list?kode='.$wil.'&api-key='.$this->api_key);
      return json_decode($json,true);
    }
    
    public function getBPPbyID()
    {
      $post = $this->input->post();
      $id = $post['bpp_id'];
      $json = file_get_contents($this->api_url.'simantap/getbppbyid/list?id='.$id.'&api-key='.$this->api_key);
      return json_decode($json,true);
    }
	
}
