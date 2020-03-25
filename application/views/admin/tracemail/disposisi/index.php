<?php
/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 14:21:41
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-03-25 11:55:29
 */ 
?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.css">
<style type="text/css">
  .table th, .table td {
  vertical-align: middle; 
}
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Disposisi Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('tracemail') ?></li>
              <li class="breadcrumb-item active">Disposisi</li>
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
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $c_sudah?></h3>

                <p>Sudah Diproses</p>
              </div>
              <div class="icon">
                <i class="fa fa-check"></i>
              </div> 
            </div>           
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $c_tolak?></h3>

                <p>Ditolak</p>
              </div>
              <div class="icon">
                <i class="fa fa-times"></i>
              </div> 
            </div>           
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $c_belum?></h3>

                <p>Belum Diproses</p>
              </div>
              <div class="icon">
                <i class="fa fa-info-circle"></i>
              </div> 
            </div>           
          </div>
          <!-- ./col --> 

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3><?= $c_all?></h3>

                <p>Semua Disposisi</p>
              </div>
              <div class="icon">
                <i class="fa fa-sign-in"></i>
              </div> 
            </div>           
          </div>

          <div class="col-12">
               <div class="card">
                <div class="card-header">
                  <div class="d-inline-block">
                    <h3 class="card-title"><i class="fa fa-university"></i>&nbsp; Data Status Disposisi</h3>
                  </div> 
                </div>
                <div class="card-body table-responsive">
                  <table id="dt" class="table table-bordered table-striped " style="width:100%">
                    <thead>
                      <tr> 
                        <th width="20">NO</th> 
                        <th width="400">DISPOSISI DARI</th> 
                        <th>KETERANGAN</th> 
                        <th>TANGGAL</th> 
                        <th>STATUS</th> 
                        <th width="50">Opsi</th>
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
      


 <!--  EDIT -->
          <div class="modal fade" id="modal_tolak">
            <div class="modal-dialog  modal-default">

              <div class="modal-content ">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title_agenda"><i class="fa fa-times"></i> PROSES DISPOSISI SURAT</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php echo form_open("/",'id="add_tolak"') ?>
                <div class="modal-body"> 
                  <table class="table table-striped table-bordered" style="font-size: 12px">
                    <thead>
                      <tr>
                      <th colspan="2">INFORMASI SURAT</th> 
                      </tr>
                    </thead>
                    <tbody id="data_surat"></tbody>
                  </table>
                  <div class="form-group">
                  <label class="form-control-label">Alasan Lain  <span class="tx-danger">*</span></label>
                  <input id="alasan_penolakan" name="alasan_penolakan" class="form-control"   placeholder="" type="text"  value="0" >
                  </div>

                  <div class="form-group">
                  <label class="form-control-label">Status : <span class="tx-danger" id="st_terima"></span></label>
                  <select name="status_terima" id="status_terima" class="form-control">
                    <option value="tolak">Tolak</option>
                    <option value="terima">Terima</option>
                    <option value="belum">Belum Diproses</option>
                  </select> 
                </div>
 
                </div> 
                  <div class="modal-footer ">
                  <input id="id_disposition" name="id_disposition"  type="hidden" class="form-control">
                  <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="submit" id="save">Simpan</button> 
                </div>
                <?= form_close();?>
              </div>
            </div>
          </div>
          <!-- BATAS -->


