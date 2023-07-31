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
                                            
                                           
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group <?php if(form_error('id_projek')) echo 'has-error'?> ">
                                            <label for="id_projek">Id /Nomor Projek</label>

                                            <?php if ($action==site_url('projek_rincian/create_action')) {
                                                echo "create_action";
                                            ?>
                                                <select name="id_projek" id="id_projek" class="form-control">
                                                    <option value="">--Pilih Nomor Projek</option>
                                                    <?php foreach ($nprojek as $row): ?>
                                                    <option value="<?php echo $row['id_projek'] ?>" <?php echo set_value('id_projek') == $row['id_projek'] ? 'selected' : '' ?>><?php echo $row['nomor_projek'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            <?php
                                            }else{
                                                echo "update_action";
                                            ?>
                                           <input readonly type="hiiden" class="form-control" name="id_projek" id="id_projek" placeholder="Id Projek" value="<?php echo $id_projek; ?>" />
                                            <?php } ?>
                                           
                                            
                                            <?php echo form_error('id_projek', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('item')) echo 'has-error'?> ">
                                            <label for="item">Item</label>
                                            <input type="text" class="form-control" name="item" id="item" placeholder="Item" value="<?php echo $item; ?>" />
                                            <?php echo form_error('item', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('biaya')) echo 'has-error'?> ">
                                            <label for="biaya">Biaya</label>
                                            <input type="number" class="form-control" name="biaya" id="biaya" placeholder="Biaya" value="<?php echo $biaya; ?>" />
                                            <?php echo form_error('biaya', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('keterangan')) echo 'has-error'?> ">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo $keterangan; ?>" />
                                            <?php echo form_error('keterangan', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('status')) echo 'has-error'?> ">
                                            <label for="status">Status</label>
                                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
                                            <?php echo form_error('status', '<small style="color:red">','</small>') ?>
                                        </div>
	    <div class="form-group <?php if(form_error('persetujuan')) echo 'has-error'?> ">
                                            <label for="persetujuan">Persetujuan</label>
                                            <input type="text" class="form-control" name="persetujuan" id="persetujuan" placeholder="Persetujuan" value="<?php echo $persetujuan; ?>" />
                                            <?php echo form_error('persetujuan', '<small style="color:red">','</small>') ?>
                                        </div>
	    <input type="hidden" name="id_rincian" value="<?php echo $id_rincian; ?>" /> 
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