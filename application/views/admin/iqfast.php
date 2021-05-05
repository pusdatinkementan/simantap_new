<script type="text/javascript">
function showDataPnbp()
  {
	loadingproses();
    karantina = $('#InputKarantina').val();
    d1 = $('#dateFrom').val();
    d2 = $('#dateTo').val();
     $.ajax({
		url:"<?=site_url()?>Admin/cari_pnbp/"+karantina+"/"+d1+"/"+d2+"",
		success: function(response){
    		$("#showdata").html(response);
  		},
  		dataType:"html",		
		complete: function(response) {	
			loadingproses_close();
		}  		
		
  	});
  	return false;
  }

</script>

<style type="text/css">
	
	.backDrop{position:fixed; width:100%; height:100%; z-index:1051; background-color:#000; opacity:0.5; display:none; top: 0; left: 0;}
	.backDrop_content{position:fixed; width:100%; height:100%; z-index:1051; display:none; top:0; left: 0;}
	.backDrop_content>div{width:225px; height:45px; margin:0 auto; line-height:45px; margin-top: 19%; color:#fff; font-size:15pt;}

</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
    <form class="form-inline" action="<?=site_url()?>">
    <label for="karantina" class="col-sm-2 col-form-label">Karantina</label>
    <select class="form-control" id="InputKarantina" name="InputKarantina">
        <option value="tumbuhan">Tumbuhan</option>
        <option value="hewan">Hewan</option>
        </select>

    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
    <input type="text" name="dateFrom" class="form-control col-sm-2" placeholder="from" id="dateFrom" aria-label="datefrom" aria-describedby="basic-addon1">
        -
    <input type="text" name="dateTo" class="form-control col-sm-2" placeholder="to" id="dateTo" aria-label="dateto" aria-describedby="basic-addon1">
   
    <button type="button" class="btn btn-primary mb-2" id="btnCariPNBP" onClick="showDataPnbp()">Cari</button>
    </form>
    </div>

    <div class="row">
    <div class="table-responsive" id="showdata">

    </div>
    </div>

</div>

<div class="backDrop"></div>
			<div class="backDrop_content">
				<div>
					<img src="<?php echo base_url();?>/assets/img/ajax_loader.gif" style="margin-right: 20px" width="32px"> Processing Data...
				</div>
			</div>
			<script type="text/javascript">
				
				function loadingproses(){
					$('.backDrop').show();
					$('.backDrop_content').fadeIn('slow');
				}

				function loadingproses_close(){
					$('.backDrop').hide();
					$('.backDrop_content').fadeOut('slow');
				}

	</script> 	