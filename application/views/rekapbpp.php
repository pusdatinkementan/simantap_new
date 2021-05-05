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

    <div class="col-lg-10">
    <?= form_open('admin/caribpp'); ?>
    <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Pilih Provinsi</label>
                <div class="col-sm-6">
                <select name="prov" id="prov" class="form-control" onchange="showKab()">
                <option value="">Select Province</option> 
                <?php
                foreach($q as $dtProv):
                ?>
                <option value="<?=$dtProv['kd_prov'];?>"><?=$dtProv['nm_prov'];?></option>                          
                <?php endforeach; ?>                  
                        </select>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-3 col-form-label">Pilih Kabupaten</label>
                <div class="col-sm-6">
                <select name="kab" id="kab" class="form-control">                                     
                
                        </select>
                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary" id="btncaribpp">Cari</button>
                </div>
            </div>
    </form>
    </div>

        <div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nama BPP</th>
                <th scope="col">ALamat</th>
                <th scope="col">Ketua</th>
                </tr>
            </thead>
            <tbody id="showResult">                
               
            </tbody>
            </table>
        
        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" id="exampleModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail BPP</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
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

function showKab()
  {
    const id = $('#prov').val();
     $.ajax({
		url:"<?=site_url()?>/wilayah/showKab/"+id+"",
		success: function(response){	
            //console.log(response);		
    		 $("#kab").html(response);
  		},
  		dataType:"html"  		
  	});
  	return false;
  }
 
</script>