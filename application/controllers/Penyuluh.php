<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyuluh extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();   
        $this->load->model('Wilayah_model', 'wilayah');     
        $this->load->model('Penyuluh_model', 'penyuluh');
		//$this->output->enable_profiler();
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
	
	public function detail($id="")
    {
		$list = $this->penyuluh->getPenyuluhbyid($id);
		$dt = $list[0];
		
		
		//print_r($dt);
		$myDateTime = DateTime::createFromFormat('Y-m-d', $dt['tgl_lahir']);
		$formatted = $myDateTime->format('d-m-Y');
		$dt['ttl'] = $dt['tempat_lahir'].', '.$formatted;
		switch ($dt['jenis_kelamin']){
			case 1 : $dt['jenkel']="Pria";break;
			case 2 : $dt['jenkel']="Wanita";break;			
			default : $dt['jenkel']="";break;
		}
		
		
		switch ($dt['kode_kab']){
			case 4 : $dt['penempatan']="Kecamatan";break;
			case 3 : $dt['penempatan']="Kabupaten";break;
			case 2 : $dt['penempatan']="Provinsi";break;
			default : $dt['penempatan']="";break;
		}
		
		switch ($dt['status']) {
			case 0 : $dt['stat'] = 'PNS Aktif';break;
			case 6 : $dt['stats'] = 'Tugas Belajar';break;
			case 7 : $dt['stat'] = 'CPNS';break;
			default : $dt['stat'] = '';break;
		}
		$w = '';
		$desa = array();
		foreach ($dt['wilker'] as $k => $v){
			$w .= $v['nm_desa'];
			$desa[] = $v['id_desa'];
		}
		$dt['wilkerja'] = $w;
		$dt['unker'] = (($dt['kode_kab'] == '3') ? $dt['namabapel'] : $dt['namabpp']);
        $data['profil'] = $dt;
		$iddesa = implode('m',$desa);
		
		$getpoktan = $this->penyuluh->getPoktan($iddesa);
		$opsipoktan = "<option value=''>-pilih poktan-</option>";
		foreach ($getpoktan as $p){
			$opsipoktan .= "<option value='".$p['id_poktan']."'>".$p['nama_poktan']."</option>";
		}
		$data['poktan'] = $opsipoktan;
		//$data['aktivitas'] = 'hae'; 
		echo json_encode($data);
    }

   public function Aktivitasbulanan(){
		$data['title'] = 'Aktivitas Bulanan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $data['penyuluh'] = $this->penyuluh->getPenyuluhbysatminkal();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('penyuluh/profil', $data);
		$this->load->view('templates/footer');
   }
	
	public function Aktivitas($code="")
    {
		$kode = explode("zz",$code);
		$id=$kode[0];
		$wilker=$kode[1];
		//$list = $this->penyuluh->getPenyuluhbynip($nip);
		//$list = $this->penyuluh->getPenyuluhbyid($id);
		$dt = $list[0];
		//print_r($dt);
		
		//print_r($list);
		$txt ='
				<table class="table table-hover" >                
					<tbody>						
						<tr>
							<td align="left" width="30%" scope="row">Kelompok</td>
							<td align="left"><strong>'.$wilker.'</strong></td>							
						</tr>	
						<tr>
							<td align="left" width="30%" scope="row">Jumlah Anggota</td>
							<td align="left"><strong>otomatis</strong></td>							
						</tr>	
						<tr>
							<td align="left" width="30%" scope="row">Metode</td>
							<td align="left"><strong>dropdown</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Kategori Teknologi</td>
							<td align="left"><strong>Pilih</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Nama teknologi</td>
							<td align="left"><strong>input</strong></td>							
						</tr>
						
					</tbody>
				</table>
		
					
					
					';
        echo $txt;
		exit();
    }
    
	public function penyuluh_data()
    {
		$kode='3404'; //disesuaikan dengan daerahnya
		  
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

		$penyuluh = $this->penyuluh->getPenyuluhbysatminkal();
		
		$data = array();
		$data1 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
	  
		$no = 1;
        foreach($penyuluh as $p) {
		  	$myDateTime = DateTime::createFromFormat('Y-m-d', $p['tgl_lahir']);
			$formatted = $myDateTime->format('d-m-Y');
			switch ($p['status']) {
				case 0 : $status = 'Aktif';break;
				case 6 : $status = 'Tugas Belajar';break;
				case 7 : $status = 'CPNS';break;
				default : $status = '';break;
			}
			$dtwilker = array();
			
			$wilker = explode(',',$p['wilker']);
			foreach ($wilker as $k => $v){			
				if (trim($v) <> '')
					$dtwilker[] = trim($v);
			}
			if (count($dtwilker) > 0) {
				//find wilker
				$wil = implode('m',$dtwilker);
				$dwilker = $this->penyuluh->getwilker($wil);
				$awilker = array();
				$jumpoktan=0;
				foreach ($dwilker as $key => $val) {
					$awilker[] = $val['nm_desa']; 
					$jumpoktan += $val['jumlah'];
				}
				$namawilker = implode('<br /> ',$awilker);
				
			}
			else {
				$namawilker = '';
				$jumpoktan = '';
			}
			
			$idwil = $p['idpns'].'zz'.$wil;
            $data[$no-1] = array(
				$no,
				$p['namalengkap'].'<br />'.$p['nip'],
                $p['tempat_lahir'].', '.$formatted,
                (($p['kode_kab'] == '3') ? $p['bapel'] : $p['nama_bpp']),
                $namawilker,			
				$jumpoktan,
				'<a style="color:#fff" title="Detail Penyuluh" id="popup" class="btn btn-primary mb-3" data-toggle="modal" style="cursor: pointer;" onclick="viewdetail('.$p['idpns'].')">Detail</a>
				'
               );
			   //<a style="color:#fff" title="Aktivitas Bulanan" id="popup" class="btn btn-primary mb-3" data-toggle="modal" style="cursor: pointer;" onclick="viewaktivitas('.$idwil.')">Aktivitas Bulanan</a>
			   
			$no++;
          }
			//print_r($data);die();	
          $output = array(
               "draw" => $draw,
                 "recordsTotal" => count($penyuluh),
                 "recordsFiltered" => count($penyuluh),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
     }
}
