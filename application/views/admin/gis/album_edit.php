
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
      <div class="row">
        <div class="col-6">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-edit"></i>
              Update/Upload   Album </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/gis/gis_album'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Album</a>
          </div>
        </div>
        <div class="card-body"> 
              <div class="box">
                <!-- form start -->
                <div class="box-body">
                    <label>Cover Foto</label>
                <img src="<?= base_url('uploads/gis_album/'. $album[0]->foto_album); ?>" class="img-responsive img-fluid" width="100%">
                <hr>
              
                <?php if(!empty($error)):
       					echo '<span class="alert alert-danger" style="display: block;">';
       					foreach ($error as $item => $value):
                  echo $item;?>: <?php echo $value;
                endforeach; echo '</span>'; endif; ?> 

                  <?php echo form_open_multipart('admin/gis/gis_album_view/'.$album[0]->id_album, 'class="form-horizontal"');  ?> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Judul Album</label>
                    <div class="col-md-12">
                      <input type="text" name="judul_album" class="form-control" value="<?php echo $album[0]->judul_album; ?>" id="judul_album" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">  <label for="keterangan" class="col-md-12 control-label">Cover Album <small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg, pdf</small></label>

                  <span id="filename">Cover Album</span>
 					        <label for="file-upload">Browse<input type="file" name="userfile" id="file-upload"></label> 
 					
                  </div>
                  <div class="form-group">
                    <label for="keterangan" class="col-md-12 control-label">Lokasi</label>

                    <div class="col-md-12">
                      <select name="lokasi_album" class="form-control">
                        <?php foreach ($lokasi as $row) {
                          if($row->id_tempat == $album[0]->lokasi_album){ $select="selected='selected' "; } else { $select=''; }
                          echo "<option value='".$row->id_tempat."' ".$select.">" .$row->nama_tempat. "</option>";
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="keterangan" class="col-md-12 control-label">Keterangan</label>

                    <div class="col-md-12">
                      <input type="text" name="keterangan" value="<?php echo $album[0]->keterangan_album; ?>" class="form-control" id="keterangan" placeholder="">
                    </div>
                  </div>
   
 
                  <div class="form-group">
                    <div class="col-md-12">
                      <input type="submit" name="submit" value="Update Album " class="btn btn-primary pull-right">
                    </div>
                  </div>
                  <?php echo form_close(); ?>
                

 					      </div>	
                </div>
                <!-- /.box-body -->
              </div> 
               

            </div>



          </div>  

 
        <div class="col-6">   
            <div class="card card-default">
              <div class="card-header">
                <div class="card-title">
                  Ada <?= $total;  ?> Data Foto 
                </div>
              </div>
              <div class="card-body">
                 <?php echo form_open_multipart(base_url('admin/gis/gis_album_upload_gallery'), 'class="dropzone" id="myDropzone"');?>
                              <input type="file" name="files[]" class="hidden" multiple/>
                              <div class="dz-message">Upload Beberapa file disini</div>
                    <input type="hidden" name="id_album" value="<?= $album[0]->id_album;?>">
                    <?php echo form_close(); ?>
                    <p><small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg | <?= trans('max_allowed_size') ?> : 20 MB | <?= trans('max_files') ?> : 10</small></p>
                    </small></p>
                  <div class="alert alert-info">Silahkan klik foto untuk melihat lebih besar dan untuk menghapus file</div>
                <div class="row">
                  <?php foreach ($gallery as $row) { ?>   
                  <div class="col-sm-3">
                    <a href="<?= base_url($row->file_gallery)?>" data-toggle="lightbox" data-title="Tanggal Upload : <?= $row->created_at; ?>" data-gallery="gallery" data-footer="<a style='color:#fff'  onclick='hapus_foto(<?= $row->id_gallery;?>)' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i> Hapus</a>">
                      <img src="<?= base_url($row->file_gallery)?>" class="img-fluid mb-2"  style=" height:100px"/>
                    </a>
                  </div> 
                <?php  } ?>
                </div>
              </div> 
              <div id="map" style="height: 600px;"></div>
            </div>
      </div>
    </div>
      
    </div>
    </section> 
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv3vyj8ICnb_9TPc0u4dHgypTcCsFPC80&language=id&region=ID"></script>

  <script type="text/javascript">
    var defaultCenter = {
    lat : <?php echo $maps_lokasi[0]->lat; ?>, 
    lng : <?php echo $maps_lokasi[0]->lng; ?>};
function initMap() {
    
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: defaultCenter 
  });

  var marker = new google.maps.Marker({
    position: defaultCenter,
    map: map,
    icon: '<?= base_url('assets/front-themes/img/pins/Marker.png')?>',
    title: 'Click to zoom',
    draggable:true
  });
  
  
    marker.addListener('drag', handleEvent);
    marker.addListener('dragend', handleEvent);
    var infowindow = new google.maps.InfoWindow({
        content: '<h4><?php echo $maps_lokasi[0]->nama_tempat; ?></h4> <small><?php echo $lokasi[0]->lokasi; ?></small>'
    });
    
    infowindow.open(map, marker);
    
    
}

function handleEvent(event) {
    document.getElementById('lat').value = event.latLng.lat();
    document.getElementById('lng').value = event.latLng.lng();
}


$(function(){
    initMap();
})
	$('#file-upload').change(function() {
		var filepath = this.value;
		var m = filepath.match(/([^\/\\]+)$/);
		var filename = m[1];
		$('#filename').html(filename);
	});
   $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  });
     function hapus_foto(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            // ajax delete data to database
            var formData = {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            'id': id
            }
            $.ajax({
                url : "<?php echo base_url('admin/gis/gis_album_gallery_delete')?>",
                type: "POST",
                data: formData,
                dataType: "JSON",
                encode : true,
                success: function(data)
                {
                    location.reload();
                    // console.log(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
    
        }
    }

</script>