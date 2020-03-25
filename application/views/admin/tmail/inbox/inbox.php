<?php
/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 14:21:41
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-03-25 18:48:49
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
                <h3><?= $count_diproses;?></h3>

                <p>Sudah Diproses</p>
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
                <h3><?= $count_belum;?></h3>

                <p>Belum Diproses</p>
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
                <h3><?= $count_dikembalikan;?></h3>

                <p>Dikembalikan</p>
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
                  <div class="col-md-4"  >
                    <label>Unit Penerima :</label>   
                     <select class="form-control select2" name="unit_penerima_filter" onchange="user_filter()" id="cari_unit_penerima_filter" style="width:100%">  
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
    "ajax": "<?=base_url('admin/tmail/dt_inbox')?>",
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


  function user_filter()
  {
    var _form = $("#filter_data").serialize();
    $.ajax({
      data: _form,
      type: 'post',
      url: '<?php echo base_url();?>admin/tmail/inbox_search',
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
      url: '<?php echo base_url();?>admin/tmail/inbox_search_reset',
      data: { '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
      async: true,
      success: function(output){
        table.ajax.reload( null, false ); 
      }
    });
  } 
  //  cari data
    $("#cari_unit_penerima_filter").select2({ 
         ajax: { 
           url: '<?= base_url('admin/tmail/cari_unit');?>',
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

     $("#cari_jenis_filter").select2({ 
         ajax: { 
           url: '<?= base_url('admin/tmail/cari_jenis_surat');?>',
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
  
</script>