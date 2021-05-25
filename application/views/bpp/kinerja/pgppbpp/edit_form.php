<div class="container-fluid">

<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success" role="alert">
    <?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>
<?php if ($this->session->flashdata('fail')): ?>
<div class="alert alert-danger" role="alert">
    <?php echo $this->session->flashdata('fail'); ?>
</div> 
<?php endif; ?>

<div class="card mb-3">
    <div class="card-header">
        <a href="<?php echo site_url('kinerjaBPP/PgppBpp') ?>"><i class="fas fa-arrow-left"></i> Back</a>
    </div>
    <div class="card-body">

        <form action="<?php base_url("kinerjaBPP/PgppBpp/edit") ?>" method="post" enctype="multipart/form-data" >

        <input type="hidden" name="id" value="<?php echo $pgppbpp->id?>" />
        
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select class="form-control <?php echo form_error('tahun') ? 'is-invalid':'' ?>" name="tahun" id="tahun">
                    <option value="2021">2021</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('tahun') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bulan">Bulan</label>
                <select class="form-control <?php echo form_error('bulan') ? 'is-invalid':'' ?>" name="bulan" id="bulan">
                    <option value="<?php echo $pgppbpp->bulan ?>"> Bulan <?php echo $pgppbpp->bulan ?> </option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('bulan') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="bpp_id">BPP</label>
                <input type="hidden" name="bpp_name" value="<?php echo $pgppbpp->bpp_name?>" />
                <input type="hidden" name="bpp_id" value="<?php echo $pgppbpp->bpp_id?>" />
                <select class="form-control <?php echo form_error('bpp') ? 'is-invalid':'' ?>" name="bpp" id="bpp">
                    <option value="<?php echo $pgppbpp->bpp_id ?>"> <?php echo $pgppbpp->bpp_name ?> </option>
                </select>
                <div class="invalid-feedback">
                    <?php echo form_error('bpp') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="jenis_kegiatan">Jenis Kegiatan</label>
                <select class="form-control <?php echo form_error('jenis_kegiatan') ? 'is-invalid':'' ?>" name="jenis_kegiatan" id="jenis_kegiatan">
                    <option value="<?php echo $pgppbpp->jenis_kegiatan ?>"> <?php echo $pgppbpp->jenis_kegiatan ?> </option>
                    <option value="Sosialisasi">Sosialisasi</option>
                    <option value="Rapat Bulanan BPP">Rapat Bulanan BPP</option>
                    <option value="Temu Koordinasi">Temu Koordinasi</option>
                    <option value="Webinar/Video Conference (Daring)">Webinar/Video Conference (Daring)</option>
                    <option value="Pendampingan Program/Kegiatan">Pendampingan Program/Kegiatan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('jenis_kegiatan') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input class="form-control <?php echo form_error('nama_kegiatan') ? 'is-invalid':'' ?>" value="<?php echo $pgppbpp->nama_kegiatan ?>" name="nama_kegiatan" id="nama_kegiatan">     
                <div class="invalid-feedback">
                    <?php echo form_error('nama_kegiatan') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="tempat_pelaksanaan">Tempat Pelaksanaan</label>
                <select class="form-control <?php echo form_error('tempat_pelaksanaan') ? 'is-invalid':'' ?>" name="tempat_pelaksanaan" id="tempat_pelaksanaan">
                    <option value="<?php echo $pgppbpp->tempat_pelaksanaan ?>"> <?php echo $pgppbpp->tempat_pelaksanaan ?> </option>
                    <option value="BPP">BPP</option>
                    <option value="Kantor Dinas Pertanian / Peternakan / Ketahanan Pangan">Kantor Dinas Pertanian / Peternakan / Ketahanan Pangan</option>
                    <option value="Lokasi Petani / Poktan / Gapoktan / KEP">Lokasi Petani / Poktan / Gapoktan / KEP</option>
                    <option value="Lainnya">Lainnya</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('tempat_pelaksanaan') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="narasumber">Narasumber</label>
                <select class="form-control <?php echo form_error('narasumber') ? 'is-invalid':'' ?>" name="narasumber" id="narasumber">
                    <option value="<?php echo $pgppbpp->narasumber ?>"> <?php echo $pgppbpp->narasumber ?> </option>
                    <option value="Pusat">Pusat</option>
                    <option value="Dinas">Dinas</option>
                    <option value="Perbankan">Perbankan</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Lainnya">Lainnya</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('narasumber') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="materi_sektor">Materi / Sektor</label>
                <select class="form-control <?php echo form_error('materi_sektor') ? 'is-invalid':'' ?>" name="materi_sektor" id="materi_sektor">
                    <option value="<?php echo $pgppbpp->materi_sektor ?>"> <?php echo $pgppbpp->materi_sektor ?> </option>
                    <option value="Tanaman Pangan">Tanaman Pangan</option>
                    <option value="Hortikultura">Hortikultura</option>
                    <option value="Peternakan dan Keswan">Peternakan dan Keswan</option>
                    <option value="Perkebunan">Perkebunan</option>
                    <option value="Ketahanan Pangan">Ketahanan Pangan</option>
                    <option value="SDM dan Kelembagaan">SDM dan Kelembagaan</option>
                    <option value="Alsintan">Alsintan</option>
                    <option value="E - RDKK">E - RDKK</option>
                    <option value="Pemanfaatan Aplikasi">Pemanfaatan Aplikasi</option>
                    <option value="Kredit Usaha Rakyat">Kredit Usaha Rakyat</option>
                    <option value="Asuransi">Asuransi</option>
                    <option value="Food Estate">Food Estate</option>
                    <option value="Lainnya">Lainnya</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('materi_sektor') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="pembiayaan">Pembiayaan Kegiatan</label>
                <select class="form-control <?php echo form_error('pembiayaan') ? 'is-invalid':'' ?>" name="pembiayaan" id="pembiayaan">
                    <option value="<?php echo $pgppbpp->pembiayaan ?>"> <?php echo $pgppbpp->pembiayaan ?> </option>
                    <option value="APBN">APBN</option>
                    <option value="APBD Prov">APBD Prov</option>
                    <option value="APBD Kab/Kota">APBD Kab/Kota</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Lainnya">Lainnya</option>
                </select>        
                <div class="invalid-feedback">
                    <?php echo form_error('pembiayaan') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="foto">Foto Kegiatan</label>
                <input type="hidden" name="old_image" value="<?php echo $pgppbpp->foto ?>">
                <input class="form-control-file <?php echo form_error('foto') ? 'is-invalid':'' ?>"
                 type="file" name="foto" />
                <div class="invalid-feedback">
                    <?php echo form_error('foto') ?>
                </div>
            </div>

            <input class="btn btn-success" type="submit" name="btn" value="Save" />
        </form>

    </div>


</div>
<!-- /.container-fluid -->
