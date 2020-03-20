<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
      <div class="card">
      <div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; List Album Foto</h3>
				</div>
				<div class="d-inline-block float-right">
					<a href="<?= base_url('admin/gis/gis_album_add')?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
				 	</div>
			</div>
      <div class="card-body table-responsive">
        <table id="album" class="table table-bordered table-striped ">
          <thead>
            <tr> 
              <th>NO</th>
              <th>Judul Album</th>
              <th>Lokasi</th>
              <th>Tanggal</th> 
              <th>Opsi</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.box-body -->
      </div>
  </section> 
</div> 

<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  //---------------------------------------------------
  var table = $('#album').DataTable( {
  	"processing": true,
  	"serverSide": true,
  	"ajax": "<?=base_url('admin/gis/dt_album')?>",
  	"order": [[1,'ASC']],
  	"columnDefs": [
  	{ "targets": 0, "name": "nomor", 'searchable':false, 'orderable':true},
  	{ "targets": 1, "name": "judul_album", 'searchable':true, 'orderable':true},
  	{ "targets": 2, "name": "jumlah_foto", 'searchable':true, 'orderable':true},
  	{ "targets": 3, "name": "created_at", 'searchable':true, 'orderable':true}, 
  	{ "targets": 4, "name": "opsi", 'searchable':false, 'orderable':true}, 
  	]
  });   
  function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
  function hapus(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            var formData = {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            'id': id
            }
            $.ajax({
                url : "<?php echo base_url('admin/gis/gis_album_delete')?>",
                type: "POST",
                data: formData,
                dataType: "JSON",
                encode : true,
                success: function(data)
                {
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
    
        }
    }
 

  </script>
