<?php

/**
 * @Author: Lampung Media Technology
 * @Date:   2020-01-04 18:50:33
 * @Last Modified by:   Kurniawan
 * @Last Modified time: 2020-01-04 22:29:17
 */
?> 
          
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah <?= trans('tracemail_inbox') ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?= trans('home') ?></a></li>
              <li class="breadcrumb-item"><a href="#"><?= trans('tracemail') ?></a></li>
              <li class="breadcrumb-item active"><?= trans('tracemail_inbox') ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
           <!-- CONTENT -->
           <div class="row">
      <div class="col-md-12">
      <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-envelope"></i>&nbsp; Tambah <?= trans('tracemail_inbox') ?></h3>
        </div>
        <div class="d-inline-block float-right">
          <a href="<?= base_url('admin/tracemail/inbox')?>" class="btn btn-primary"><i class="fa fa-list-alt"></i> Data <?= trans('tracemail_inbox') ?></a>
         </div>
      </div>
      <div class="card-body table-responsive">
          <?php $this->load->view('admin/includes/_messages.php') ?>
      		<?php echo form_open(base_url('admin/tracemail/inbox_create'), 'class="form-horizontal"');  ?> 

           		<div class="row ">
           	     <div class="col-md-3  ">
                  <label class="form-control-label"><?= trans('tmail_noagenda') ?>: <span class="tx-danger">*</span></label>
                  <input id="no-agenda-keluar" name="no_agenda" class="form-control"   placeholder="" type="text"  value="0" >
                </div>

                <div class="col-md-4  ">
                  <label class="form-control-label"><?= trans('tmail_nosurat') ?>: <span class="tx-danger">*</span></label>
                  <input id="kop-surat-keluar" name="kop_surat" class="form-control"   placeholder="" type="text"  >
                </div><!-- col -->

                <div class="col-md-5  mg-t-20 mg-md-t-0">
                  <label class="form-control-label"><?= trans('tmail_subject') ?>: <span class="tx-danger">*</span></label>
                  <input id="perihal-keluar" name="perihal" class="form-control"  placeholder=" " type="text"  >
                </div><!-- col -->
              	</div>

           		<div class="row ">
                <div class="col-md-2  ">
                  <label class="form-control-label"><?= trans('tmail_jenis_surat') ?>: <span class="tx-danger">*</span></label>
                    <select class="form-control" name="jenis_surat" id="jenis-surat-keluar">
                      <?php foreach ($jenis as $value) {?>                      
                        <option value="<?= $value->slug;?>"><?= $value->jenis;?></option>
                      <?php } ?>
                    </select>
                </div><!-- col -->

                <div class="col-md-2   mg-t-20 mg-md-t-0">
                  <label class="form-control-label"><?= trans('tmail_privacy') ?>: <span class="tx-danger">*</span></label>
                  <select class="form-control" name="privasi_surat" id="privasi-surat-keluar">
                      <option value="rahasia">Rahasia</option>
                      <option value="internal">Internal</option>
                      <option value="umum">Umum</option> 
                    </select>
                </div><!-- col -->

                <div class="col-md-2  mg-t-20 mg-md-t-0">
                  <label class="form-control-label"><?= trans('tmail_date') ?> : <span class="tx-danger">*</span></label>
                  <input type="text" name="tanggal_surat" data-provide="datepicker" class="form-control fc-datepicker datepicker" id="tanggal-surat-keluar" value="<?= date('Y-m-d')?>">
                </div><!-- col -->

                <div class="col-md-3   mg-t-20 mg-md-t-0">
                  <label class="form-control-label"><?= trans('tmail_date_sent') ?>: <span class="tx-danger">*</span></label>
                  <input type="text"  name="tanggal_terima" data-provide="datepicker" class="form-control fc-datepicker datepicker" id="tanggal-terima-keluar" value="<?= date('Y-m-d')?>">
                </div><!-- col -->
				
				<div class="col-md-3   mg-t-20 mg-md-t-0">
                <label class="form-control-label"><?= trans('tmail_type') ?> : </label>
                <select id="tipe-surat" name="tipe_surat" class="form-control">
      					<option value="surat-masuk">SURAT MASUK</option>
      					<option value="surat-keluar">SURAT KELUAR</option>
				</select>					
                </div><!-- col -->
				 				
				<div class="col-md-6   mg-t-20 mg-md-t-0">
                <label class="form-control-label"><?= trans('tmail_sender') ?>: <span class="tx-danger">*</span></label>  
				<select class="form-control select2" name="unit_pengirim" id="pengirim-masuk" style="width:100%">
				<?php foreach ($unit as $row) {
				 echo "<option value='".$row->id_unit."'>".$row->nama_unit."</option>";
				}?> 				   
                </select>
                </div><!-- col -->
				
                <div class="col-md-6   mg-t-20 mg-md-t-0" id="div-pengirim"  >
                  <label class="form-control-label"><?= trans('tmail_other') ?> : <span class="tx-danger"></span></label>  
				  <input id="pengirim-lain"  name="unit_pengirim_lainnya" class="form-control">
				</div>

				<div class="col-md-6   mg-t-20 mg-md-t-0" >
                <label class="form-control-label"><?= trans('tmail_recipient') ?> : <span class="tx-danger">*</span></label>  
				<select class="form-control select2" name="unit_penerima" id="pengirim-keluar" style="width:100%">
					<?php foreach ($unit as $row) {
					echo "<option value='".$row->id_unit."'>".$row->nama_unit."</option>";
					 }?> 
				</select>					 
                </div><!-- col --> 

				<div class="col-md-6   mg-t-20 mg-md-t-0" id="div-penerima">
                  <label class="form-control-label"><?= trans('tmail_other') ?> : <span class="tx-danger"></span></label>  
				  <input id="penerima-lain" name="unit_penerima_lainnya" class="form-control">
				</div>
        <div class="col-md-12  mg-t-20 "   >
        <label class="form-control-label"><?= trans('tmail_desc') ?> :  </label>  
        <textarea rows="5" cols="15" name="keterangan_surat" id="keterangan-surat" class="form-control"></textarea>  
        </div> 
		    </div>

          <br>
       <input type="submit" name="submit" value="SIMPAN" class="btn btn-primary pull-right">
   		<?php echo form_close(); ?>
   </div> 
   </div>
   </div> </div>
  <!-- ================================================== -->
 	  </div>
	</section>
</div>


          