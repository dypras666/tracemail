<?php
/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 14:21:41
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-03-21 00:18:58
 */ 
?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.css">
<style type="text/css">
  .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #dcdcdc;
    border-radius: 0;
}
.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 40px;
    user-select: none;
    -webkit-user-select: none;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 38px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
} 
.modal-lg {
  max-width: 1000px
}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= trans('dashboard') ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('dashboard') ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $count_inbox;?></h3>

                <p>Surat Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer"><?= trans('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $count_outbox;?></h3>

                <p>Surat Keluar</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"><?= trans('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>1</h3>

                <p>Arsip Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><?= trans('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $count_inbox_bl;?></h3>

                <p>Surat Belum Diproses</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer"><?= trans('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-12">
     <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-envelope"></i>&nbsp; List Surat Masuk</h3>
        </div>
        <div class="d-inline-block float-right">
          <a href="#"   data-toggle="modal" data-target="#add" id="cancel" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
          </div>
      </div>
      <div class="card-body table-responsive">
        <table id="dt" class="table table-bordered table-striped " style="width:100%">
          <thead>
            <tr> 
              <th width="15">NO</th>
              <th width="50">Agenda</th>
              <th>NO Surat</th>
              <th>Perihal</th>
              <th width="150">Tanggal</th> 
              <th>Opsi</th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- /.box-body --> 
      </div>
          </div>
        </div>
        <!-- /.row --> 
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
     <div class="modal fade" id="add">
            <div class="modal-dialog modal-lg">

              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="modal-title"><i class="fa fa-plus"></i> Tambah Data </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php echo form_open("/",'id="add"') ?>
                <div class="modal-body"> 
                <div class="row ">
                 <div class="col-md-2  form-group ">
                  <label class="form-control-label"><?= trans('tmail_noagenda') ?>: <span class="tx-danger">*</span></label>
                  <input id="no-agenda-keluar" name="no_agenda" class="form-control"   placeholder="" type="text"  value="0" >
                </div>

                <div class="col-md-5   form-group">
                  <label class="form-control-label"><?= trans('tmail_nosurat') ?>: <span class="tx-danger">*</span></label>
                  <input id="kop-surat-keluar" name="kop_surat" class="form-control"   placeholder="" type="text"  >
                </div><!-- col -->

                <div class="col-md-5  mg-t-20 mg-md-t-0 form-group">
                  <label class="form-control-label"><?= trans('tmail_subject') ?>: <span class="tx-danger">*</span></label>
                  <input id="perihal-keluar" name="perihal" class="form-control"  placeholder=" " type="text"  >
                </div><!-- col -->
                </div>

              <div class="row ">
                <div class="col-md-2  form-group ">
                  <label class="form-control-label"><?= trans('tmail_jenis_surat') ?>: <span class="tx-danger">*</span></label>
                        <select id="cari_jenis" name="jenis_surat" class="form-control" style="width: 100%">
                          <option value="0">Jenis Surat</option> 
                        </select>    
                </div><!-- col -->

                <div class="col-md-2   mg-t-20 mg-md-t-0 form-group">
                  <label class="form-control-label"><?= trans('tmail_privacy') ?>: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="privasi_surat" id="privasi-surat-keluar">
                      <option value="rahasia">Rahasia</option>
                      <option value="internal">Internal</option>
                      <option value="umum">Umum</option> 
                    </select>
                </div><!-- col -->

                <div class="col-md-2  mg-t-20 mg-md-t-0 form-group">
                  <label class="form-control-label"><?= trans('tmail_date') ?> : <span class="tx-danger">*</span></label>
                  <input type="text" name="tanggal_surat" data-provide="datepicker" class="form-control fc-datepicker datepicker" id="tanggal-surat-keluar" value="<?= date('Y-m-d')?>">
                </div><!-- col -->

                <div class="col-md-3   mg-t-20 mg-md-t-0 form-group">
                  <label class="form-control-label"><?= trans('tmail_date_sent') ?>: <span class="tx-danger">*</span></label>
                  <input type="text"  name="tanggal_terima" data-provide="datepicker" class="form-control fc-datepicker datepicker" id="tanggal-terima-keluar" value="<?= date('Y-m-d')?>">
                </div><!-- col -->
        
                <div class="col-md-3   mg-t-20 mg-md-t-0 form-group">
                        <label class="form-control-label"><?= trans('tmail_type') ?> : </label>
                        <select  name="tipe_surat" id="tipe_surat" class="form-control" style="width: 100%">
                          <option value="surat-masuk">Surat Masuk</option> 
                          <option value="surat-keluar">Surat Keluar</option> 
                        </select>         
                </div><!-- col -->
                
                <div class="col-md-6   mg-t-20 mg-md-t-0 form-group">
                <label class="form-control-label"><?= trans('tmail_sender') ?>: <span class="tx-danger">*</span></label>  
                <select class="form-control select2" name="unit_pengirim" id="cari_unit_pengirim" style="width:100%">
                <option value="00">Cari Unit Pengirim </option>        
                </select>
                </div><!-- col -->
        

                <div class="col-md-6   mg-t-20 mg-md-t-0  form-group"  >
                <label class="form-control-label"><?= trans('tmail_recipient') ?> : <span class="tx-danger">*</span></label>  
                  <select class="form-control select2" name="unit_penerima" id="cari_unit_penerima" style="width:100%">
                   <option value="00">Cari Unit  Penerima</option>        
                  </select>          
                </div><!-- col --> 
                
                <div class="col-md-6 mg-t-20 mg-md-t-0 form-group" id="div-pengirim" style="display: none"  >
                  <label class="form-control-label"><?= trans('tmail_other') ?> : <span class="tx-danger"></span></label>  
                  <input id="pengirim-lain"  name="unit_pengirim_lainnya" class="form-control">
                </div>


                <div class="col-md-6   mg-t-20 mg-md-t-0  form-group" id="div-penerima" style="display: none"  >
                          <label class="form-control-label"><?= trans('tmail_other') ?> : <span class="tx-danger"></span></label>  
                  <input id="penerima-lain" name="unit_penerima_lainnya" class="form-control">
                </div>

                <div class="col-md-12  mg-t-20  form-group"   >
                  <label class="form-control-label"><?= trans('tmail_desc') ?> :  </label>  
                      <textarea rows="5" cols="15" name="keterangan_surat" id="keterangan-surat" class="form-control"></textarea>  
                  </div> 
                </div>
 
                </div>
                <div class="modal-footer ">
                  <input id="id" name="id"  type="hidden" class="form-control">
                  <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="submit" id="simpan-surat">Simpan</button>
                  <a class="btn btn-danger text-white" id="cancel">Batal</a>
                </div>
        <?php echo form_close(); ?>

              </div>
              <!-- /.modal-content -->

            </div>
            <!-- /.modal-dialog -->
          </div>




<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.js"></script>
<script>
  //---------------------------------------------------
  var table = $('#dt').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/tracemail/dt_inbox')?>",
    "order": [[0,'DESC']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':false, 'orderable':true},
    { "targets": 1, "name": "kop_surat", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "perihal", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "tanggal_agenda", 'searchable':true, 'orderable':true}, 
    { "targets": 4, "name": "opsi", 'searchable':false, 'orderable':true}, 
    ]
  });   
  function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
  
 
    $(document).ready(function(){

        $('#add').submit(function(e){
            e.preventDefault(); 
            var id= $('#id').val();
	    	var kop_surat	= $('#kop-surat-keluar').val();
	    	var no_agenda	= $('#no-agenda-keluar').val();
	    	var perihal 	= $('#perihal-keluar').val(); 
	    	var privasi_surat 	= $('#privasi-surat-keluar').val(); 
	    	var jenis_surat 	= $('#cari_jenis').val(); 
	    	var tanggal_surat 	= $('#tanggal-surat-keluar').val(); 
	    	var tanggal_terima	= $('#tanggal-terima-keluar').val(); 
	    	var unit_penerima 	= $('#cari_unit_penerima').val(); 
	    	var unit_pengirim 	= $('#cari_unit_pengirim').val(); 
	    	var tipe_surat 		= $('#tipe_surat').val(); 
	    	var form_data = new FormData();
	    	form_data.append('id', id); 
	    	form_data.append('kop_surat', kop_surat); 
	    	form_data.append('no_agenda', no_agenda); 
	    	form_data.append('perihal', perihal); 
	    	form_data.append('jenis_surat', jenis_surat); 
	    	form_data.append('unit_penerima', unit_penerima); 
	    	form_data.append('unit_pengirim', unit_pengirim); 
	    	form_data.append('privasi_surat', privasi_surat); 
	    	form_data.append('tanggal_surat', tanggal_surat); 
	    	form_data.append('tanggal_terima', tanggal_terima); 
	    	form_data.append('tipe_surat', tipe_surat); 
	    	form_data.append('<?php echo $this->security->get_csrf_token_name(); ?>',  '<?php echo $this->security->get_csrf_hash(); ?>' );  

	    	if(unit_pengirim == '00' || unit_penerima == "00"){
	    		Swal.fire( 'Gagal!', 'Unit Penerima/Pengirim tidak boleh kosong.', 'error'  );    
	    	}
	    	else if(jenis_surat == '0'){
	    		Swal.fire( 'Gagal!', 'Jenis Surat tidak boleh kosong.', 'error'  );    
	    	}
	    	else{
                 $.ajax({
                     url:'<?php echo base_url('admin/tracemail/inbox_save')?>',
                     type:"post",
                     data: form_data,
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                     beforeSend: function(e) {
                        $("#simpan-surat").addClass("disabled"); 
                     },   
                 success: function(data){ 
                        if(data.status === true){         
                            $('[name="no_agenda"]').val(""); 
                            $('[name="kop_surat"]').val("");   
                            $('[name="perihal"]').val("");   
                            $('[name="keterangan_surat"]').val("");   
                            $('[name="id"]').val("");  
                            table.ajax.reload( null, false );
                            $("#simpan-surat").removeClass("disabled"); 
                            $('#card-title').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire('Berhasil!',data.msg ,'success');     
                       }else{                   
                            $("#simpan-surat").removeClass("disabled"); 
                            table.ajax.reload( null, false );
                            $('#card-title').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire('Gagal!', data.msg , 'error');     
                       }
                    },
                 error: function (request, textStatus, errorThrown) { 
                          Swal.fire( 'Gagal!', 'Maaf terjadi kesalahan.', 'error'  );              
                          $("#simpan-surat").removeClass("disabled"); 
                        }
                 });

             } // end validate 

            });
      });


    //  cari data
    $("#cari_unit_penerima,#cari_unit_pengirim").select2({ 
         ajax: { 
           url: '<?= base_url('admin/tracemail/cari_unit');?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                searchTerm: params.term, // search term 
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     }); 

    $("#cari_jenis").select2({ 
         ajax: { 
           url: '<?= base_url('admin/tracemail/cari_jenis_surat');?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                searchTerm: params.term, // search term 
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     }); 

     //  show data
      $(document).ready(function(){
          $(document).on('click', '#show_data', function(e){
           $("#add").modal('show');
           e.preventDefault();
           var id = $(this).data('id'); 
           $.ajax({
                url: '<?php echo base_url('admin/tracemail/show_unit_mailbox')?>',
                type: 'POST',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', 
                    id:id,
                    
                },
                dataType: 'JSON',

                beforeSend: function(e) { 
                        $("#save").addClass("disabled"); 
                  },  

                success: function(data){
                        $.each(data,function(k,v){ 
                        $('[name="no_agenda"]').val(v.no_agenda); 
		                    $('[name="kop_surat"]').val(v.kop_surat);   
		                    $('[name="perihal"]').val(v.perihal);   
		                    $('[name="keterangan_surat"]').val(v.keterangan_surat);  
		                    $('[name="tanggal_terima"]').val(v.tanggal_terima);  
		                    $('[name="tanggal_surat"]').val(v.tanggal_surat);  
		                    $("#privasi-surat-keluar").val(v.privasi_surat.trim()).change();
		                    $("#tipe_surat").val(v.tipe_surat.trim()).change();
                        $('[name="id"]').val(v.id);
                           
          							var jenis     = new Option(v.jenis, v.jenis_surat, true, true);
                        var penerima = new Option(v.penerima, v.unit_penerima, true, true);
          							var pengirim = new Option(v.pengirim, v.unit_pengirim, true, true);

          							$('#cari_unit_penerima').append(penerima).trigger('change');
          							$('#cari_unit_pengirim').append(pengirim).trigger('change');
                        $('#cari_jenis').append(jenis).trigger('change');
								 

                        		});
                       	$('#modal-title').html('<i class="fa fa-edit"></i> Update Data '+data[0].kop_surat);
                        $("#save").removeClass("disabled"); 
                }
                })
                .done(function(data){
                                 
                }) 

          });

          $(document).on('click', '#cancel', function(e){
                    $('[name="no_agenda"]').val("0"); 
                    $('[name="kop_surat"]').val("");   
                    $('[name="perihal"]').val("");   
                    $('[name="keterangan_surat"]').val("");   
                    $('[name="id"]').val("");  
                    $("#save-surat").removeClass("disabled"); 
                    table.ajax.reload( null, false );
                    $('#modal-title').html('<i class="fa fa-plus"></i> Tambah Data');
          }); 
      });

       $("body").on("click",".delete",function(){
        Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Data ini akan dimasukkan ke Tongsampah!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Buang!'
            }).then((result) => {
              if (result.value) {          
                $.post('<?=base_url("admin/tracemail/delete_auto/mailbox")?>',
                {
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                  id : $(this).data('del'), 
                },
                function(data){ 
                  table.ajax.reload( null, false );
                  Swal.fire(
                  'Berhasil!',
                  'Data dimasukkan ke TongSampah.',
                  'success'
                  ); 
                });              
                              
              }
            })
       });    


  </script>
