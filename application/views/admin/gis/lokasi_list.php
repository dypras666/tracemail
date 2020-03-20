<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<style type="text/css">
  #file-upload {
    position: absolute;
    left: -9999px;
  }
    label[for="file-upload"] {
    padding: 6px;
    border: 1px solid #424242;
    display: inline-block;
    background: #424242;
    color: #fff;
    cursor: pointer;
    vertical-align: middle;
    }
  .btn-upload{
    padding:1em;  
    display:inline-block;
    background:#011401;
    color: #fff;
    cursor:pointer;
    margin-left: -5px;
    border: 0;
  }
     #filename {
      vertical-align: middle;
    padding: 6px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    float: left;
    margin-left: 7px;
    border: 1px solid #cacaca;
    width: 180px;
    white-space: nowrap;
    overflow: hidden;
    color: #343a40;
    background: #eaeaea;
    }
 </style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
  
     
      <div class="card">
      <div class="card-header">
				<div class="d-inline-block">
					<h3 class="card-title"><i class="fa fa-list"></i>&nbsp; List Lokasi</h3>
				</div>
				<div class="d-inline-block float-right">
        <form action="#" method="get" class=" "> 
         <label style="margin-bottom: 0" for="file-upload">Browse<input type="file" id="file-upload" name="file" id="file-upload"></label> 
         <span id="filename">File Excel (max 500 row)</span>  
         <a id="upload-file" href="#" class="btn btn-flat btn-primary"><i class="fa fa-upload"></i> Import Data</a>  
         <a href="<?= base_url('admin/gis/gis_lokasi_add')?>" class="btn  btn-flat btn-success"><i class="fa fa-plus"></i> Tambah Manual</a> 
        </form>
				 
				</div>
			</div>
        <div class="progress">
                  <div class="progress-bar  progress1 bg-primary progress-bar-striped" id="loader" role="progressbar"
                       aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"  >
                       <span id="text-loader"></span>
                  </div>
                </div> 
      <div class="card-body table-responsive">

        <table id="lokasi" class="table table-bordered table-striped " style="width: 100%">
          <thead>
            <tr> 
              <th>Nama</th>
              <th>Lat</th>
              <th>Lang</th>
              <th>Lokasi</th>
              <th>Status</th>
              <th>Created</th> 
              <th>Update</th> 
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
  var table = $('#lokasi').DataTable( {
  	"processing": true,
  	"serverSide": true,
  	"ajax": "<?=base_url('admin/gis/dt_lokasi')?>",
  	"order": [[0,'ASC']],
  	"columnDefs": [
  	{ "targets": 0, "name": "nama_tempat", 'searchable':true, 'orderable':true},
  	{ "targets": 1, "name": "lat", 'searchable':true, 'orderable':true},
  	{ "targets": 2, "name": "lng", 'searchable':true, 'orderable':true},
  	{ "targets": 3, "name": "lokasi", 'searchable':true, 'orderable':true},
  	{ "targets": 4, "name": "status", 'searchable':true, 'orderable':true},
  	{ "targets": 5, "name": "created_at", 'searchable':true, 'orderable':true},
  	{ "targets": 6, "name": "updated_at", 'searchable':false, 'orderable':false,'width':'100px'}
  	]
  });   


$("#upload-file").click(function() {
      $('.progress1').show();
      var width = 0;
      var delay = 2000;

      var i;
      var n = 0;
      var w = 0;
      var e = document.getElementById("loader"); 
      var file_data = $('#file-upload').prop('files')[0];
      var form_data = new FormData();
     
      form_data.append('file', file_data);
      form_data.append('<?php echo $this->security->get_csrf_token_name(); ?>','<?php echo $this->security->get_csrf_hash(); ?>');
      $.ajax({
        url     : '<?php echo base_url('admin/gis/gis_lokasi_import_excel');?>',
        dataType  : 'json', 
        cache   : false,
        contentType : false,
        processData : false,
                encode    : true,
        data    : form_data,
        type    : 'post',

        success: function (response) {
          var tot = response.data.length;
          var arr = response.data;

          $.each(arr,function(index,lampu){
            $('#upload-file').addClass('disabled');
            $.ajax({
              type  : 'POST',
              url   :  "<?= base_url('admin/gis/gis_lokasi_save');?>",
              dataType: 'json',
              data  : {
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
                id            :lampu[0], 
                kecamatan     :lampu[1], 
                desa          :lampu[2], 
                nama_tempat   :lampu[3], 
                lat           :lampu[4], 
                lng           :lampu[5], 
                jenis_lampu   :lampu[6], 
                daya          :lampu[7], 
                jenis_ornamen :lampu[8], 
                meterisasi    :lampu[9], 
                lokasi        :lampu[10], 
                keterangan    :lampu[11]
              },
              async: true,

              success: function(response){
                n++;
                i = (n/tot) * 100;
                e.style.width = i + '%'; 
                  $('#loader').css({
                      'width': n+" / "+tot
                  }); 
                  $('#text-loader').html('Sedang mengupload data ke '+ n+" dari "+tot);

                if(!response.data[0]) {
                  $('#lokasi-table tbody:last-child').append('<tr><td> ID : '+response.data[1]+' EROR</td></tr>');
                }

                if(n === tot) {
               $('#upload-file').removeClass('disabled');
                  setTimeout(function() {
                    $('.progress1').hide();
                    e.style.width = '0%';
                    table.ajax.reload();
                  }, delay);
                }
              }
            }); 
          });
          
        }, 
        error: function (response) {  alert('Error'); }
      });
    });

$('#file-upload').change(function() {
    var filepath = this.value;
    var m = filepath.match(/([^\/\\]+)$/);
    var filename = m[1];
    $('#filename').html(filename);
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
                url : "<?php echo base_url('admin/gis/gis_lokasi_delete')?>",
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
