
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
                        <?php echo anchor(site_url('transaksi/excel'), '<i class="fas fa-sign-out-alt"></i> Excel', 'class="btn btn-success"'); ?>
                        <?php echo anchor(site_url('transaksi/word'), '<i class="fas fa-sign-out-alt"></i> Word', 'class="btn btn-warning"'); ?>
                        
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt" width="100%" id="#mytable">
                       <thead>
                        <tr>
                            <th>No</th>
                            <th>Faktur</th>
                            <th>Kategori</th>
                            <th>Nis</th>
                            <th>Siswa</th>
                            <th>Tgl</th>
                            <th>Tahun Dibayar</th>
                            <th>Jumlah Dibayar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $(".dt").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "transaksi/json", "type": "POST"},
            columns: [
            {
                "data": "id_transaksi",
                "orderable": false
            },
            {"data": "no_faktur"},
            {"data": "nama_kategori"},
            {"data": "nis"},
            {"data": "nama_siswa"},
            {"data": "tgl"},
            {"data": "tahun_dibayar"},
            {
                "data": "jumlah_dibayar",
                render: $.fn.dataTable.render.number('.', '.', 0, '')
            },
            {
                "data": "status",
                render : function(data, type, row){
                    if(data == 'diterima'){
                        return '<button class="btn btn-success">DITERIMA</button>'
                    }else if(data == 'pending'){
                        return '<button class="btn btn-warning">PENDING</button>'
                    }else{
                        return '<button class="btn btn-danger">DITOLAK</button>'
                    }
                }
            },
            {
                "data" : "action",
                "orderable": false,
                "className" : "text-center"
            }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
      });

    });

</script>