<?php
/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 14:21:41
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-03-25 12:02:49
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
            <h1 class="m-0 text-dark">Data Surat</h1>
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $count_all?></h3>

                <p>Semua Surat</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"><?= trans('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-12">
            <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                  <h3 class="card-title">
                    <i class="fa fa-list"></i>
                    FILTER DATA
                  </h3>
              </div>
              
            </div>
              <?= form_open('/', 'id="filter_data"');?>                                
                <div class="card-body">
                 <div class="row">
                  <div class="col-md-2">
                    <label>Jenis Surat :</label> 
                     <select id="cari_jenis_filter" name="jenis_surat_filter"  onchange="user_filter()" class="form-control" style="width: 100%"> 
                        <option value="">Semua Data</option>       
                        </select>   

                  </div>
                  <div class="col-md-2">
                    <label>Status Surat :</label>  
                    <select class="form-control" name="status_surat_filter" onchange="user_filter()">
                      <option value="">Semua</option>
                      <option value="belum">Belum</option>
                      <option value="disposisi">Disposisi</option>
                      <option value="selesai">Selesai</option>
                    </select>

                  </div>
                  <div class="col-md-2"  >
                    <label>Unit Penerima :</label>   
                     <select class="form-control select2" name="unit_penerima_filter" onchange="user_filter()" id="cari_unit_penerima_filter" style="width:100%">  
                        <option value="">Semua Data</option>            
                      </select>
             
                  </div>
                  <div class="col-md-2">
                    <label>Unit Pengirim :</label>
                      <select class="form-control select2" name="unit_pengirim_filter" onchange="user_filter()" id="cari_unit_pengirim_filter" style="width:100%">
                        <option value="">Semua Data</option>        
                      </select>  

                    
                  </div> 
                  <div class="col-md-2">
                    <label>Tanggal Awal :</label>
                    <input type="text" name="tanggal_awal_filter" data-provide="datepicker" class="form-control"  >
                    
                  </div> 
                    <div class="col-md-2">
                    <label>Tanggal Akhir :</label>
                    <input type="text"  name="tanggal_akhir_filter" data-provide="datepicker" class="form-control " >
                    
                  </div> 
                </div>
                </div> 
                <div class="card-footer"> 
                <div class="btn-group">
                    <button type="button" onclick="user_filter()" class="btn btn-info"><i class="fa fa-search"></i> Filter</button>
                    <a class="btn btn-warning text-white" onclick="reset_filter()"><i class="fa fa-times"></i> Reset </a>
                    <button type="button"  class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export PDF</button>
                    <button type="button"  class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                    
                  </div>
                </div>
                <?= form_close();?>       
        </div>
     <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-envelope"></i>&nbsp; List Surat Masuk</h3>
        </div>
       
      </div>
      <div class="card-body table-responsive">
        <table id="dt" class="table table-bordered table-striped " style="width:100%">
          <thead>
            <tr> 
              <th width="15">NO</th>
              <th width="50">Agenda</th>
              <th>NO/UNIT/PERIHAL</th>
              <th>STATUS</th>
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


    <!--  MODAL TAMBAH / EDIT MAILBOX -->
     <div class="modal fade" id="modal_add">
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
                  <input type="text" name="tanggal_surat" data-provide="datepicker" class="form-control" id="tanggal-surat-keluar" value="<?= date('Y-m-d')?>">
                </div><!-- col -->

                <div class="col-md-3   mg-t-20 mg-md-t-0 form-group">
                  <label class="form-control-label"><?= trans('tmail_date_sent') ?>: <span class="tx-danger">*</span></label>
                  <input type="text"  name="tanggal_terima" data-provide="datepicker" class="form-control" id="tanggal-terima-keluar" value="<?= date('Y-m-d')?>">
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
        

                <div class="col-md-6 mg-t-20 mg-md-t-0 form-group" id="div-pengirim" style="display: none"  >
                  <label class="form-control-label"><?= trans('tmail_other') ?> : <span class="tx-danger"></span></label>  
                  <input id="pengirim-lain"  name="unit_pengirim_lainnya" class="form-control">
                </div>

                <div class="col-md-6   mg-t-20 mg-md-t-0  form-group"  >
                <label class="form-control-label"><?= trans('tmail_recipient') ?> : <span class="tx-danger">*</span></label>  
                  <select class="form-control select2" name="unit_penerima" id="cari_unit_penerima" style="width:100%">
                   <option value="00">Cari Unit  Penerima</option>        
                  </select>          
                </div><!-- col --> 
                
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
          <!-- BATAS -->

          <!--  EDIT NOMOR AGENDA-->
          <div class="modal fade" id="modal_agenda">
            <div class="modal-dialog modal-sm">

              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title_agenda"><i class="fa fa-plus"></i> Tambah Agenda </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php echo form_open("/",'id="add_agenda"') ?>
                <div class="modal-body"> 
                  <label class="form-control-label"><?= trans('tmail_noagenda') ?>: <span class="tx-danger">*</span></label>
                  <input id="no-agenda-keluar-save" name="no_agenda_save" class="form-control"   placeholder="" type="text"  value="0" >
                </div>
 
                  <div class="modal-footer ">
                  <input id="id" name="id"  type="hidden" class="form-control">
                  <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="submit" id="save_agenda">Simpan</button>
                  <a class="btn btn-danger text-white" id="cancel">Batal</a>
                </div>
                <?= form_close();?>
              </div>
            </div>
          </div>
          <!-- BATAS -->


          <!--  EDIT NOMOR AGENDA-->
          <div class="modal fade" id="modal_disposisi">
            <div class="modal-dialog modal-lg">

              <div class="modal-content ">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title-disposisi"><i class="fa fa-plus"></i> Disposi </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="background: #f6f6f6"> 
                    <div class="table-responsive" style="height: 250px">
                    <table class="table table-bordered" style="background: #fff;font-size: 12px">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>DISPOSISI</th>
                          <th>TANGGAL</th>
                          <th>STATUS</th> 
                          <th>OPSI</th>
                        </tr>
                      </thead>
                      <tbody id="data_disposisi"></tbody>
                    </table>
                    </div>
                    <hr>
                   <?php echo form_open("/",'id="add_disposisi"') ?>  
                    <div class="row">

                    <div class="col-md-3   mg-t-20 mg-md-t-0 form-group">
                    <label class="form-control-label">Unit Tujuan: <span class="tx-danger">*</span></label>  
                    <select class="form-control select2" name="disposisi_unit_tujuan" id="cari_unit_disposisi" style="width:100%">
                    <option value="00">Cari unit tujuan disposisi </option>        
                    </select>
                    </div> 


                    <div class="col-md-2   mg-t-20 mg-md-t-0 form-group">
                    <label class="form-control-label">Status Disposisi: <span class="tx-danger">*</span></label>  
                    <select class="form-control select2" name="status_disposisi" id="cari_status_disposisi" style="width:100%">
                    <option value="00">Status Disposisi </option>        
                    </select>
                    </div> 


                    <div class="col-md-2   mgt-20 mg-md-t-0 form-group">
                    <label class="form-control-label">Tanggal Disposisi: <span class="tx-danger">*</span></label>  
                    <input type="text" class="form-control" id="tanggal_disposisi" data-provide="datepicker"  name="tanggal_disposisi">
                    </div> 

                    <div class="col-md-3   mgt-20 mg-md-t-0 form-group">
                    <label class="form-control-label">Keterangan: </label>  
                    <input type="text" class="form-control" id="desc_disposition" name="desc_disposition">
                    </div> 

                    <div class="col-md-2  ">  
                      <div class=" btn-group" style="margin-top: 32px">
                      <button type="submit" name="submit" id="save_disposisi" class="btn btn-primary" ><i class="fa fa-save"></i> DISPOSISI</button>
                      <a class="btn btn-danger text-white"  id="reset_disposisi" title="Batal Update"><i class="fa fa-times"></i></a>
                    </div>
                    </div> 
                    </div>  

                  <input id="id_archive" name="id_archive"  type="hidden"  >
                  <input id="id_disposition" name="id_disposition"  type="hidden"  >
                    <?= form_close();?>
                </div>
 
                  <div class="modal-footer ">                  
                  <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button> 
                 
                  </div>
            </div>
          </div>
          </div>
          <!-- BATAS -->



