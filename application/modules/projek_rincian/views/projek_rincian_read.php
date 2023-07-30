
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
                        <a href="<?php echo base_url('projek_rincian') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>Id Projek</td><td><?php echo $id_projek; ?></td></tr>
	    <tr><td>Item</td><td><?php echo $item; ?></td></tr>
	    <tr><td>Biaya</td><td><?php echo $biaya; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Persetujuan</td><td><?php echo $persetujuan; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>