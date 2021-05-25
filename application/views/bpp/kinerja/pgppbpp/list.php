<div class="container-fluid">

<!-- DataTables -->
<div class="card mb-3">
    <div class="card-header">
        <h3> BPP sebagai Pusat Gerakan Pengembangan Pertanian </h3>
    </div>
    <div class="card-body">
    <?php
            $throw = "";
            if(isset($_POST['bpp_id'])){
                $throw = $_POST['bpp_id'];
            }
            ?>
        <form action="<?php echo site_url('kinerjaBPP/PgppBpp/searchBPP/') ?>" method="post" enctype="multipart/form-data" >
            <div class="form-group">
                <label for="bpp_id">BPP</label>
                <select class="form-control" name="bpp_id" id="bpp_id">
                    <?php 
                    if($this->uri->segment(3)=="searchBPP") { ?><option value="<?php echo $bpp_detail['id'] ?>"> <?php echo $bpp_detail['nama_bpp'] ?> </option>
                    <?php } ?>
                    <option value=""> -- Filter -- </option>
                    <?php foreach ($bpp as $bpp_row) {
					?>	
                        <option value="<?php echo $bpp_row['id']?>"><?php echo $bpp_row['id'].'-'.$bpp_row['nama_bpp']?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            
            <input class="btn btn-success" type="submit" name="btn" value="Filter" />
        </form>    
        <a href="<?php echo site_url('kinerjaBPP/PgppBpp/add') ?>"><button class="btn btn-info" type="btn" name="btn"><i class="fas fa-plus"></i> Tambahkan </button></a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>BPP</th>
                        <th>Jenis Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th>Tempat Pelaksanaan</th>
                        <th>Narasumber</th>
                        <th>Materi Sektor</th>
                        <th>Pembiayaan</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pgppbpp as $row): ?>
                    <tr>
                        <td>
                            <?php echo $row->tahun ?>
                        </td>
                        <td>
                            <?php echo $row->bulan ?>
                        </td>
                        <td>
                            <?php echo $row->bpp_name ?>
                        </td>
                        <td>
                            <?php echo $row->jenis_kegiatan ?>
                        </td>
                        <td>
                            <?php echo $row->nama_kegiatan ?>
                        </td>
                        <td>
                            <?php echo $row->tempat_pelaksanaan ?>
                        </td>
                        <td>
                            <?php echo $row->narasumber ?>
                        </td>
                        <td>
                            <?php echo $row->materi_sektor ?>
                        </td>
                        <td>
                            <?php echo $row->pembiayaan ?>
                        </td>
                        <td>
                            <img src="<?php echo base_url('assets/img/bpp/'.$row->foto) ?>" width="64" />
                        </td>
                        <td width="250">
                            <a href="<?php echo site_url('kinerjaBPP/PgppBpp/edit/'.$row->id) ?>"
                             class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
                            <a onclick="deleteConfirm('<?php echo site_url('kinerjaBPP/PgppBpp/delete/'.$row->id) ?>')"
                             href="<?php echo site_url('kinerjaBPP/PgppBpp/delete/'.$row->id) ?>" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->