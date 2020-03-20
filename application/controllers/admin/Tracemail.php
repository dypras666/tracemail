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
		$data['title'] = 'Surat Masuk';
		$data['unit']  	= $this->tmail->getUnit();
	    	$data['jenis']  = $this->tmail->getJS();
		$data['count_inbox']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-masuk"));
		$data['count_inbox_bl']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-masuk", "status" => "belum"));
		$data['count_outbox']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-keluar"));
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/inbox/index', $data);
		$this->load->view('admin/includes/_footer', $data);
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
							'status' 				=> $this->input->post('status'),			
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
    






 	// Auto Data 
	//-------------------------------------------------------
	public function data_show($table=""){ 
	    $id= $this->input->post('id');
        $data =  $this->tmail->getAllData($table,'','',array('id' => $id));
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
    

    // ===========================================================================================================================//
    // Datatables
    // ===========================================================================================================================// 

     public function dt_inbox()
    {
        $fetch_data = $this->tmail->datatable(
            'mailbox.id ,kop_surat,perihal,tanggal_surat,pengirim,penerima,status,unit_penerima,unit_pengirim_lainnya,unit_penerima_lainnya,jenis_surat,no_agenda,disposition_unit,tanggal_agenda',
			'mailbox',
			'LEFT JOIN (select nama_unit as pengirim , id as id_pengirim from unit b ) b ON b.id_pengirim=mailbox.unit_pengirim 
		    	LEFT JOIN (select nama_unit as penerima , id as id_penerima from unit c ) c ON c.id_penerima=mailbox.unit_penerima
		    		LEFT join (select id_location as idloc,name_location from mailbox_location) mailbox_location on mailbox_location.idloc=mailbox.id_location'
		);
		$data = array();
		$no=0;		
        if(isset($_GET['start'])) { $no = $_GET['start']; }
        foreach ($fetch_data['data']  as $row) 
		{  
		$no++; 
			$data[]= array(
				$no,
				$row['no_agenda'],
				$row['kop_surat'],
				$row['perihal'], 
				'<small>'.date_time($row['tanggal_agenda'])."</small>", 
				'<div class="btn-group">
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

}