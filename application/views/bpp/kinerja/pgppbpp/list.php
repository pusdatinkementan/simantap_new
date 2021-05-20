<div class="container-fluid">

<!-- DataTables -->
<div class="card mb-3">
    <div class="card-header">
        <a href="<?php echo site_url('kinerjaBPP/PgppBpp/add') ?>"><i class="fas fa-plus"></i> Tambahkan </a>
    </div>
    <div class="card-body">

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