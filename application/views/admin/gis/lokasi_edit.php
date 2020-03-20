  
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
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-6">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-edit"></i>
              Update Lokasi </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/gis/gis_lokasi_list'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Data Lokasi</a>
          </div>
        </div>
        <div class="card-body"> 
              <div class="box">
                <!-- form start -->
                <div class="box-body">
                <?php echo form_open_multipart('admin/gis/gis_lokasi_view/'.$lokasi[0]->id_tempat, 'class="form-horizontal"');  ?> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Nama Tempat</label>
                    <div class="col-md-12">
                      <input type="text" name="nama_tempat" class="form-control" value="<?php echo $lokasi[0]->nama_tempat; ?>" id="judul_album" placeholder="">
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Kecamatan & Desa</label>
                    <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="kecamatan" class="form-control" value="<?php echo $lokasi[0]->kecamatan; ?>"  placeholder="Kecamatan">
                    </div>
                    <div class="col-md-6">          
                      <input type="text" name="desa" class="form-control" value="<?php echo $lokasi[0]->desa; ?>"  placeholder="Desa">            
                    </div>           
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Lat/Lang</label>
                    <div class="row">
                    <div class="col-md-6">
                      <input type="text" name="lat" class="form-control" value="<?php echo $lokasi[0]->lat; ?>" id="lat" placeholder="Lat">
                    </div>
                    <div class="col-md-6">          
                      <input type="text" name="lng" class="form-control" value="<?php echo $lokasi[0]->lng; ?>" id="lng" placeholder="Lang">            
                    </div>
                  </div>
                  </div>

                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Variabel Lampu</label>
                    <div class="row">
                    <div class="col-md-3">
                      <input type="text" name="jenis_lampu" class="form-control" value="<?php echo $lokasi[0]->jenis_lampu; ?>"  placeholder="Jenis Lampu">
                    </div>
                    <div class="col-md-3">          
                      <input type="number" name="daya" class="form-control" value="<?php echo $lokasi[0]->daya; ?>"  placeholder="daya">            
                    </div>     
                    <div class="col-md-3">          
                      <input type="number" name="jenis_ornamen" class="form-control" value="<?php echo $lokasi[0]->jenis_ornamen; ?>"  placeholder="Jenis ornamen">            
                    </div>        
                    <div class="col-md-3">          
                      <input type="number" name="meterisasi" class="form-control" value="<?php echo $lokasi[0]->meterisasi; ?>"  placeholder="Meterisasi">            
                    </div>           
                    </div>
                  </div> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Lokasi</label>
                    <div class="col-md-12">
                      <input type="text" name="lokasi" class="form-control" value="<?php echo $lokasi[0]->lokasi; ?>" id="lokasi" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label">Keterangan</label>
                    <div class="col-md-12">
                      <textarea  name="keterangan"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" class="textarea" placeholder=""><?php echo $lokasi[0]->keterangan; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="username" class="col-md-12 control-label">Status</label>
                    <div class="col-md-12">
                      <select name="status" class="form-control">

                        <option value="baik"  <?php if('baik' == $lokasi[0]->status){ echo "selected ";}?>>Baik</option>
                        <option value="mati"  <?php if('mati' == $lokasi[0]->status){ echo "selected ";}?>>Mati/Rusak</option>
                        <option value="perbaikan"  <?php if('perbaikan' == $lokasi[0]->status){ echo "selected";}?>>Perbaikan</option>
                      </select> 
                    </div>
                  </div>

                  <div class="form-group">   
                      <div class="col-md-12">
                        <a href="<?= base_url('uploads/gis_tempat/')?><?php echo $lokasi[0]->gambar; ?>" data-toggle="lightbox" data-title=" " data-gallery="gallery" > 
                  <img src="<?= base_url('uploads/gis_tempat/')?><?php echo $lokasi[0]->gambar; ?>" class="img-rounded elevation-2" width="200">
                </a></div> 
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
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <div id="map" style="height: 600px;"></div>
        <hr>
          <div class="card card-default">
              <div class="card-header">
                <div class="card-title">
                  Foto Terkait
                </div>
              </div>
              <div class="card-body">
               <div class="alert alert-info">Silahkan klik foto untuk melihat lebih besar dan untuk menghapus file</div>
                <div class="row">
                  <?php foreach ($gallery as $row) { ?>   
                  <div class="col-sm-3">
                    <a href="<?= base_url($row->file_gallery)?>" data-toggle="lightbox" data-title="Tanggal Upload : <?= $row->created_at; ?>" data-gallery="gallery" data-footer="">
                      <img src="<?= base_url($row->file_gallery)?>" class="img-fluid mb-2"  style=" height:100px"/>
                    </a>
                  </div> 
                <?php  } ?>
                </div>
              </div>
      </div>
        </div>
  </div>
      </div>
      </div>
    </section>
 
<script src="<?= base_url()?>/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDv3vyj8ICnb_9TPc0u4dHgypTcCsFPC80&language=id&region=ID"></script>
 
<script type="text/javascript">
 var defaultCenter = {
    lat : <?php echo $lokasi[0]->lat; ?>, 
    lng : <?php echo $lokasi[0]->lng; ?>};
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
        content: '<h4>Drag untuk pindah lokasi</h4> <small><?php echo $lokasi[0]->lokasi; ?></small>'
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
       $(function () { 

    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
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
    </script>