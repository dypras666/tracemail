<style type="text/css">
 	#file-upload {
 		position: absolute;
 		left: -9999px;
 	}
     label[for="file-upload"] {
    padding: 10px;
    display: inline-block;
    background: #ce9c07;
    color: #fff;
    cursor: pointer;
    &: hover{;
    color: #fff;
    }: ;
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
    padding: 10px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    float: left;
    margin-left: 7px;
    width: 180px;
    white-space: nowrap;
    overflow: hidden;
    color: #343a40;
    background: #ffbd34;
    }
 </style>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content">
		<div class="row"> 
                    <div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h2>IMPORT FILE LOKASI </h2>
			</div>
		    <div class="card-body"> 
		    	<form action="#" method="get" class="form-horizontal">
                   <div class="form-group">  <label for="keterangan" class="col-md-12 control-label">File <small class="text-success"><?= trans('allowed_types') ?>: xls|xlsx|csv</small></label>
                  <span id="filename">File</span>
 					<label for="file-upload">Browse<input type="file" id="file-upload" name="file" id="file-upload"></label>  	 
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <a id="upload-file"href="#" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</a>
                    </div>
                  </div> 
              </form>
		    </div>
		</div>
		</div>
		<div class="col-md-8">
			  <div class="progress">
                  <div class="progress-bar  progress1 bg-primary progress-bar-striped" id="loader" role="progressbar"
                       aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"  >
                       <span id="text-loader"></span>
                  </div>
                </div> 
			<table id="lokasi-table" class="table table-bordered"><tbody></tbody></table>
		</div>
	</div>
	</section>
</div>

<script>
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
				url			: '<?php echo base_url('admin/gis/gis_lokasi_import_excel');?>',
				dataType	: 'json', 
				cache		: false,
				contentType	: false,
				processData	: false,
                encode 		: true,
				data 		: form_data,
				type 		: 'post',

				success: function (response) {
					var tot = response.data.length;
					var arr = response.data;

					$.each(arr,function(index,lampu){
						$.ajax({
							type	: 'POST',
							url		:  "<?= base_url('admin/gis/gis_lokasi_save');?>",
							dataType: 'json',
							data	: {
								<?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>',
								id 				:lampu[0], 
								kecamatan	 	:lampu[1], 
								desa			:lampu[2], 
								nama_tempat		:lampu[3], 
								lat 			:lampu[4], 
								lng		 		:lampu[5], 
								jenis_lampu		:lampu[6], 
								daya			:lampu[7], 
								jenis_ornamen	:lampu[8], 
								meterisasi		:lampu[9], 
								lokasi 			:lampu[10], 
								keterangan		:lampu[11]
							},

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
    $("#export").addClass('active');
</script>