<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jszip/jszip.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/pdfmake/pdfmake.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/pdfmake/vfs_fonts.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-buttons/js/buttons.colVis.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>
<script>
  //---------------------------------------------------
  var table = $('#dt').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/tracemail/dt_disposisi')?>",
    "order": [[0,'DESC']],
    "columnDefs": [
    { "targets": 0, "name": "id_disposition", 'searchable':false, 'orderable':true}, 
    { "targets": 1, "name": "nama_unit", 'searchable':true, 'orderable':false}, 
    { "targets": 2, "name": "desc_disposition", 'searchable':true, 'orderable':false}, 
    { "targets": 3, "name": "status_terima", 'searchable':true, 'orderable':true}, 
    { "targets": 4, "name": "tanggal_disposition", 'searchable':true, 'orderable':true}, 
    { "targets": 5, "name": "opsi", 'searchable':false, 'orderable':false}, 
    ],
    dom: "<'row be-datatable-header'<'col-sm-2'l> <'col-sm-3 text-left'f>   <'col-sm-7 text-right'B>><'row be-datatable-body'<'col-sm-12'tr>><'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>> ",
     buttons: [
                 
                {
                 
                  text:'<i class="fa fa-refresh"></i>',
                  action: function () {
                    table.ajax.reload();
                  }

                },
                {
                  extend: 'print', footer: true ,       
                  exportOptions: {
                  columns: ':visible' 
                  }                                   
                },
                {
                   extend: 'copy',  footer: true ,     
                   exportOptions: {
                   columns: ':visible' 
                   }     
               },
                {
                   text:'Sembunyikan',
                   extend: 'colvis',  footer: true ,     
                   exportOptions: {
                   columns: ':visible' 
                   }     
               }  
            ],
  });   
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    function data_surat(id) {
        $.ajax({
                  url: '<?php echo base_url('admin/tracemail/data_surat')?>',
                  type: 'POST',
                  data: { 
                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                      id:id,
                  },
                  dataType: 'JSON', 
                  success: function(data){ 
                          var html ="";                      
                          var i;
                          var no = 0; 
                          for(i=0 ; i<data.length; i++){ 
                                no++;
                                html += '<tr>'+
                                '<td width="100" class="p-1">NO SURAT</td>'+
                                '<td class="p-1">'+ data[i].kop_surat  + '</td>'+
                                '</tr><tr>'+
                                '<td class="p-1">PERIHAL</td>'+
                                '<td class="p-1 ">'+ data[i].perihal + '</td>'+ 
                                '</tr><tr>'+ 
                                '<td class="p-1 ">PENGIRIM</td>'+
                                '<td class="p-1 ">'+ data[i].pengirim + '</td>'+ 
                                '</tr><tr>'+ 
                                '<td class="p-1">TUJUAN</td>'+
                                '<td class="p-1 ">'+ data[i].penerima + '</td>'+ 
                                '</tr><tr>'+ 
                                '<td class="p-1">TANGGAL SURAT</td>'+
                                '<td class="p-1 ">'+ data[i].tanggal_surat + '</td>'+ 
                                '</tr>';
                            }  
                          $('#data_surat').html(html);  
                        },
          })
    }
     
     $(document).ready(function(){
        $('#add_tolak').submit(function(e){
            e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url('admin/tracemail/disposisi_proses_tolak')?>',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                   beforeSend: function(e) {
                        $("#save").addClass("disabled"); 
                 },   
                 success: function(data){ 
                        if(data.status === true){         
                            $('[name="alasan_penolakan"]').val("");   
                            $('[name="status_terima"]').val("");   
                            $('[name="id_disposition"]').val("");  
                            table.ajax.reload( null, false );
                            $("#save").removeClass("disabled"); 
                            Swal.fire(
                                          'Berhasil!',
                                         data.msg ,
                                          'success'
                                        );     
                         }else{                   
                            $("#save").removeClass("disabled"); 
                            console.log(data);
                            table.ajax.reload( null, false );
                            Swal.fire(
                                      'Gagal!',
                                         data.msg ,
                                          'error'
                                        );     
                       }
                    },
                 error: function (request, textStatus, errorThrown) { 
                                       Swal.fire(
                                          'Gagal!',
                                          'Maaf terjadi kesalahan.',
                                          'error'
                                        );
                                        
                      $("#save").removeClass("disabled"); 
                }
                 });
            });
    });

    //  show data
    $(document).ready(function(){
          $(document).on('click', '#show_data', function(e){
          $('#modal_tolak').modal('show');
           e.preventDefault();
           var id = $(this).data('id'); 
           $.ajax({
                url: '<?php echo base_url('admin/tracemail/data_show_custom/mailbox_disposition/id_disposition')?>',
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
                    console.log(data); 
                        $.each(data,function(k,v){ 
                            $('[name="alasan_penolakan"]').val(v.desc_disposition);  
                            $('[name="id_disposition"]').val(v.id_disposition);
                            $("#status_terima").val(v.status_terima.trim()).change();
                            $('#st_terima').html(v.status_terima);
                            data_surat(v.id_archive);
                        });
                        $('#card-title').html('<i class="fa fa-edit"></i> Update Data');
                        $("#save").removeClass("disabled"); 
                }
                })
                .done(function(data){
                                 
                }) 

          });

          $(document).on('click', '#cancel', function(e){
                    $('[name="nama_status"]').val('');    
                    $('[name="id"]').val('');
                    $("#save").removeClass("disabled"); 
                    table.ajax.reload( null, false );
                    $('#card-title').html('<i class="fa fa-plus"></i> Tambah Data');
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
                $.post('<?=base_url("admin/tracemail/delete_auto/status_surat")?>',
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


 $("body").on("click",".acc",function(){
        Swal.fire({
              title: 'Terima disposisi?',
              text: "Pastikan surat fisik sudah sampai!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, ACC!'
            }).then((result) => {
              if (result.value) {          
                $.post('<?=base_url("admin/tracemail/disposisi_proses/terima")?>',
                {
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                  id : $(this).data('acc'), 
                },
                function(data){ 
                  table.ajax.reload( null, false );
                  Swal.fire(
                  'Berhasil!',
                  'Disposisi  Berhasil diterima.',
                  'success'
                  ); 
                });              
                              
              }
            })
       });   

  

 

  </script>
