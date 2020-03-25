<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Tracemail extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Tracemail_model', 'tmail'); 
		$this->load->helper("file");
	}
	public function index()
	{ 
		$data['title'] = 'Tracemail';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/dashboard', $data);
		$this->load->view('admin/includes/_footer', $data);
    }


    // ===========================================================================================================================//
    //  Surat Masuk
    // ===========================================================================================================================//
   
	public function inbox()
	{ 
    	$this->rbac->check_operation_access(); 
    	$this->session->unset_userdata('jenis_surat');
		$this->session->unset_userdata('status_surat');
		$this->session->unset_userdata('penerima');
		$this->session->unset_userdata('pengirim');
		$this->session->unset_userdata('tanggal_awal'); 
		$this->session->unset_userdata('tanggal_akhir'); 
		$data['title'] = 'Surat Masuk'; 
		$data['count_inbox']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-masuk"));
		$data['count_inbox_bl']	= $this->tmail->count_data('mailbox',array("status" => "belum"));
		$data['count_outbox']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-keluar"));		
		$data['count_all']	 = $this->tmail->count_data('mailbox');
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/inbox/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }
    public function inbox_search()
    {
    	$this->session->set_userdata('jenis_surat',$this->input->post('jenis_surat_filter'));
		$this->session->set_userdata('status_surat',$this->input->post('status_surat_filter'));
		$this->session->set_userdata('penerima',$this->input->post('unit_penerima_filter'));
		$this->session->set_userdata('pengirim',$this->input->post('unit_pengirim_filter'));
		$this->session->set_userdata('tanggal_awal',$this->input->post('tanggal_awal_filter')); 
		$this->session->set_userdata('tanggal_akhir',$this->input->post('tanggal_akhir_filter')); 
    }

    public function inbox_search_reset()
    {
    	
    	$this->session->unset_userdata('jenis_surat');
		$this->session->unset_userdata('status_surat');
		$this->session->unset_userdata('penerima');
		$this->session->unset_userdata('pengirim');
		$this->session->unset_userdata('tanggal_awal'); 
		$this->session->unset_userdata('tanggal_akhir'); 
    }

    //-----------------------------------------------------		
	public function inbox_save($id=""){
         	$id=$this->input->post('id'); 
         	if(!empty($id)){         		
            	$this->form_validation->set_rules('kop_surat', 		'Kop Surat', 		'trim|required'); 
         	}else{        	

            	$this->form_validation->set_rules('kop_surat', 		'Kop Surat', 		'trim|is_unique[mailbox.kop_surat]|required'); 
         	}  
         	
	    		$this->form_validation->set_rules('perihal', 		'Perihal', 			'trim|required'); 
	    		$this->form_validation->set_rules('jenis_surat', 	'jenis surat', 		'trim|required'); 
	    		$this->form_validation->set_rules('privasi_surat', 	'privasi surat',	'trim|required'); 
	    		$this->form_validation->set_rules('tanggal_surat', 	'tanggal surat',	'trim|required'); 
	    		$this->form_validation->set_rules('tanggal_terima', 'tanggal terima',	'trim|required');   
	    		$this->form_validation->set_rules('unit_penerima',  'Unit Penerima',	'trim|required');   
	    		$this->form_validation->set_rules('unit_pengirim',  'Unit Pengirim',	'trim|required');   

	    		if($this->input->post('unit_penerima') == "0"){
            	$this->form_validation->set_rules('unit_penerima_lainnya', 		'Bidang Penerima Lain', 'trim|required');
            	}
            	if($this->input->post('unit_pengirim') == "0"){		
            	$this->form_validation->set_rules('unit_pengirim_lainnya', 		'Bidang Pengirim Lain', 'trim|required');		
         		}

				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						$config = array(
        				'upload_path' => "./uploads/tracemail/",
        				'allowed_types' => "gif|jpg|png|jpeg",
        				'overwrite' => TRUE,         			 
        				);
        				$this->load->library('upload', $config);

				    	$data = array(  
							'kop_surat'				=> $this->input->post('kop_surat'), 
							'perihal' 				=> $this->input->post('perihal'),
							'jenis_surat' 			=> $this->input->post('jenis_surat'),
							'privasi_surat'			=> $this->input->post('privasi_surat'),
							'tanggal_surat'			=> $this->input->post('tanggal_surat'),
							'tanggal_terima'		=> $this->input->post('tanggal_terima'),
							'unit_penerima'			=> $this->input->post('unit_penerima'),
							'unit_pengirim' 		=> $this->input->post('unit_pengirim'),
							'username' 				=> $this->input->post('username'),		 	
							'disposition_unit' 		=> $this->input->post('disposition_unit'),			
							'surat_edaran' 			=> $this->input->post('surat_edaran'),			
							'unit_penerima_lainnya' => $this->input->post('unit_penerima_lainnya'),			
							'unit_pengirim_lainnya' => $this->input->post('unit_pengirim_lainnya'),			
							'tipe_surat' 			=> $this->input->post('tipe_surat'),			
							'keterangan_surat' 		=> $this->input->post('keterangan_surat'),
							'created_at'            => date('Y-m-d h:m:s'),
							'updated_at'            => date('Y-m-d h:m:s'));
						
						if($this->upload->do_upload('file'))  { 
        			    	$data['file']    = $this->upload->data('file_name');
        				}

						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('mailbox',array('id' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('mailbox',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Data Berhasi Disimpan'));
				}
	}
    
     //-----------------------------------------------------		
	public function inbox_save_agenda($id=""){
         	$id=$this->input->post('id'); 
         	 
         	
	    		$this->form_validation->set_rules('no_agenda', 		'Nomor Agenda', 			'trim|required');    
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						$config = array(
        				'upload_path' => "./uploads/tracemail/",
        				'allowed_types' => "gif|jpg|png|jpeg",
        				'overwrite' => TRUE,         			 
        				);
        				$this->load->library('upload', $config);

				    	$data = array(    			
							'no_agenda' 		=> $this->input->post('no_agenda'),
							'created_at'            => date('Y-m-d h:m:s'),
							'updated_at'            => date('Y-m-d h:m:s'));
						
						if($this->upload->do_upload('file'))  { 
        			    	$data['file']    = $this->upload->data('file_name');
        				}

						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('mailbox',array('id' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('mailbox',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Data Berhasi Disimpan'));
				}
	}
    

     //-----------------------------------------------------		
	public function inbox_disposisi($id=""){
         		$id=$this->input->post('id_disposition');         	 
         		if(!empty($id)){

         		}else{         			 
	    			$this->form_validation->set_rules('id_archive', 		'Surat', 			'trim|required');    
         		}
	    		$this->form_validation->set_rules('unit_tujuan', 		'Unit tujuan', 			'trim|required');   
	    		$this->form_validation->set_rules('tanggal_disposition', 		'Tanggal Disposisi', 			'trim|required');    
	    		$this->form_validation->set_rules('status', 		'Status Disposisi', 			'trim|required');    
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						$config = array(
        				'upload_path' => "./uploads/tracemail/disposisi/",
        				'allowed_types' => "gif|jpg|png|jpeg",
        				'overwrite' => TRUE,         			 
        				);
        				$this->load->library('upload', $config);

				    	$data = array(    			
							'unit_tujuan' 			=> $this->input->post('unit_tujuan'),
							'unit_pemroses' 		=> $this->input->post('unit_pemroses'),
							'desc_disposition' 		=> $this->input->post('desc_disposition'),
							'status' 				=> $this->input->post('status'),
							'tanggal_disposition' 	=> $this->input->post('tanggal_disposition'),
							'datetime'            	=> date('Y-m-d h:m:s')); 
						
						if($this->upload->do_upload('file'))  { 
        			    	$data['file']    = $this->upload->data('file_name');
        				}

						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }else{
							$data['id_archive'] = $this->input->post('id_archive');
						}
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('mailbox_disposition',array('id_disposition' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('mailbox_disposition',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Data Berhasi Disimpan'));
				}
	}

	//  Proses disposisi
	public function disposisi_proses($value='')
	{
	    $id= $this->input->post('id');
	    $status= $this->input->post('status_terima');
	    $data = $this->tmail->update_auto('mailbox_disposition',
	    	array('id_disposition' => $id),
	    	array('status_terima' => $status,
	    			'tanggal_terima' => date('Y-m-d H:i:s'),
	    			'updated_at' => date('Y-m-d H:i:s'),
	    		  ));
	    return $data;
	}

	public function disposisi_proses_tolak($id=""){
         	$id=$this->input->post('id_disposition'); 
	        $status= $this->input->post('status_terima');
         	       		
            	$this->form_validation->set_rules('alasan_penolakan', 'Alasan Penolakan', 'trim|required'); 
            	$this->form_validation->set_rules('status_terima', 'Status', 'trim|required'); 
           
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						 
				    	$data = array(  
						'status_terima'         => $status,
						'desc_disposition'      => $this->input->post('alasan_penolakan'),  
						'updated_at'            => date('Y-m-d h:m:s'),
	    			  	'tanggal_terima' => date('Y-m-d H:i:s'),
						);
						
						 
						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('mailbox_disposition',array('id_disposition' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('mailbox_disposition',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Berhasil diubah'));
				}
	}
    

    public function surat_save()
    {    	
    	$this->rbac->check_operation_access(); 
    	if($this->input->post('submit')) {
    		$this->form_validation->set_rules('kop_surat', 'Kop Surat', 'trim|required'); 
    		$this->form_validation->set_rules('perihal', 	'Perihal', 'trim|required'); 
    		$this->form_validation->set_rules('jenis_surat', 	'jenis_surat', 'trim|required'); 
    		$this->form_validation->set_rules('privasi_surat', 	'privasi_surat', 'trim|required'); 
    		$this->form_validation->set_rules('tanggal_surat', 	'tanggal_surat', 'trim|required'); 
    		$this->form_validation->set_rules('tanggal_terima', 	'tanggal_terima', 'trim|required'); 
			if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors());
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url('admin/tracemail/inbox_create'),'refresh');
			}
			else{
	         	$data = array(
	           				'kop_surat'				=> $this->input->post('kop_surat'), 
							'perihal' 				=> $this->input->post('perihal'),
							'jenis_surat' 			=> $this->input->post('jenis_surat'),
							'privasi_surat'			=> $this->input->post('privasi_surat'),
							'tanggal_surat'			=> $this->input->post('tanggal_surat'),
							'tanggal_terima'		=> $this->input->post('tanggal_terima'),
							'unit_penerima'			=> $this->input->post('unit_penerima'),
							'unit_pengirim' 		=> $this->input->post('unit_pengirim'),
							'username' 				=> $this->input->post('username'),			
							'status' 				=> $this->input->post('status'),			
							'disposition_unit' 		=> $this->input->post('disposition_unit'),			
							'surat_edaran' 			=> $this->input->post('surat_edaran'),			
							'unit_penerima_lainnya' => $this->input->post('unit_penerima_lainnya'),			
							'unit_pengirim_lainnya' => $this->input->post('unit_pengirim_lainnya'),			
							'tipe_surat' 			=> $this->input->post('tipe_surat'),			
							'keterangan_surat' 		=> $this->input->post('keterangan_surat'),
							'created_at'            => date('Y-m-d h:m:s'),
							'updated_at'            => date('Y-m-d h:m:s'),
						);				
        		$data = $this->tmail->InsertData('mailbox',$data);
        		$this->session->set_flashdata('success', 'Berhasil ditambah!');
				redirect(base_url('admin/tracemail/inbox'),'refresh');
			}			
    	}
    	else {
	    	$data['title'] 	= 'Tambah Surat Masuk';
	    	$data['unit']  	= $this->tmail->getUnit();
	    	$data['jenis']  = $this->tmail->getJS();
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/tracemail/inbox/create');
			$this->load->view('admin/includes/_footer', $data);
		}
    } 
    public function inbox_update()
    {
    	
    	$this->rbac->check_operation_access(); 
    	if($this->input->post()){

    	}else{
	    	$data['title'] = 'update Surat Masuk';
	    	$data['unit']  = $this->tmail->getUnit();
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/tracemail/inbox/update', $data);
			$this->load->view('admin/includes/_footer', $data);
		}
    } 
    public function inbox_delete()
    {
    	$this->rbac->check_operation_access();
		$value = $this->input->post('id'); 
    	$this->tmail->DeleteData('mailbox',array("id_archive" => $value)); 
		if(!empty($value)){		
			echo json_encode(array("status" => TRUE));
		}
		else {
			echo json_encode(array("status" => FALSE, "message"=> "Invalid CSRF Token"),JSON_PRETTY_PRINT);
		}   
    }



    // ===========================================================================================================================//
    // Surat Keluar
    // ===========================================================================================================================//
	public function outbox()
	{ 
		$data['title'] = 'Surat Keluar';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/outbox/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }


    // ===========================================================================================================================//
    // Arsip Surat
    // ===========================================================================================================================//
	public function archive()
	{ 
		$data['title'] = 'Arsip Surat';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/archive/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }
    

    // ===========================================================================================================================//
    // Data Unit @unit
    // ===========================================================================================================================//
	public function unit()
	{ 
		$data['title'] = 'Data Unit';
		$data['count'] = $this->tmail->count_data('unit');
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/unit/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }

    //-----------------------------------------------------		
	public function unit_save($id=""){
         	$id=$this->input->post('id');
         	if(!empty($id)){         		
            	$this->form_validation->set_rules('kode_unit', 'Kode Unit', 'trim|required'); 
         	}else{
            	$this->form_validation->set_rules('kode_unit', 'Kode Unit', 'trim|is_unique[unit.kode_unit]|required');  
         	}
            $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'trim|required');    
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						$config = array(
        				'upload_path' => "./uploads/tracemail/",
        				'allowed_types' => "gif|jpg|png|jpeg",
        				'overwrite' => TRUE,         			 
        				);
        				$this->load->library('upload', $config);

				    	$data = array(  
						'kode_unit'           => $this->input->post('kode_unit'),
						'nama_unit'            => $this->input->post('nama_unit'), 
						'created_at'            => date('Y-m-d h:m:s'),
						'updated_at'            => date('Y-m-d h:m:s'),
						);
						
						if($this->upload->do_upload('file'))  { 
        			    	$data['file']    = $this->upload->data('file_name');
        				}

						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('unit',array('id' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('unit',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Data Berhasi Disimpan'));
				}
	}
    
    

    // ===========================================================================================================================//
    // General Setting For Tracemail
    // ===========================================================================================================================//

	public function jenis_surat()
	{ 
		$data['title'] = 'Jenis Surat';
		$data['count'] = $this->tmail->count_data('jenis_surat');
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/jenis_surat/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }

    //-----------------------------------------------------		
	public function jenis_save($id=""){
         	$id=$this->input->post('id'); 
         	if(!empty($id)){         		
            	$this->form_validation->set_rules('jenis', 'Jenis Surat', 'trim|required'); 
         	}else{
            	$this->form_validation->set_rules('jenis', 'Jenis Surat', 'trim|is_unique[jenis_surat.jenis]|required');  
         	}  
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						$config = array(
        				'upload_path' => "./uploads/tracemail/",
        				'allowed_types' => "gif|jpg|png|jpeg",
        				'overwrite' => TRUE,         			 
        				);
        				$this->load->library('upload', $config);

				    	$data = array(  
						'slug'           		=> make_slug($this->input->post('jenis')),
						'jenis'            		=> $this->input->post('jenis'), 
						'created_at'            => date('Y-m-d h:m:s'),
						'updated_at'            => date('Y-m-d h:m:s'),
						);
						
						if($this->upload->do_upload('file'))  { 
        			    	$data['file']    = $this->upload->data('file_name');
        				}

						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('jenis_surat',array('id' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('jenis_surat',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Data Berhasi Disimpan'));
				}
	}
    
	public function status_surat()
	{ 
		$data['title'] = 'Status Surat';
		$data['count'] = $this->tmail->count_data('status_surat');
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/status_surat/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }

    public function disposisi()
	{ 
		$data['title'] = 'Data Disposisi Surat';		
		$data['c_sudah']	= $this->tmail->count_data('mailbox_disposition',array('status_terima' => "terima"));
		$data['c_belum']	= $this->tmail->count_data('mailbox_disposition',array('status_terima' => "belum"));
		$data['c_tolak']	= $this->tmail->count_data('mailbox_disposition',array('status_terima' => "tolak"));
		$data['c_all']	= $this->tmail->count_data('mailbox_disposition');
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/disposisi/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }

    //-----------------------------------------------------		
	public function status_surat_save($id=""){
         	$id=$this->input->post('id'); 
         	if(!empty($id)){         		
            	$this->form_validation->set_rules('nama_status', 'Nama Status', 'trim|required'); 
         	}else{
            	$this->form_validation->set_rules('nama_status', 'Nama Status', 'trim|is_unique[status_surat.nama_status]|required');  
         	}  
				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					); 
					$status = array(
						'status' => false,
						'msg' => strip_tags($data['errors']));
						header('Content-Type: application/json');
						echo json_encode($status);
				}else{

						$config = array(
        				'upload_path' => "./uploads/tracemail/",
        				'allowed_types' => "gif|jpg|png|jpeg",
        				'overwrite' => TRUE,         			 
        				);
        				$this->load->library('upload', $config);

				    	$data = array(  
						'slug_status'           => make_slug($this->input->post('nama_status')),
						'nama_status'           => $this->input->post('nama_status'), 
						'created_at'            => date('Y-m-d h:m:s'),
						'updated_at'            => date('Y-m-d h:m:s'),
						);
						
						if($this->upload->do_upload('file'))  { 
        			    	$data['file']    = $this->upload->data('file_name');
        				}

						if(!empty($id)){ $data['updated_at'] = date('Y-m-d h:m:s'); }
					    $data = $this->security->xss_clean($data);
						//===========================================================================
    					if(!empty($id)){
				            $result = $this->tmail->update_auto('status_surat',array('id' => $id),$data);
    					}else{
				        	$result = $this->tmail->add_auto('status_surat',$data);
    					}
						//===========================================================================
						header('Content-Type: application/json');
						echo json_encode(array("status" => $result, "msg" => 'Data Berhasi Disimpan'));
				}
	}
    






 	// Auto AJAX Data 
	//-------------------------------------------------------
	public function data_show($table=""){ 
	    $id= $this->input->post('id');
        $data =  $this->tmail->getAllData($table,'','',array('id' => $id));
	    echo json_encode($data);
	}  
	public function data_show_custom($table="",$field=""){ 
	    $id= $this->input->post('id');
        $data =  $this->tmail->getAllData($table,'','',array($field => $id));
	    echo json_encode($data);
	}  
	public function data_disposisi()
	{
		header('Content-Type: application/json');
	    $id= $this->input->post('id');
		$data = $this->tmail->GetListDisposition($id);
		echo json_encode($data);
	}
	
	public function show_edit_disposition(){ 
        $data =  $this->tmail->show_edit_disposition();
	    echo json_encode($data);
	}  	 
	public function data_surat()
	{
		header('Content-Type: application/json');
	    $id= $this->input->post('id');
		$data = $this->tmail->show_unit_mailbox($id);
		echo json_encode($data);
	}
	
	public function show_unit_mailbox(){ 
        $data =  $this->tmail->show_unit_mailbox();
	    echo json_encode($data);
	}  
	public function delete_auto($param=''){ 
		$id= $this->input->post('id');
		$delete = $this->tmail->delete_auto($param , array('id' => $id)); 
        return $delete;
		
    }

	public function delete_disposition(){ 
		$id= $this->input->post('id');
		$delete = $this->tmail->delete_auto('mailbox_disposition' , array('id_disposition' => $id)); 
        return $delete;
		
    }

    public function getDetailMailbox($id)
    {
    	$data = $this->tmail->getAllData('mailbox','','',array('id' => $id));
    	return $data;
    }
    public function getStatus($id)
    {
    	$data = $this->tmail->getAllData('status_surat','','',array('slug_status' => $id));
    	return $data;
    }
    

    // ===========================================================================================================================//
    // Datatables
    // ===========================================================================================================================// 

     public function dt_inbox()
    {
        $fetch_data = $this->tmail->datatable_inbox();
		$data = array();
		$no=0;		
        if(isset($_GET['start'])) { $no = $_GET['start']; }
        foreach ($fetch_data['data']  as $row) 
		{  
		$no++; 

		if($row['kd_pengirim'] == "0"){
			$pengirim = $row['unit_pengirim_lainnya'];
		}else{
			$pengirim = $row['kd_pengirim'];
		}
		if($row['kd_penerima']== "0"){
			$penerima = $row['unit_penerima_lainnya'];
		}else{
			$penerima = $row['kd_penerima'];
		}


			$data[]= array(
				$no,
				'<span data-id="'.$row['id'].'" id="show_data_agenda"  >'.$row['no_agenda'].'</span>',

				"<small> " .$row['kop_surat'] . " (".$row['jenis_surat'].") </small><br>".
				"<strong> " .$pengirim . " <small> -> </small> ".$penerima." </strong> <br> ".
				"<small> ".$row['perihal'] ." </small><br>",	

				$row['status'],

				 shortdate_indo($row['tanggal_surat']) ,

				'<div class="btn-group">
				 <a  data-id="'.$row['id'].'" id="show_disposisi"  class="btn btn-sm btn-primary text-white"><i class="fa fa-sign-in"></i>  Disposisi</a>
				 <a  data-id="'.$row['id'].'" id="show_data"  class="btn btn-sm btn-success text-white"><i class="fa fa-edit"></i>  Edit</a>
				 <a  data-del="'.$row['id'].'" id="del_'.$row['id'].'"   class="btn btn-sm btn-danger text-white delete"><i class="fa fa-trash"></i></a></div>',
			);
        }
		$fetch_data['data']=$data;
        echo json_encode($fetch_data);	
    }


     public function dt_unit()
    {
        $fetch_data = $this->tmail->datatable('*','unit');
		$data = array();
		$no=0;		
        if(isset($_GET['start'])) { $no = $_GET['start']; }
        foreach ($fetch_data['data']  as $row) 
		{  
		$no++; 
			$data[]= array(
				$no,
				$row['kode_unit'],
				$row['nama_unit'],  
				'<div class="btn-group">
				<a  data-id="'.$row['id'].'" id="show_data"  class="btn btn-sm btn-success text-white"><i class="fa fa-edit"></i>  Edit</a>
				<a  data-del="'.$row['id'].'" id="del_'.$row['id'].'"   class="btn btn-sm btn-danger text-white delete"><i class="fa fa-trash"></i></a></div>',
			);
        }
		$fetch_data['data']=$data;
        echo json_encode($fetch_data);	
    }


     public function dt_jenis()
    {
        $fetch_data = $this->tmail->datatable('*','jenis_surat');
		$data = array();
		$no=0;		
        if(isset($_GET['start'])) { $no = $_GET['start']; }
        foreach ($fetch_data['data']  as $row) 
		{  
		$no++; 
			$data[]= array(
				$no,
				$row['slug'],
				$row['jenis'],  
				'<div class="btn-group">
				<a  data-id="'.$row['id'].'" id="show_data"  class="btn btn-sm btn-success text-white"><i class="fa fa-edit"></i>  Edit</a>
				<a  data-del="'.$row['id'].'" id="del_'.$row['id'].'"   class="btn btn-sm btn-danger text-white delete"><i class="fa fa-trash"></i></a></div>',
			);
        }
		$fetch_data['data']=$data;
        echo json_encode($fetch_data);	
    }


     public function dt_status()
    {
        $fetch_data = $this->tmail->datatable('*','status_surat');
		$data = array();
		$no=0;		
        if(isset($_GET['start'])) { $no = $_GET['start']; }
        foreach ($fetch_data['data']  as $row) 
		{  
		$no++; 
			$data[]= array(
				$no,
				$row['slug_status'],
				$row['nama_status'],  
				'<div class="btn-group">
				<a  data-id="'.$row['id'].'" id="show_data"  class="btn btn-sm btn-success text-white"><i class="fa fa-edit"></i>  Edit</a>
				<a  data-del="'.$row['id'].'" id="del_'.$row['id'].'"   class="btn btn-sm btn-danger text-white delete"><i class="fa fa-trash"></i></a></div>',
			);
        }
		$fetch_data['data']=$data;
        echo json_encode($fetch_data);	
    }

     public function dt_disposisi()
    {
    	$mail =null;
        $fetch_data = $this->tmail->datatable_disposisi();
		$data = array();
		$no=0;		
        if(isset($_GET['start'])) { $no = $_GET['start']; }
        foreach ($fetch_data['data']  as $row) 
		{
		if(!empty($row['id_archive'])){  
		$mail = $this->getDetailMailbox($row['id_archive']);
		$stat = $this->getStatus($row['status']);
		 
		}
		$no++; 
			$data[]= array(
				$no, 
				@$mail[0]->kop_surat . ' <br>'.
				$row['nama_unit'].' <br> <small>'.
				@$stat[0]->nama_status . '</small>',  
				$row['desc_disposition'],  
				shortdate_indo($row['tanggal_disposition']),  
				$row['status_terima'], 
				'<div class="btn-group">				 
				<a  data-id="'.$row['id_disposition'].'"   id="show_data"  class="btn btn-sm btn-primary text-white"><i class="fa fa-sign-in"></i> Proses</a></div>',
			);
        }
		$fetch_data['data']=$data;
        echo json_encode($fetch_data);	
    }


    //  cari data
    public function cari_unit()
	{  
		$value    	= $this->input->post('searchTerm');
       	$produk   	= $this->tmail->cari_unit($value);
       	echo json_encode($produk);
	}

    public function cari_jenis_surat()
	{  
		$value    	= $this->input->post('searchTerm');
       	$produk   	= $this->tmail->cari_jenis_surat($value);
       	echo json_encode($produk);
	}
    public function cari_status_disposisi()
	{  
		$value    	= $this->input->post('searchTerm');
       	$produk   	= $this->tmail->cari_status_disposisi($value);
       	echo json_encode($produk);
	}

}