<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_Controller {

	public function __construct(){
		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/dashboard_model', 'dashboard_model');
		$this->load->model('admin/auto_model', 'auto');
	}

	//--------------------------------------------------------------------------
	public function index(){  
		$data['title'] = 'Home';
		$data['c_surat_masuk']	 = $this->auto->count_data('mailbox',array('tipe_surat' => "surat-masuk"));
		$data['c_surat_keluar']	 = $this->auto->count_data('mailbox',array('tipe_surat' => "surat-keluar"));
		$data['c_surat_blm']	 = $this->auto->count_data('mailbox',array('tipe_surat' => "surat-masuk", 'status' => "belum"));
		$data['c_surat_semua']	 = $this->auto->count_data('mailbox');
		$this->load->view('admin/includes/_header', $data);
    	$this->load->view('admin/dashboard/index', $data);
    	$this->load->view('admin/includes/_footer');
	}
	

	 
	
}

?>	