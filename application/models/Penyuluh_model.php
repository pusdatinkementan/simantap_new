<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Penyuluh_model extends CI_Model
{
	var $api_key = 'f13914d292b53b10936b7a7d1d6f2406';
	var $api_url = 'https://api.pertanian.go.id/api/';
	
    public function getPenyuluhbysatminkal($satminkal='3404')
    {
		$json = file_get_contents($this->api_url.'simantap/penyuluhbysatminkal/list?satminkal='.$satminkal.'&api-key='.$this->api_key);
		return json_decode($json,true);
    }
	
	 public function getPenyuluhbynip($nip='')
    {
		$json = file_get_contents($this->api_url.'simantap/detailpenyuluh/list?nip='.$nip.'&api-key='.$this->api_key);
		return json_decode($json,true);
    }
}
