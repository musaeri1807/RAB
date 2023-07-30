
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
                     <table class="table">
	    <tr><td>Nomor Projek</td><td><?php echo $nomor_projek; ?></td></tr>
	    <tr><td>Nama Projek</td><td><?php echo $nama_projek; ?></td></tr>
	    <tr><td>Proses Bisnis</td><td><?php echo $proses_bisnis; ?></td></tr>
	    <tr><td>Periode Projek</td><td><?php echo $periode_projek; ?></td></tr>
	    <tr><td>Jenis Projek</td><td><?php echo $jenis_projek; ?></td></tr>
	    <tr><td>Penguna Projek</td><td><?php echo $penguna_projek; ?></td></tr>
	    <tr><td>Tujuan Projek</td><td><?php echo $tujuan_projek; ?></td></tr>
	    <tr><td>Tanggal Lpj</td><td><?php echo $tanggal_lpj; ?></td></tr>
	    <tr><td>Target Projek</td><td><?php echo $target_projek; ?></td></tr>
	    <tr><td>Nilai Pengajuan</td><td><?php echo $nilai_pengajuan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>