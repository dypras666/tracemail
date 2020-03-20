<?php
/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 14:21:41
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-01-05 09:31:53
 */ 
?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.css">
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
                <h3><?= $count?></h3>

                <p>Jumlah Data</p>
              </div>
              <div class="icon">
                <i class="fa fa-university"></i>
              </div> 
            </div>


              <div class="card " id="ubah-data"> 
              <div class="card-header " id="card-title"><i class="fa fa-plus"></i> Tambah Data</div>
                <?php echo form_open("/",'id="add"') ?>
                <div class="card-body"> 
                <div class="form-group  ">
                    <label>Jenis</label>
                    <input type="text" class="form-control "  name="jenis" id="jenis"  >
                </div> 
 
                </div>
                <div class="card-footer">
                <input type="hidden"   name="id" id="id"> 
                <button class="btn  btn-primary" id="save"><i class="fa fa-save"></i> Simpan</button>  
                <a class="btn  btn-danger text-white" id="cancel" ><i class="fa fa-times"></i> Batal</a>  
                </div> 
                <?php echo form_close(); ?>
              </div>

          </div>
          <!-- ./col --> 
          <div class="col-9">
               <div class="card">
                <div class="card-header">
                  <div class="d-inline-block">
                    <h3 class="card-title"><i class="fa fa-university"></i>&nbsp; Data Unit</h3>
                  </div> 
                </div>
                <div class="card-body table-responsive">
                  <table id="dt" class="table table-bordered table-striped " style="width:100%">
                    <thead>
                      <tr> 
                        <th width="20">NO</th>
                        <th width="100">SLUG</th>
                        <th>JENIS</th> 
                        <th width="100">Opsi</th>
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
<script src="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  //---------------------------------------------------
  var table = $('#dt').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/tracemail/dt_jenis')?>",
    "order": [[0,'DESC']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':false, 'orderable':true},
    { "targets": 1, "name": "slug", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "jenis", 'searchable':true, 'orderable':true}, 
    { "targets": 3, "name": "opsi", 'searchable':false, 'orderable':true}, 
    ]
  });   
  function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

     $(document).ready(function(){
        $('#add').submit(function(e){
            e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url('admin/tracemail/jenis_save')?>',
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
                            $('[name="jenis"]').val("");   
                            $('[name="id"]').val("");  
                            table.ajax.reload( null, false );
                            $("#save").removeClass("disabled"); 
                            $('#card-title').html('<i class="fa fa-plus"></i> Tambah Data');
                            Swal.fire(
                                          'Berhasil!',
                                         data.msg ,
                                          'success'
                                        );     
                         }else{                   
                            $("#save").removeClass("disabled"); 
                            console.log(data);
                            table.ajax.reload( null, false );
                            $('#card-title').html('<i class="fa fa-plus"></i> Tambah Data');
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
           e.preventDefault();
           var id = $(this).data('id'); 
           $.ajax({
                url: '<?php echo base_url('admin/tracemail/data_show/jenis_surat')?>',
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
                            $('[name="jenis"]').val(v.jenis);  
                            $('[name="id"]').val(v.id);
                        });
                        $('#card-title').html('<i class="fa fa-edit"></i> Update Data');
                            $("#save").removeClass("disabled"); 
                }
                })
                .done(function(data){
                                 
                }) 

          });

          $(document).on('click', '#cancel', function(e){
                    $('[name="jenis"]').val('');    
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
                $.post('<?=base_url("admin/tracemail/delete_auto/jenis_surat")?>',
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
