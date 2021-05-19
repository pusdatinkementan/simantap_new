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
	
	public function detail($nip="")
    {
		$list = $this->penyuluh->getPenyuluhbynip($nip);
		$dt = $list[0];
		//print_r($dt);
		$myDateTime = DateTime::createFromFormat('Y-m-d', $dt['tgl_lahir']);
		$formatted = $myDateTime->format('d-m-Y');
		switch ($dt['kode_kab']){
			case 4 : $penempatan="Kecamatan";break;
			case 3 : $penempatan="Kabupaten";break;
			case 2 : $penempatan="Provinsi";break;
			default : $penempatan="";break;
		}
		switch ($dt['jenis_kelamin']){
			case 1 : $jenkel="Pria";break;
			case 2 : $jenkel="Wanita";break;			
			default : $jenkel="";break;
		}
		switch ($dt['status']) {
			case 0 : $status = 'Aktif';break;
			case 6 : $status = 'Tugas Belajar';break;
			case 7 : $status = 'CPNS';break;
			default : $status = '';break;
		}
		$w = '<ul>';
		foreach ($dt['wilker'] as $k => $v){			
			$w .= '<li>'.$v['nm_desa'].'</li>';
		}
		$w .= '</ul>';
		//print_r($list);
		$txt ='
				<table class="table table-hover" >                
					<tbody>						
						<tr>
							<td align="left" width="30%" scope="row">Nama Lengkap</td>
							<td align="left"><strong>'.$dt['namalengkap'].'</strong></td>							
						</tr>	
						<tr>
							<td align="left" width="30%" scope="row">NIP</td>
							<td align="left"><strong>'.$dt['nip'].'</strong></td>							
						</tr>	
						<tr>
							<td align="left" width="30%" scope="row">TTL</td>
							<td align="left"><strong>'.$dt['tempat_lahir'].', '.$formatted.'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Jenis Kelamin</td>
							<td align="left"><strong>'.$jenkel.'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Alamat</td>
							<td align="left"><strong>'.$dt['alamat'].'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">No HP</td>
							<td align="left"><strong>'.$dt['hp'].'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Email</td>
							<td align="left"><strong>'.$dt['email'].'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Penempatan</td>
							<td align="left"><strong>'.$penempatan.'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Unit Kerja</td>
							<td align="left"><strong>'.(($dt['kode_kab'] == '3') ? $dt['namabapel'] : $dt['namabpp']).'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Status</td>
							<td align="left"><strong>'.$status.'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Gol Ruang</td>
							<td align="left"><strong>'.$dt['gol_ruang'].'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Jabatan</td>
							<td align="left"><strong>'.$dt['jabatan'].'</strong></td>							
						</tr>
						<tr>
							<td align="left" width="30%" scope="row">Wilayah Kerja</td>
							<td align="left"><strong>'.$w.'</strong></td>							
						</tr>
					</tbody>
				</table>
		
					
					
					';
        echo $txt;
		exit();
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
	
	public function Aktivitas($nip="", $wilker="")
    {
		$list = $this->penyuluh->getPenyuluhbynip($nip);
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
    
}
