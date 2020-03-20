<?php
class Tracemail_model extends CI_Model
{


	function __construct()
	{
		parent::__construct();
	}



    // ===========================================================================================================================//
	// Get Data	
    // ===========================================================================================================================//


	// @unit
    public function getUnit($value='')
    {
    	// If Data Condition Not Empty Will Show 
    	if(!empty($value) ? $where = array("id_unit" => $value): $where ="");   
    		$data = $this->getAllData('unit','','',$where); 
    	return $data;
    }

    // @jenis surat
    public function getJS($value='')
    {
    	// If Data Condition Not Empty Will Show 
    	if(!empty($value) ? $where = array("id" => $value): $where ="");  
    		$data = $this->getAllData('jenis_surat','','',$where);
    	return $data;
    }

    // @disposition
    public function getDisposition($id="")
	{
		$fetch 	= $this->getAllData('mailbox_disposition','','',array('id_archive' => $id));
		$data 	= array();
		foreach ($fetch as $value) {
			$for 	= $this->getUnit($value->unit_tujuan); 
			$exec 	= $this->getUnit($value->unit_pemroses); 
			$rows    = $for[0]->kode_unit ;  
			$data[] = $rows;
 		}
 		return $data ;
	}

	// @auto
	public function update_auto($table,$Where,$Data)
    {
        $this->db->where($Where);
        $Update = $this->db->update($table,$Data);
        if ($Update):
            return true;
        else:
            return false;
        endif;
    } 

    //-----------------------------------------------------
	public function delete_auto($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }


    //--------------------------------------------------------------------

	public function add_auto($table,$data){

    	$this->db->insert($table, $data);

    	return true;
    }



    //-------------------------------------------------------------------- CARI DATA
    public function cari_unit($term='')
    {
        $this->db->select('*');
        $this->db->from('unit');
        $this->db->like('nama_unit',$term,'both'); 
        $query = $this->db->get();
        $dpt = $query->result_array();  
        $data = array();
        foreach($dpt as $user){
            $data[] = array("id"=>$user['id'], "text"=>$user['nama_unit']);
        }
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
        return $data;
    }

    //  show mailbox 
    public function show_unit_mailbox()
    {        
        $id= $this->input->post('id');
        $this->db->select('
            mailbox.id ,            kop_surat,              perihal,        tanggal_surat,  tanggal_terima,
            status,                 unit_penerima,          unit_pengirim,  tipe_surat,     privasi_surat,
            unit_pengirim_lainnya,  unit_penerima_lainnya,
            jenis_surat,            no_agenda,
            disposition_unit,       tanggal_agenda,
            b.pengirim ,            c.penerima ,             d.jenis

            ');
        $this->db->from('mailbox');
        $this->db->join('(select nama_unit as pengirim , id as id_pengirim from unit b ) b ', ' b.id_pengirim=mailbox.unit_pengirim');
        $this->db->join('(select nama_unit as penerima , id as id_penerima from unit c ) c ', ' c.id_penerima=mailbox.unit_penerima');
        $this->db->join('jenis_surat d ', 'd.slug=mailbox.jenis_surat','left');
        $this->db->where('mailbox.id',$id);
        $query=$this->db->get();
        return $query->result();
    }

    //GET All
	function getAllData($table,$specific='',$row='',$Where='',$order='',$limit='',$groupBy='',$like = '')
	{
		// If Condition
		if (!empty($Where)):
			$this->db->where($Where);
		endif;
		// If Specific Columns are require
		if (!empty($specific)):
			$this->db->select($specific);
		else:
			$this->db->select('*');
		endif;

		if (!empty($groupBy)):
			$this->db->group_by($groupBy);
		endif;
		// if Order
		if (!empty($order)):
			$this->db->order_by($order);
		endif;
		// if limit
		if (!empty($limit)):
			$this->db->limit($limit);
		endif;

		//if like
		if(!empty($like)):
			$this->db->like($like);
		endif;	
		// get Data
		
		//if select row
		if(!empty($row)):
			$GetData = $this->db->get($table);
			return $GetData->row();
		else:
			$GetData = $this->db->get($table);
			return $GetData->result();
		endif;	
	}

	//  GET With JOIN
	function DJoin($field,$tbl,$jointbl1,$Joinone,$row='',$jointbl3='',$Where='',$order='',$groupy = '',$limit = '',$like = '',$term = '')
    {
        $this->db->select($field);
        $this->db->from($tbl);
        $this->db->join($jointbl1,$Joinone);
        if (!empty($jointbl3)):
            foreach ($jointbl3 as $Table => $On):
                $this->db->join($Table,$On);
            endforeach;
        endif;
        // if Group
		if (!empty($groupy)):
			$this->db->group_by($groupy);
		endif;
        if(!empty($order)):
            $this->db->order_by($order);
        endif;
        if(!empty($Where)):
            $this->db->where($Where);
        endif;
        if(!empty($limit)):
            $this->db->limit($limit);
        endif;
        
        if(!empty($term)): 
			$array_term = explode(',', $like);
			foreach($array_term as $key => $value) {
			    if($key == 0) {
			        $this->db->like($value, $term);
			    } else {
			        $this->db->or_like($value, $term);
			    }
			}
        endif;

        if(!empty($row)):
			$query = $this->db->get();
			return $query->row();
		else:
	        $query=$this->db->get();
	        return $query->result();
	    endif;	    

    }

	// Insert data
	function InsertData($table,$Data)
	{
		$Insert = $this->db->insert($table,$Data);
		if ($Insert):
			return true;
		endif;
	}


	// Update Data
	function UpdateData($table,$Where,$Data)
	{
		$this->db->where($Where);
		$Update = $this->db->update($table,$Data);
		if ($Update):
			return true;
		else:
			return false;
		endif;
	}


	// Delete Data
	function DeleteData($table,$where)
    {
    	$this->db->where($where);
    	$done = $this->db->delete($table);
    	if ($done) {
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }


   // COUNT DATA
  	public function count_data($db,$where='')
    {
        $this->db->select('*');
         if(!empty($where)):
            $this->db->where($where);
         endif;
        $query = $this->db->get($db);
        return $count = $query->num_rows();
    }

   //  COUNT DATA WITH JOIN
   public function count_data_join($db,$table_join='',$join_using='',$where,$group)
   {
	   $this->db2->select('*');
	   $this->db2->from($db);
	   $this->db2->join($table_join,$join_using);
	   $this->db2->where($where);
	   $this->db2->group_by($group);
	   $query = $this->db2->get();
	   return $count = $query->num_rows();
   }

   // DATATABLES
   public function datatable($select,$table,$join='',$where_array='')
   {
    $wh =array();
    $wh[] = $where_array;
    $SQL ='select
            '.$select.'
            FROM '.$table.'
                    '.$join;
  
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