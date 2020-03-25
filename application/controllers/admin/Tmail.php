<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Tmail extends MY_Controller {

	private $user;
	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Tmail_model', 'tmail'); 
		$this->load->helper("file");
		$this->user = $this->tmail->cekUser()[0];
	}
	public function index()
	{ 
		$data['title'] = 'Tracemail';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tmail/dashboard', $data);
		$this->load->view('admin/includes/_footer', $data);
    }
	public function inbox()
	{  
		$data['count_diproses']	= $this->tmail->count_mailbox('disposisi');
		$data['count_belum']	= $this->tmail->count_mailbox('belum');
		$data['count_dikembalikan']	= $this->tmail->count_mailbox('dikembalikan');
		$data['count_all']	= $this->tmail->count_data('mailbox',array('unit_pengirim' => $this->user['unit_id']));
		$data['title'] = 'Inbox';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tmail/inbox/inbox', $data);
		$this->load->view('admin/includes/_footer', $data);
    }
	public function outbox()
	{ 
		$data['title'] = 'Outbox';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tmail/outbox/outbox', $data);
		$this->load->view('admin/includes/_footer', $data);
    }
    public function archive()
	{ 
		$data['title'] = 'Outbox';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tmail/archive/archive', $data);
		$this->load->view('admin/includes/_footer', $data);
    }
    public function draft()
	{ 
		$data['title'] = 'Outbox';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/tmail/draft/draft', $data);
		$this->load->view('admin/includes/_footer', $data);
    }


    //  pencarian
    public function inbox_search()
    {
    	$this->session->set_userdata('jenis_surat',$this->input->post('jenis_surat_filter'));
		$this->session->set_userdata('status_surat',$this->input->post('status_surat_filter'));
		$this->session->set_userdata('penerima',$this->input->post('unit_penerima_filter')); 
		$this->session->set_userdata('tanggal_awal',$this->input->post('tanggal_awal_filter')); 
		$this->session->set_userdata('tanggal_akhir',$this->input->post('tanggal_akhir_filter')); 
    }

    public function inbox_search_reset()
    {
    	
    	$this->session->unset_userdata('jenis_surat');
		$this->session->unset_userdata('status_surat');
		$this->session->unset_userdata('penerima'); 
		$this->session->unset_userdata('tanggal_awal'); 
		$this->session->unset_userdata('tanggal_akhir'); 
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


	

    //  DATATABLES
    public function dt_inbox($value='')
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

     


}
