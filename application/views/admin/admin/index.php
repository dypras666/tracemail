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
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
         <!-- For Messages -->
        <?php $this->load->view('admin/includes/_messages.php') ?>
       
    </section>
    <!-- Main content -->
    <section class="content mt10">

    <a class="btn btn-primary" href="<?= base_url('admin/admin/add')?>">Tambah Admin</a>
    <hr>
    	<div class="card">
    		<div class="card-body">
               <!-- Load Admin list (json request)-->
        <table id="dt" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50">ID</th>
                <th>Pengguna</th>
                <th>Username</th>
                <th>NO HP</th>
                <th>UNIT</th>
                <th>Role</th>
                <th width="100">Status</th>
                <th width="120">OPSI</th>
            </tr>
        </thead>
        <tbody></tbody>
        </table>
           </div>
       </div>
    </section>
    <!-- /.content -->
</div>



<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script> 
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/plugins/swal/dist/sweetalert2.min.js"></script>
<script>
 var table = $('#dt').DataTable( {
    "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/admin/dt_admin')?>",
    "order": [[0,'DESC']],
    "columnDefs": [
    { "targets": 0, "name": "admin_id", 'searchable':false, 'orderable':true}, 
    { "targets": 1, "name": "firstname", 'searchable':true, 'orderable':false}, 
    { "targets": 2, "name": "username", 'searchable':true, 'orderable':false}, 
    { "targets": 3, "name": "mobile_no", 'searchable':true, 'orderable':true}, 
    { "targets": 4, "name": "nama_unit", 'searchable':true, 'orderable':true}, 
    { "targets": 5, "name": "admin_role_title", 'searchable':true, 'orderable':true}, 
    { "targets": 6, "name": "is_active", 'searchable':true, 'orderable':true}, 
    { "targets": 7, "name": "opsi", 'searchable':false, 'orderable':false}, 
    ], 
  });   

</script> 

<script>
//------------------------------------------------------------------
function filter_data()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$.post('<?=base_url('admin/admin/filterdata')?>',$('.filterdata').serialize(),function(){
	$('.data_container').load('<?=base_url('admin/admin/list_data')?>');
});
}
//------------------------------------------------------------------
function load_records()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$('.data_container').load('<?=base_url('admin/admin/list_data')?>');
}
load_records();

//---------------------------------------------------------------------
$("body").on("change",".tgl_checkbox",function(){
$.post('<?=base_url("admin/admin/change_status")?>',
{
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	id : $(this).data('id'),
	status : $(this).is(':checked')==true?1:0
},
function(data){
	$.notify("Status Changed Successfully", "success");
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
                $.post('<?=base_url("admin/admin/delete")?>',
                {
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
                  id : $(this).data('id'), 
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
