<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<!--
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
		 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />
    	<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script> 
	
	-->
	<link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
	
	
	
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#datatables').dataTable({
					/*
                     "sPaginationType":"full_numbers",
					"iDisplayLength": 50,
					"bPaginate":false,
                   	"bLengthChange": false,
    				"bFilter": true,
    				"bInfo": false, 
					*/
					//"pageLength" : 5,
					"processing":true,
					"serverSide":true,
				 	"ajax": {
						url : "<?php echo site_url("penyuluh/penyuluh_data/") ?>",
						type : 'GET'
					},
					
                });
			} );
		</script>
  
  
  
		
		
		
		

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>


            <table class="table table-hover display" id="datatables">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        
						<th scope="col">Nama Penyuluh/NIP</th>
						<th scope="col">Tanggal Lahir</th>
                        <th scope="col">Unit Kerja</th>                                           
                        <th scope="col">Wilayah Kerja</th>
						<th scope="col">Jumlah Poktan</th>    
						<th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!--
                    <tr>
                        <td scope="row" colspan="7" align="center"> -- Load data -- </td>
                       
                        
                    </tr>
					-->
                </tbody>
            </table>


        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->

<div class="modal fade " id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Pengisian Aktivitas Bulanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">
				<script type="text/javascript" charset="utf-8">
					
					$(function () {
						$('#myTab a:last').tab('show');
					  })
					$('#myTab a[href="#profile"]').tab('show'); // Select tab by name
					$('#myTab a:first').tab('show'); // Select first tab
					$('#myTab a:last').tab('show'); // Select last tab
					$('#myTab li:eq(2) a').tab('show'); // Select third tab (0-indexed)
				</script>
				
				
				<h2 class="h3 mb-0 text-gray-800">
					<span id="namalengkap"></span> / <span id="nip"></span>
				</h2>
				
				<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
					 <li class="active"><a style="margin:10px 10px;" href="#aktivitas" class="btn btn-primary" data-toggle="tab">Aktivitas Bulanan</a></li>
					 <li ><a style="margin:10px 10px;" href="#profil"  class="btn btn-info" data-toggle="tab">Profil Penyuluh</a></li>
					 
					   
				</ul>
				<div id="my-tab-content" class="tab-content">
					<div class="tab-pane active"  id="aktivitas">
						
					
						<form action="" method="post" class="user">
							<table class="table table-hover" >                
								<tbody>						
									<tr>
										<td align="left" width="30%" scope="row">Kelompok</td>
										<td align="left">
                                            <select class="form-control" id="opsipoktan">
                                                
                                            </select>
                                       </td>							
									</tr>	
									<tr>
										<td align="left" width="30%" scope="row">Jumlah Anggota</td>
										<td align="left"><strong>otomatis</strong></td>							
									</tr>	
									<tr>
										<td align="left" width="30%" scope="row">Metode</td>
										<td align="left">
											<select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
										</td>							
									</tr>
									<tr>
										<td align="left" width="30%" scope="row">Kategori Teknologi</td>
										<td align="left">
											<select class="form-control" name="teknologi_kategori">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
										</td>							
									</tr>
									<tr>
										<td align="left" width="30%" scope="row">Nama Teknologi</td>
										<td align="left">
											<input type="text" class="form-control form-control-user" name="teknologi_nama" id="exampleFirstName"	placeholder="Nama Teknologi"></td>							
									</tr>
									<tr>
										<td align="left" width="30%" scope="row">&nbsp;</td>
										<td align="left">
											<input type="submit" class="btn btn-primary mb-3" name="simpan" id="exampleFirstName"	value="simpan"></td>							
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<div class="tab-pane " id="profil">
						<table class="table table-hover" >                
							<tbody>				
								<tr>
									<td align="left" width="30%" scope="row">Nama Lengkap</td>
									<td align="left" width="5%" scope="row">:</td>
									<td align="left"><div id="namalengkap1"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">NIP</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="nip1"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Tempat Tanggal Lahir</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="ttl"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Jenis Kelamin</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="jenkel"></div></td>							
								</tr>
								<tr>
									<td align="left" scope="row">Alamat</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="alamat"></div></td>							
								</tr>
								<tr>
									<td align="left" scope="row">No HP</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="nohp"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Email</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="email"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Status</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="status"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Penempatan</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="penempatan"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Unit Kerja</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="unker"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Gol Ruang</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="golruang"></div></td>							
								</tr>	
								<tr>
									<td align="left" scope="row">Jabatan</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="jabatan"></div></td>							
								</tr>	
								
								<tr>
									<td align="left" scope="row">Wilayah Kerja</td>
									<td align="left" scope="row">:</td>
									<td align="left" ><div id="wilker"></div></td>							
								</tr>	
							</tbody>
						</table>
					</div>
				</div>
				
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		
        </div>
    </div>
</div> 

<script type="text/javascript" charset="utf-8">

	function viewdetail(id)
		{	
			//Ajax Load data from ajax
			$.ajax({
				//alert('a');
				url : "<?php echo base_url().'penyuluh/detail/'?>" + id,
				type: "GET",
				dataType:"json", 
				success: function(response)
				{
					var profil = response.profil;
					var aktivitas = response.aktivitas;
					var poktan = response.poktan;
					
					$('#detailModal').modal('show'); // show bootstrap modal when complete loaded
					$('#opsipoktan').html(poktan); 
					//$('#aktivitas').html(aktivitas); 
					$('#nip').text(profil.nip); 
					$('#namalengkap').text(profil.namalengkap); 
					$('#nip1').text(profil.nip); 
					$('#namalengkap1').text(profil.namalengkap); 
					$('#ttl').text(profil.ttl); 
					$('#jenkel').text(profil.jenkel); 
					$('#alamat').text(profil.alamat); 
					$('#nohp').text(profil.hp); 
					$('#email').text(profil.email); 
					$('#penempatan').text(profil.penempatan); 
					$('#status').text(profil.stat); 
					$('#golruang').text(profil.gol_ruang); 
					$('#jabatan').text(profil.jabatan); 
					$('#wilker').text(profil.wilkerja); 
					$('#unker').text(profil.unker); 
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax');
				}
			});
		}
		
		 $("#loading").ajaxStart(function(){
				  $(this).show();
			   }).ajaxStop(function(){
				  $(this).hide();
			   });
	</script>
	
	<div id="loading" style="position:fixed;
   top:40%;
   right:40%;
   background-color:#FFF;
   border:3px solid #000;
   padding:5px 7px;
   border-radius:5px;
   -moz-border-radius: 5px;
   -webkit-border-radius: 5px;
   z-index:3000;
   display:none;"><img src='http://fungsional.pertanian.go.id/assets/img/ajax_loader.gif' width="80px" /><br />Mohon Tunggu</div>
      