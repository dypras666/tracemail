  
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css"> 
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default color-palette-bo">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              <?= trans('add_new_admin') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/admin'); ?>" class="btn btn-success"><i class="fa fa-list"></i> <?= trans('admin_list') ?></a>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <!-- form start -->
                <div class="box-body">

                  <!-- For Messages -->
                  <?php $this->load->view('admin/includes/_messages.php') ?>

                  <?php echo form_open(base_url('admin/admin/add'), 'class="form-horizontal"');  ?> 
                  <div class="form-group">
                    <label for="username" class="col-md-12 control-label"><?= trans('username') ?></label>

                    <div class="col-md-12">
                      <input type="text" name="username" class="form-control" id="username" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="firstname" class="col-md-12 control-label"><?= trans('firstname') ?></label>

                    <div class="col-md-12">
                      <input type="text" name="firstname" class="form-control" id="firstname" placeholder="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="lastname" class="col-md-12 control-label"><?= trans('lastname') ?></label>

                    <div class="col-md-12">
                      <input type="text" name="lastname" class="form-control" id="lastname" placeholder="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-md-12 control-label"><?= trans('email') ?></label>

                    <div class="col-md-12">
                      <input type="email" name="email" class="form-control" id="email" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="mobile_no" class="col-md-12 control-label"><?= trans('mobile_no') ?></label>

                    <div class="col-md-12">
                      <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="col-md-12 control-label">Unit : <span class="tx-danger">*</span></label>  
                    <div class="col-md-12">
                    <select class="form-control select2" name="unit" id="cari_unit" style="width:100%">
                    <option value="">Pilih Unit </option>        
                    </select>
                  </div>
                    </div> 
                  <div class="form-group">
                    <label for="password" class="col-md-12 control-label"><?= trans('password') ?></label>

                    <div class="col-md-12">
                      <input type="password" name="password" class="form-control" id="password" placeholder="">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="role" class="col-md-12 control-label"><?= trans('select_admin_role') ?>*</label>

                    <div class="col-md-12">
                      <select name="role" class="form-control">
                        <option value=""><?= trans('select_role') ?></option>
                        <?php foreach($admin_roles as $role): ?>
                          <option value="<?= $role['admin_role_id']; ?>"><?= $role['admin_role_title']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-12">
                      <input type="submit" name="submit" value="<?= trans('add_admin') ?>" class="btn btn-primary pull-right">
                    </div>
                  </div>
                  <?php echo form_close(); ?>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          </div>  
        </div>
      </div>
    </section> 
  </div>

  <script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script> 
<script type="text/javascript">//  cari  
    $("#cari_unit").select2({ 
         ajax: { 
           url: '<?= base_url('admin/admin/cari_unit');?>',
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