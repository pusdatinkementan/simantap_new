<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIP</th>
						<th scope="col">Nama Penyuluh</th>
						<th scope="col">Tanggal Lahir</th>
                        <th scope="col">Unit Kerja</th>
						
                        <th scope="col">Status</th>                        
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($penyuluh as $p) { 
						$myDateTime = DateTime::createFromFormat('Y-m-d', $p['tgl_lahir']);
						$formatted = $myDateTime->format('d-m-Y');
						switch ($p['status']) {
							case 0 : $status = 'Aktif';break;
							case 6 : $status = 'Tugas Belajar';break;
							case 7 : $status = 'CPNS';break;
							default : $status = '';break;
						}
					?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $p['nip']; ?></td>
                        <td><?= $p['namalengkap']; ?></td>
						<td><?= $p['tempat_lahir'].', '.$formatted; ?></td>
                        <td><?= (($p['kode_kab'] == '3') ? $p['bapel'] : $p['nama_bpp']); ?></td>                        
                        <td><?= $status; ?></td>
                        <td>
                        
							<a title="Lihat Bukti Fisik" class="btn btn-primary mb-3" data-toggle="modal" style="cursor: pointer;" onclick="viewdetail('<?php echo $p['nip']; ?>')">Detail</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php } ?>
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
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Detail Penyuluh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div> 

<script type="text/javascript" charset="utf-8">
		function viewdetail(nip)
		{	
			//Ajax Load data from ajax
			$.ajax({
				//alert('a');
				url : "<?php echo base_url().'penyuluh/detail/'?>" + nip,
				type: "GET",
				success: function(data)
				{
					$('#detailModal').modal('show'); // show bootstrap modal when complete loaded
					$('#fillx').html(data); // Set title to Bootstrap modal title
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error get data from ajax');
				}
			});
		}
		
	</script>