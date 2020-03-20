<link rel="stylesheet" href="<?= base_url()?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
              Tambah data Lokasi </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/gis/gis_lokasi_list'); ?>" class="btn btn-success"><i class="fa fa-list"></i> List Lokasi</a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="box">
                <!-- form start -->
                <div class="box-body">
                  <?php if(!empty($error)):
                    echo '<span class="alert alert-danger" style="display: block;">';
                    foreach ($error as $item => $value):?>
                      <?php echo $item;?>: <?php echo $value;?>
                    <?php endforeach; echo '</span>'; endif; ?>
                <?php echo form_open_multipart('admin/gis/gis_lokasi_add/', 'class="form-horizontal"');  ?> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Nama Tempat</label>
                    <div class="col-md-12">
                      <input type="text" name="nama_tempat" class="form-control" value="" id="judul_album" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Kecamatan & Desa</label>
                    <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="kecamatan" class="form-control" value=""  placeholder="Kecamatan">
                    </div>
                    <div class="col-md-6">          
                      <input type="text" name="desa" class="form-control" value=""  placeholder="Desa">            
                    </div>           
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Lat/Lang</label>
                    <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="lat" class="form-control" value="" id="lat" placeholder="Lat">
                    </div>
                    <div class="col-md-6">          
                      <input type="text" name="lng" class="form-control" value="" id="lng" placeholder="Lang">            
                    </div>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Variabel Lampu</label>
                    <div class="row">
                    <div class="col-md-3">
                      <input type="text" name="jenis_lampu" class="form-control" value=""  placeholder="Jenis Lampu">
                    </div>
                    <div class="col-md-3">          
                      <input type="number" name="daya" class="form-control" value=""  placeholder="daya">            
                    </div>     
                    <div class="col-md-3">          
                      <input type="number" name="jenis_ornamen" class="form-control" value=""  placeholder="Jenis ornamen">            
                    </div>        
                    <div class="col-md-3">          
                      <input type="number" name="meterisasi" class="form-control" value=""  placeholder="Meterisasi">            
                    </div>           
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Lokasi </label>
                    <div class="col-md-12">
                      <input type="text" name="lokasi" class="form-control" value="" id="lokasi" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Keterangan</label>
                    <div class="col-md-12">
                      <textarea  name="keterangan"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" class="textarea" placeholder=""> </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="username" class="col-md-12 control-label">Status</label>
                    <div class="col-md-12">
                      <select name="status" class="form-control">

                        <option value="baik" >Baik</option>
                        <option value="mati"  >Mati/Rusak</option>
                        <option value="perbaikan"  >Perbaikan</option>
                      </select>  </div>
                  </div>

                  
                </div>
                  <div class="form-group">  
                  <label for="keterangan" class="col-md-12 control-label">Cover Lokasi <small class="text-success"><?= trans('allowed_types') ?>: gif, jpg, png, jpeg, pdf</small></label>

                  <span id="filename">Cover Album</span>
                  <label for="file-upload">Browse<input type="file" name="userfile" id="file-upload"></label> 
                   </div>   
                  
                  <div class="form-group">
                    <div class="col-md-12">
                      <input type="submit" name="submit" value="Update " class="btn btn-primary pull-right">
                    </div>
                  </div>
                  <?php echo form_close(); ?>

 					</div>	
                </div>
                 <div class="col-md-6">
        <div id="map" style="height: 600px;"></div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>  
        </div>
      </div>
    </section> 
  </div>
<script src="<?= base_url()?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv3vyj8ICnb_9TPc0u4dHgypTcCsFPC80&language=id&region=ID"></script>
 
<script type="text/javascript">
 var defaultCenter = {
    lat :  <?= $this->general_settings['default_lat']; ?>, 
    lng : <?= $this->general_settings['default_lang']; ?> };
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
        content: '<h4>Drag untuk pindah lokasi</h4> <small> </small>'
    });
    
    infowindow.open(map, marker);
}

function handleEvent(event) {
    document.getElementById('lat').value = event.latLng.lat();
    document.getElementById('lng').value = event.latLng.lng();
}

$(function(){
    initMap();
})	;
$('#file-upload').change(function() {
		var filepath = this.value;
		var m = filepath.match(/([^\/\\]+)$/);
		var filename = m[1];
		$('#filename').html(filename);
	});
   $(function () { 

    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>