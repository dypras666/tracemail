<?php
class Tmail_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}


	public function count_data($db,$where='')
    {
        $this->db->select('*');
         if(!empty($where)):
            $this->db->where($where);
         endif;
        $query = $this->db->get($db);
        return $count = $query->num_rows();
    }

    public function count_mailbox($value='')
    {
    	$array = array(
    		'unit_pengirim' => $this->cekUser()[0]['unit_id'],
    		'status'  => $value
    	);
    	$this->db->where($array); 
        $query = $this->db->get('mailbox');
        return $count = $query->num_rows();
    }


    public function cekUser()
    {
    	$this->db->where('username',$this->session->userdata('username'));
    	return $this->db->get('ci_admin')->result_array();
    }
    
    //-------------------------------------------------------------------- CARI DATA
    public function cari_unit($term='')
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->like('nama_unit',$term,'both'); 
        $this->db->or_like('kode_unit',$term,'both'); 
        $query = $this->db->get();
        $dpt = $query->result_array();  
        $data = array();
        foreach($dpt as $user){
            $data[] = array("id"=>$user['id'], "text"=>$user['nama_unit']);
        }
        $data[] = array("id" => "", "text" => "Semua Data");
        return $data;
    }


    public function cari_jenis_surat($term='')
    {
        $this->db->select('*');
        $this->db->from('jenis_surat');
        $this->db->like('jenis',$term,'both'); 
        $query = $this->db->get();
        $dpt = $query->result_array();  
        $data = array();
        foreach($dpt as $user){
            $data[] = array("id"=>$user['slug'], "text"=>$user['jenis']);
        }
        $data[] = array("id" => "", "text" => "Semua Data");
        return $data;
    }

    //  datatables
    public function datatable_inbox()
   {
    $wh =array(); 
    $SQL ='select
            mailbox.id ,kop_surat,perihal,tanggal_surat,pengirim,penerima,kd_pengirim,kd_penerima,status,unit_penerima,unit_pengirim_lainnya,unit_penerima_lainnya,jenis_surat,no_agenda,disposition_unit,tanggal_agenda
            FROM  mailbox
        
        LEFT JOIN (select nama_unit as pengirim ,kode_unit as kd_pengirim, id as id_pengirim from unit b ) b ON b.id_pengirim=mailbox.unit_pengirim 
                LEFT JOIN (select nama_unit as penerima ,kode_unit as kd_penerima, id as id_penerima from unit c ) c ON c.id_penerima=mailbox.unit_penerima
                    LEFT join (select id_location as idloc,name_location from mailbox_location) mailbox_location on mailbox_location.idloc=mailbox.id_location';

    if($this->session->userdata('jenis_surat')!='')
    $wh[]="mailbox.jenis_surat = '".$this->session->userdata('jenis_surat')."'";

    if($this->session->userdata('status_surat')!='')
    $wh[]="mailbox.status = '".$this->session->userdata('status_surat')."'";

    if($this->session->userdata('penerima')!='')
    $wh[]="mailbox.unit_penerima = '".$this->session->userdata('penerima')."'";

    if($this->session->userdata('pengirim')!='')
    $wh[]="mailbox.unit_pengirim = '".$this->session->userdata('pengirim')."'";

    if($this->session->userdata('tanggal_awal')!='')
    $wh[]="mailbox.tanggal_surat between   '".$this->session->userdata('tanggal_awal')."' AND '".$this->session->userdata('tanggal_akhir')."'";

	$wh[] = " mailbox.unit_pengirim ='".$this->cekUser()[0]['unit_id']."'";
    if(count($wh)>0)
    {
        $WHERE = implode(' and ',$wh);
        return $this->datatable->LoadJson($SQL,$WHERE);
    }
    else
    {
        return $this->datatable->LoadJson($SQL);
    }
   }
}
