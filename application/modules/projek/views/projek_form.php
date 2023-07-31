<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('projek') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group <?php if(form_error('nomor_projek')) echo 'has-error'?> ">
                                            <label for="nomor_projek">Nomor Projek</label>
                                            <input type="text" class="form-control" name="nomor_projek" id="nomor_projek" placeholder="Nomor Projek" value="<?php echo $nomor_projek; ?>" />
                                            <?php echo form_error('nomor_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('nama_projek')) echo 'has-error'?> ">
                                            <label for="nama_projek">Nama Projek</label>
                                            <input type="text" class="form-control" name="nama_projek" id="nama_projek" placeholder="Nama Projek" value="<?php echo $nama_projek; ?>" />
                                            <?php echo form_error('nama_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('proses_bisnis')) echo 'has-error'?> ">
                                            <label for="proses_bisnis">Proses Bisnis</label>
                                            <select name="proses_bisnis" id="proses_bisnis" class="form-control">
                                                    <option value="">--Pilih Jabatan--</option>
                                                    <?php foreach ($jabatan as $row): ?>
                                                    <option value="<?php echo $row['id_jabatan'] ?>" <?php echo set_value('id_jabatan') == $row['id_jabatan'] ? 'selected' : '' ?>><?php echo $row['nama_jabatan'] ?></option>
                                                    <?php endforeach ?>
                                            </select>
                                            <!-- <input type="text" class="form-control" name="proses_bisnis" id="proses_bisnis" placeholder="Proses Bisnis" value="<?php echo $proses_bisnis; ?>" /> -->
                                            <?php echo form_error('proses_bisnis', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('periode_projek')) echo 'has-error'?> ">
                                            <label for="periode_projek">Periode Projek</label>
                                            <input type="date" class="form-control" name="periode_projek" id="periode_projek" placeholder="Periode Projek" value="<?php echo $periode_projek; ?>" />
                                            <?php echo form_error('periode_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('jenis_projek')) echo 'has-error'?> ">
                                            <label for="jenis_projek">Jenis Projek</label>
                                            <input type="text" class="form-control" name="jenis_projek" id="jenis_projek" placeholder="Jenis Projek" value="<?php echo $jenis_projek; ?>" />
                                            <?php echo form_error('jenis_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('penguna_projek')) echo 'has-error'?> ">
                                            <!-- <label for="penguna_projek">Penguna Projek </label> -->
                                            <input type="hidden" class="form-control" name="penguna_projek" id="penguna_projek" placeholder="Penguna Projek" value="<?php echo $this->session->userdata('login'); ?>" />
                                            <?php echo form_error('penguna_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('tujuan_projek')) echo 'has-error'?> ">
                                            <label for="tujuan_projek">Tujuan Projek</label>
                                            <input type="text" class="form-control" name="tujuan_projek" id="tujuan_projek" placeholder="Tujuan Projek" value="<?php echo $tujuan_projek; ?>" />
                                            <?php echo form_error('tujuan_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('tanggal_lpj')) echo 'has-error'?> ">
                                            <label for="tanggal_lpj">Tanggal Lpj</label>
                                            <input type="date" class="form-control" name="tanggal_lpj" id="tanggal_lpj" placeholder="Tanggal Lpj" value="<?php echo $tanggal_lpj; ?>" />
                                            <?php echo form_error('tanggal_lpj', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('target_projek')) echo 'has-error'?> ">
                                            <label for="target_projek">Target Projek</label>
                                            <input type="date" class="form-control" name="target_projek" id="target_projek" placeholder="Target Projek" value="<?php echo $target_projek; ?>" />
                                            <?php echo form_error('target_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('nilai_pengajuan')) echo 'has-error'?> ">
                                            <label for="nilai_pengajuan">Nilai Pengajuan</label>
                                            <input type="text" class="form-control" name="nilai_pengajuan" id="nilai_pengajuan" placeholder="Nilai Pengajuan" value="<?php echo $nilai_pengajuan; ?>" />
                                            <?php echo form_error('nilai_pengajuan', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('status')) echo 'has-error'?> ">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                            <?php echo form_error('status', '<small style="color:red">','</small>') ?>
                                        </div>
	    <input type="hidden" name="id_projek" value="<?php echo $id_projek; ?>" /> 
	    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button> 
	</form>
                    </div>
                </div>
            </div>
            <div class="box-footer">
            </div>
        </div>
    </div>
</div>