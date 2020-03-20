<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Tmail_inbox extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Tracemail_model', 'tmail'); 
		$this->load->helper("file");
	}

    // ===========================================================================================================================//
    //  Surat Masuk
    // ===========================================================================================================================//

	public function index()
	{ 
		$data['title'] = 'Surat Masuk';
		$data['count_inbox']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-masuk"));
		$data['count_inbox_bl']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-masuk", "status" => "belum"));
		$data['count_outbox']	= $this->tmail->count_data('mailbox',array('tipe_surat' => "surat-keluar"));
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/inbox/index', $data);
		$this->load->view('admin/includes/_footer', $data);
    }

 
    public function add()
    {
    	
    	$this->rbac->check_operation_access(); 
    	if($this->input->post('submit')){

    	}else{
    	$data['title'] = 'Tambah Surat Masuk';
    	$data['unit']  = $this->tmail->getUnit();
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tracemail/inbox/create', $data);
		$this->load->view('admin/includes/_footer', $data);
		}
    } 