<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script> 
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
    "ajax": "<?=base_url('admin/tracemail/dt_inbox')?>",
    "order": [[0,'DESC']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':false, 'orderable':true},
    { "targets": 1, "name": "no_agenda", 'searchable':true, 'orderable':true}, 
    { "targets": 2, "name": "kop_surat", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "status", 'searchable':false, 'orderable':true},
    { "targets": 4, "name": "tanggal_surat", 'searchable':false, 'orderable':true},
    { "targets": 5, "name": "opsi", 'searchable':false, 'orderable':false}, 
    ],
     dom: "<'row be-datatable-header'<'col-sm-2'l> <'col-sm-3 text-left'f>   <'col-sm-7 text-right'B>><'row be-datatable-body'<'col-sm-12'tr>><'row be-datatable-footer'<'col-sm-5'i><'col-sm-7'p>> ",
    buttons: [
                {
                 
                  text:'<i class="fa fa-plus"></i>  Tambah',
                  action: function () {
                    tambah_modal();
                  }

                }, 
                {
                 
                  text:'<i class="fa fa-refresh"></i>',
                  action: function () {
                    table.ajax.reload();
                  }

                }, 
               
                {
                  extend: 'pdf',  footer: true ,
                  className: 'btn-primary',
                  exportOptions: {
                  columns: ':visible' 
                  }
                },
                {
                  extend: 'excel',  footer: true ,
                  exportOptions: {
                  columns: ':visible' 
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


    function list_disposition(id) {   
             $.ajax({
                  url: '<?php echo base_url('admin/tracemail/data_disposisi')?>',
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
                                '<td class="p-1  text-center">'+ no +'</td>'+
                                '<td class="p-1">'+ data[i].pemroses  + ' => '+ data[i].tujuan  + '</td>'+
                                '<td class="p-1  text-center">'+ data[i].tanggal_disposition  + '</td>'+
                                '<td class="p-1 ">'+ data[i].nama_status  + '</td>'+ 
                                '<td class="p-1 text-center"><div class="btn-group"> <a class="btn btn-sm btn-success text-white" id="edit_disposisi" data-id_disposition="'+data[i].id_disposition+'"><i class="fa fa-edit"></i>  edit </a><a class="btn btn-sm btn-danger  text-white del_disposition"  data-id_disposition="'+data[i].id_disposition+'"><i class="fa fa-trash"></i></a></div></td>'+
                                '</tr>';
                                if(data[i].desc_disposition){
                                    html += '<tr class="table-warning">' +
                                    '<td colspan="5"><i class="fa fa-info"></i> '+ data[i].desc_disposition + '</td></tr>';
                                }
                            }  
                          $('#data_disposisi').html(html);
                           $('[name="id_archive"]').val(id);   
                          $('#modal-title-disposisi').html('<i class="fa fa-edit"></i> Disposisi Surat '+data[0].kop_surat);
                        },
          })
    }


  function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

  function user_filter()
  {
    var _form = $("#filter_data").serialize();
    $.ajax({
      data: _form,
      type: 'post',
      url: '<?php echo base_url();?>admin/tracemail/inbox_search',
      async: true,
      success: function(output){
        table.ajax.reload( null, false );
      }
    });
  } 

  function reset_filter()
  { 
    $.ajax({ 
      type: 'post',
      url: '<?php echo base_url();?>admin/tracemail/inbox_search_reset',
      data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
      async: true,
      success: function(output){
        table.ajax.reload( null, false ); 
      }
    });
  } 

  $(document).on('click', '#reset_disposisi', function(e){
    // $('[name="id_archive"]').val("");   
    $('[name="tanggal_disposisi"]').val("");   
    $('[name="id_disposition"]').val("");   
    $('[name="desc_disposition"]').val("");   
    $('#save_disposisi').html("<i class='fa fa-save'></i> DISPOSISI");   
  });
  
  function tambah_modal() { 
    $("#modal_add").modal('show');
                    $('[name="no_agenda"]').val("0"); 
                    $('[name="kop_surat"]').val(""); 
                    $('[name="unit_penerima_lainnya"]').val("");   
                    $('[name="unit_pengirim_lainnya"]').val("");   
                    $("#modal_add").modal('hide');
                    $("#modal_agenda").modal('hide');
                    $('[name="perihal"]').val("");   
                    $('[name="keterangan_surat"]').val("");   
                    $('[name="id"]').val("");  
                    $("#save-surat").removeClass("disabled");  
                    $('#modal-title').html('<i class="fa fa-plus"></i> Tambah Data');
    
  }

   
    $(document).ready(function(){

        $('#add').submit(function(e){
        e.preventDefault(); 
        var id                   = $('#id').val();
	    	var kop_surat	           = $('#kop-surat-keluar').val();
	    	var no_agenda	           = $('#no-agenda-keluar').val();
	    	var perihal 	           = $('#perihal-keluar').val(); 
	    	var privasi_surat 	     = $('#privasi-surat-keluar').val(); 
	    	var jenis_surat 	       = $('#cari_jenis').val(); 
	    	var tanggal_surat 	     = $('#tanggal-surat-keluar').val(); 
	    	var tanggal_terima	     = $('#tanggal-terima-keluar').val(); 
	    	var unit_penerima 	     = $('#cari_unit_penerima').val(); 
        var unit_penerima_lain   = $('#penerima-lain').val(); 
	    	var unit_pengirim 	     = $('#cari_unit_pengirim').val(); 
        var unit_pengirim_lain   = $('#pengirim-lain').val(); 
	    	var tipe_surat 		       = $('#tipe_surat').val(); 
	    	var form_data            = new FormData();
	    	form_data.append('id', id); 
	    	form_data.append('kop_surat', kop_surat); 
	    	form_data.append('no_agenda', no_agenda); 
	    	form_data.append('perihal', perihal); 
	    	form_data.append('jenis_surat', jenis_surat); 
	    	form_data.append('unit_penerima', unit_penerima); 
        form_data.append('unit_penerima_lainnya', unit_penerima_lain); 
	    	form_data.append('unit_pengirim', unit_pengirim); 
        form_data.append('unit_pengirim_lainnya', unit_pengirim_lain); 
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
                            $('[name="unit_penerima_lainnya"]').val("");   
                            $('[name="unit_pengirim_lainnya"]').val("");   
                            $('[name="id"]').val("");  
                            table.ajax.reload( null, false );
                            $("#modal_add").modal('hide');
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


        $('#add_agenda').submit(function(e){
            e.preventDefault(); 
            var id= $('#id').val(); 
            var no_agenda = $('#no-agenda-keluar-save').val(); 
            var form_data = new FormData();
            form_data.append('id', id);  
            form_data.append('no_agenda', no_agenda);  
            form_data.append('<?php echo $this->security->get_csrf_token_name(); ?>',  '<?php echo $this->security->get_csrf_hash(); ?>' );  
 
                 $.ajax({
                     url:'<?php echo base_url('admin/tracemail/inbox_save_agenda')?>',
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
                            $('[name="id"]').val("");  
                            table.ajax.reload( null, false );
                            $("#save_agenda").removeClass("disabled"); 
                            $("#modal_agenda").modal('hide');
                            $('#modal-title_agenda').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire('Berhasil!',data.msg ,'success');     
                       }else{                   
                            $("#save_agenda").removeClass("disabled"); 
                            table.ajax.reload( null, false );
                            $('#modal-title_agenda').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire('Gagal!', data.msg , 'error');     
                       }
                    },
                 error: function (request, textStatus, errorThrown) { 
                          Swal.fire( 'Gagal!', 'Maaf terjadi kesalahan.', 'error'  );              
                          $("#simpan-surat").removeClass("disabled"); 
                        }
                 });
 

            });




        $('#add_disposisi').submit(function(e){
            e.preventDefault(); 
            var id= $('#id_archive').val(); 
            var id_disp= $('#id_disposition').val(); 
            var tujuan = $('#cari_unit_disposisi').val(); 
            var desc = $('#desc_disposition').val(); 
            var status_disposisi = $('#cari_status_disposisi').val(); 
            var tanggal = $('#tanggal_disposisi').val(); 
            var form_data = new FormData();
            form_data.append('id_archive', id);   
            form_data.append('id_disposition', id_disp);   
            form_data.append('unit_tujuan', tujuan);  
            form_data.append('unit_pemroses', tujuan);   
            form_data.append('desc_disposition', desc);   
            form_data.append('status', status_disposisi);   
            form_data.append('tanggal_disposition', tanggal);   
            form_data.append('<?php echo $this->security->get_csrf_token_name(); ?>',  '<?php echo $this->security->get_csrf_hash(); ?>' );  
 
                 $.ajax({
                     url:'<?php echo base_url('admin/tracemail/inbox_disposisi')?>',
                     type:"post",
                     data: form_data,
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                     beforeSend: function(e) {
                        $("#save_disposisi").addClass("disabled"); 
                     },   
                 success: function(data){ 
                        if(data.status === true){      
                            list_disposition(id);     
                            $('[name="id_archive"]').val("");   
                            $('[name="id_disposition"]').val("");   
                            $('[name="desc_disposition"]').val("");   
                            table.ajax.reload( null, false );
                            $("#save_disposisi").removeClass("disabled"); 
                            $("#save_disposisi").html("<i class='fa fa-save'></i> DISPOSISI"); 
                            // $("#modal_disposisi").modal('hide');
                            $('#modal-title-disposisi').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire('Berhasil!',data.msg ,'success');     
                       }else{                   
                            $("#save_disposisi").removeClass("disabled"); 
                            table.ajax.reload( null, false );
                            $('#modal-title-disposis').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire('Gagal!', data.msg , 'error');     
                       }
                    },
                 error: function (request, textStatus, errorThrown) { 
                          Swal.fire( 'Gagal!', 'Maaf terjadi kesalahan.', 'error'  );              
                          $("#save_disposisi").removeClass("disabled"); 
                        }
                 });
 

            });
      });




    //  cari data
    $("#cari_unit_penerima,#cari_unit_pengirim,#cari_unit_penerima_filter,#cari_unit_pengirim_filter,#cari_unit_disposisi").select2({ 
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

    $("#cari_jenis,#cari_jenis_filter").select2({ 
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

      $("#cari_status_disposisi").select2({ 
               ajax: { 
                 url: '<?= base_url('admin/tracemail/cari_status_disposisi');?>',
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
           $("#modal_add").modal('show');
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
								        
                        $('[name="unit_penerima_lainnya"]').val(v.unit_penerima_lainnya);  
                        $('[name="unit_pengirim_lainnya"]').val(v.unit_pengirim_lainnya);  

                        		});
                       	$('#modal-title').html('<i class="fa fa-edit"></i> Update Data '+data[0].kop_surat);
                        $("#save").removeClass("disabled"); 
                }
                })
                .done(function(data){
                                 
                }) 

          });


       // @show_disposisi
        $(document).on('click', '#show_disposisi', function(e){
             $("#modal_disposisi").modal('show');
             e.preventDefault();
             var id = $(this).data('id'); 
             $.ajax({
                  url: '<?php echo base_url('admin/tracemail/data_disposisi')?>',
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
                          if(data[0].id_disposition === null){
                            html += '<tr class="table-danger"><td colspan="5">Belum Diproses</td></tr>';
                          }else{
                          for(i=0 ; i<data.length; i++){ 
                                no++;
                                html += '<tr>'+
                                '<td class="p-1 text-center">'+ no +'</td>'+
                                '<td class="p-1">'+ data[i].pemroses  + ' => '+ data[i].tujuan  + '</td>'+
                                '<td class="p-1  text-center">'+ data[i].tanggal_disposition  + '</td>'+
                                '<td class="p-1 ">'+ data[i].nama_status  + '</td>'+ 
                                '<td class="p-1  text-center"><div class="btn-group"> <a class="btn btn-sm btn-success text-white" id="edit_disposisi" data-id_disposition="'+data[i].id_disposition+'"><i class="fa fa-edit"></i>  edit </a><a class="btn btn-sm btn-danger  text-white del_disposition"  data-id_disposition="'+data[i].id_disposition+'"><i class="fa fa-trash"></i></a></div></td>'+
                                '</tr>';
                                if(data[i].desc_disposition){
                                    html += '<tr class="table-warning">' +
                                    '<td colspan="5"><i class="fa fa-info-circle"></i> '+ data[i].desc_disposition + '</td></tr>';
                                }
                            }  
                          } 
                          $('#data_disposisi').html(html);
                           $('[name="id_archive"]').val(id);   
                          $('#modal-title-disposisi').html('<i class="fa fa-edit"></i> Disposisi Surat '+data[0].kop_surat);
                        },
          })
          });
         //  show data
      $(document).ready(function(){          
           $(document).on('click', '#edit_disposisi', function(e){ 
           e.preventDefault();
           var id = $(this).data('id_disposition'); 
           $.ajax({
                url: '<?php echo base_url('admin/tracemail/show_edit_disposition')?>',
                type: 'POST',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', 
                    id:id,
                    
                },
                dataType: 'JSON',

                beforeSend: function(e) { 
                        $("#save_disposisi").addClass("disabled"); 
                        $("#save_disposisi").html("<i class='fa fa-edit'></i> Ubah"); 
                  },  

                success: function(data){
                        $.each(data,function(k,v){  
                        $('[name="id_disposition"]').val(v.id_disposition);     
                        $('[name="tanggal_disposisi"]').val(v.tanggal_disposition);     
                        $('[name="desc_disposition"]').val(v.desc_disposition);     

                        var tujuan = new Option(v.tujuan, v.unit_tujuan, true, true); 
                        var status = new Option(v.nama_status, v.status, true, true); 

                        $('#cari_unit_disposisi').append(tujuan).trigger('change'); 
                        $('#cari_status_disposisi').append(status).trigger('change'); 
                        });
                        // $('#modal-title-disposisi').html('<i class="fa fa-edit"></i> Update Data '+data[0].kop_surat);
                        $("#save_disposisi").removeClass("disabled"); 
                }
                })
                .done(function(data){
                                 
                }) 

          });
          });



          $(document).on('click', '#show_data_agenda', function(e){
           $("#modal_agenda").modal('show');
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
                        $("#save_agenda").addClass("disabled"); 
                  },  

                success: function(data){
                        $.each(data,function(k,v){ 
                        $('[name="no_agenda_save"]').val(v.no_agenda);  
                        $('[name="id"]').val(v.id);
                      
                            });
                        $('#modal-title_agenda').html('<small><i class="fa fa-calendar"></i> Update Agenda '+data[0].kop_surat+'</small>');
                        $("#save_agenda").removeClass("disabled"); 
                }
                })
                .done(function(data){
                                 
                }) 

          });

         

          $(document).on('click', '#cancel', function(e){
                    $('[name="no_agenda"]').val("0"); 
                    $('[name="kop_surat"]').val("");   
                    $("#modal_add").modal('hide');
                    $("#modal_agenda").modal('hide');
                    $('[name="perihal"]').val("");   
                    $('[name="unit_penerima_lainnya"]').val("");   
                    $('[name="unit_pengirim_lainnya"]').val(""); 
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

       $("body").on("click",".del_disposition",function(){
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
                $.post('<?=base_url("admin/tracemail/delete_disposition")?>',
                {
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                  id : $(this).data('id_disposition'), 
                },
                function(data){ 
                  var ids= $('#id_archive').val(); 
                  list_disposition(ids);
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


$('#cari_unit_pengirim').on('change', function() {
    if (this.value == '0') {
      $("#div-pengirim").show();
    } else {
      $("#div-pengirim").hide();
    }
  });
 
 $('#cari_unit_penerima').on('change', function() {
    if (this.value == '0') {
      $("#div-penerima").show();
    } else {
      $("#div-penerima").hide();
    }
  });
 
  </script>
