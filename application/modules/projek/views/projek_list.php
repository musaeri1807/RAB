
<?php 

$menu = $this->uri->segment(1);
$id_menu = $this->db->get_where('menu', ['url' => $menu])->row_array()['id_menu'];
$id_role = $this->session->userdata('id_role');

$this->db->select('c, u ,d');
$this->db->where('id_menu', $id_menu);
$this->db->where('id_role', $id_role);
$access = $this->db->get('akses_role')->row_array();

?>

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
                        <?php if ($access['d']): ?>
                        <a href="javascrip:void(0)" class="btn btn-danger hapus_bulk"><i class="fa fa-trash"></i> Hapus Terpilih</a>
                        <?php endif ?>
                        <?php if ($access['c']): ?>
                            <a href="<?php echo base_url('projek/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="box-body">
             <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <form action="<?php echo site_url('projek/index'); ?>" class="form-inline" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                <span class="input-group-btn">
                                    <?php
                                    if ($q <> '') {
                                    ?>
                                        <a href="<?php echo site_url('projek'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                    }
                                    ?>
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
                            <?php if ($access['d']): ?>
                                <th><input type="checkbox" name="hapus_bulk" id="hapus_bulk" class="check_all"></th>
                            <?php endif ?>
                            
		<th>Nomor Projek</th>
		<th>Nama Projek</th>
		<th>Proses Bisnis</th>
		<th>Periode Projek</th>
		<th>Jenis Projek</th>
		<th>Penguna Projek</th>
		<th>Tujuan Projek</th>
		<th>Tanggal Lpj</th>
		<th>Target Projek</th>
		<th>Nilai Pengajuan</th>
		<th>Status</th>
		<th>Action</th>
                                        </tr><?php
                                        foreach ($projek_data as $projek)
                                        {
                                            ?>
                                            <tr>
			
                            <td><?php echo ++$start ?></td>
                            <?php if ($access['d']): ?>
                            <td><input type="checkbox" class="data_checkbox" name="data[]" value="<?php echo $projek->id_projek ?>"></td>
                            <?php endif ?>
                            <td><?php echo $projek->nomor_projek ?></td>
                            <td><?php echo $projek->nama_projek ?></td>
                            <td><?php echo $projek->proses_bisnis ?></td>
                            <td><?php echo $projek->periode_projek ?></td>
                            <td><?php echo $projek->jenis_projek ?></td>
                            <td><?php echo $projek->penguna_projek ?></td>
                            <td><?php echo $projek->tujuan_projek ?></td>
                            <td><?php echo $projek->tanggal_lpj ?></td>
                            <td><?php echo $projek->target_projek ?></td>
                            <td><?php echo number_format( $projek->nilai_pengajuan )?></td>
                            
                            <td><?php echo $projek->status ?></td><td>
                                        <a href="<?php echo site_url('projek/read/' . $projek->id_projek ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        <?php if ($access['u']): ?>
                                        <a href="<?php echo site_url('projek/update/' . $projek->id_projek ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <?php endif ?>
                                        <?php if ($access['d']): ?>
                                        <a data-href="<?php echo site_url('projek/delete/' . $projek->id_projek ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
                                        <?php endif ?>
                                     </td>
		</tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('projek/excel'), 'Excel', 'class="btn btn-success"'); ?>
	    
                        </div>
                        <div class="col-md-6 text-right">
                            <?php echo $pagination ?>
                        </div>
                    </div>
                 
            </div>
        </div>
    </div>
</div>

<script>
    const table_name = 'projek';
</script>
