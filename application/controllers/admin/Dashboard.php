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

		$this->load->view('admin/includes/_header', $data);
    	$this->load->view('admin/dashboard/index', $data);
    	$this->load->view('admin/includes/_footer');
	}
	public function json_list_lokasi()
	{
		$lokasi = $this->auto->getAllData('ci_tempat');
		$data = array();
		foreach ($lokasi as $row) {
			$data[] = array(				
				'id_tempat'	=> $row->id_tempat,
				'lokasi' =>  $row->lokasi,
				'nama_tempat' =>  $row->nama_tempat,
				'lat' => $row->lat, 
				'lng' => $row->lng,
				'map_image_url' =>  'http://gis.saktiputra.com/assets/images/tempat/'.$row->gambar,
				'rate' => 'Laporan kerusakan | 7',
				'name_point' =>  $row->nama_tempat,
				'get_directions_start_address' => $row->lokasi, 
				'url_point' => base_url()

			);
		}
		 
		return $data ;
	} 

	 
	
}

?>	