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
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              Tambah data Album </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/gis/gis_album'); ?>" class="btn btn-success"><i class="fa fa-list"></i> LIst Album</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- form start -->
                <div class="box-body">
                <?php if(!empty($error)):
 					echo '<span class="alert alert-danger" style="display: block;">';
 					foreach ($error as $item => $value):?>
 						<?php echo $item;?>: <?php echo $value;?>
 					<?php endforeach; echo '</span>'; endif; ?>
                  <!-- For Messages --> 

                  <?php echo form_open_multipart('admin/gis/gis_album_add', 'class="form-horizontal"');  ?> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Judul Album</label>

                    <div class="col-md-12">
                      <input type="text" name="judul_album" class="form-control" id="judul_album" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">  <label for="keterangan" class="col-md-12 control-label">Cover Album <small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg, pdf</small></label>

                  <span id="filename">Cover Album</span>
 					<label for="file-upload">Browse<input type="file" name="file" id="file-upload"></label> 
 					
                  </div>
                  <div class="form-group">
                    <label for="keterangan" class="col-md-12 control-label">Keterangan</label>

                    <div class="col-md-12">
                      <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="">
                    </div>
                  </div>
   
 
                  <div class="form-group">
                    <div class="col-md-12">
                      <input type="submit" name="submit" value="Tambah" class="btn btn-primary pull-right">
                    </div>
                  </div>
                  <?php echo form_close(); ?>
                  <?php if(!empty($upload_data)):
 						echo '<br><h3>Uploaded File Detail: </h3>';
 						foreach ($upload_data as $item => $value):?>
 							<li><?php echo $item;?>: <?php echo $value;?></li>
 						<?php endforeach; endif; ?>

 					</div>	
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>  
        </div>
      </div>
    </section> 
  </div>
  <script type="text/javascript">
	$('#file-upload').change(function() {
		var filepath = this.value;
		var m = filepath.match(/([^\/\\]+)$/);
		var filename = m[1];
		$('#filename').html(filename);
	});
</script>