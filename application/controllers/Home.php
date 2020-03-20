<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct(){
		parent::__construct(); 
		$this->load->model('admin/Tracemail_model', 'auto');
	}
    public function index()
	{
		redirect(base_url('admin/tracemail'));
	}
	public function search($term="")
	{
		$term = $this->input->post('term');
		$this->form_validation->set_rules('term', 'No Surat/Token', 'trim|required|min_length[5]');
		$text = "<div id='show-data' >";
		if ($this->form_validation->run() == FALSE) {
			$type  = "error";
			$text .= validation_errors(); 
		}else{	
			$data = $this->auto->DJoin(
				'a.status as stat,a.id_archive as ida, a.*, b.*',
				'mailbox a','mailbox_disposition b','a.disposition_unit=b.id_disposition','','',
				array(
					"a.kop_surat = '".$term."' or a.token   = "  => $term
				),'','','');        
	        if(count($data) > 0){	        	
			        $disp  = $this->auto->getDisposition($data[0]->ida);
			        $type  = "terms";
					$text .= "NO : ".@$data[0]->kop_surat." <br>";
					$text .= "AGENDA : ".@$data[0]->no_agenda." <br>";
					$text .= "Perihal :" .@$data[0]->perihal. "<br>";
					$text .= "Status: ".@$data[0]->stat." <br>"; 
					$text .= "Disposisi:  ";
					$text .= implode(" >  ", $disp ); 				
			}else{ 
					$type  = "error";
					$text .= $term."  Tidak ditemukan"; }
		}
		$text .= "</div>";
		$callback = array(
			  'type'  => $type,
		      'hasil' => $text,  
		);
		echo json_encode($callback,JSON_PRETTY_PRINT);
	}
	
	 
	public function site_lang($site_lang) {
		echo $site_lang;
		echo '<br>';
		echo 'you will be redirected to :'.$_SERVER['HTTP_REFERER'];
		$language_data = array(
			'site_lang' => $site_lang
		);

		$this->session->set_userdata($language_data);
		if ($this->session->userdata('site_lang')) {
			echo 'user session language is = '.$this->session->userdata('site_lang');
		}
		redirect($_SERVER['HTTP_REFERER']);

		exit;
	}
}
