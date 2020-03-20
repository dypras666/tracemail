<?php defined('BASEPATH') OR exit('No direct script access allowed');
	
class Gis extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->rbac->check_module_access();
		$this->load->model('admin/Auto_model', 'auto');
		$this->load->helper("file");
	}

	public function index()
	{ 
		$data['title'] = 'GIS System';
		$this->load->view('admin/includes/_header');
		$this->load->view('admin/gis/dashboard', $data);
		$this->load->view('admin/includes/_footer');
    }





    /*LOKASI */
    
    public function gis_lokasi_list()
    {
        $data['title'] = 'List Lokasi ';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/gis/lokasi_list', $data);
		$this->load->view('admin/includes/_footer');
	}
    public function gis_lokasi_add()
    {
        if($this->input->post('submit')){
			$config = array(
				'upload_path' => "./uploads/gis_tempat/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "1200",
				'max_width' => "1900"
			);
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$data = array(
					    'kecamatan'			=> $this->input->post('kecamatan'),
           				'desa'				=> $this->input->post('desa'),
						'nama_tempat' 		=> $this->input->post('nama_tempat'),
						'lat' 				=> $this->input->post('lat'),
						'lng' 				=> $this->input->post('lng'),
						'jenis_lampu'		=> $this->input->post('jenis_lampu'),
						'daya'				=> $this->input->post('daya'),
						'jenis_ornamen'		=> $this->input->post('jenis_ornamen'),
						'meterisasi'		=> $this->input->post('meterisasi'),
						'lokasi' 			=> $this->input->post('lokasi'),
						'keterangan' 		=> $this->input->post('keterangan'),		
						'status' 		=>$this->input->post('status'),
						'updated_at' 		=> date('Y-m-d H:i:s'),
						'gambar' 		=> $_FILES['userfile']['name'],									
					);
				$data = $this->auto->InsertData('ci_tempat',$data);
				redirect(base_url('admin/gis/gis_lokasi_list'),'refresh');
			}
			else
			{
				$data = array(
						'kecamatan'			=> $this->input->post('kecamatan'),
           				'desa'				=> $this->input->post('desa'),
						'nama_tempat' 		=> $this->input->post('nama_tempat'),
						'lat' 				=> $this->input->post('lat'),
						'lng' 				=> $this->input->post('lng'),
						'jenis_lampu'		=> $this->input->post('jenis_lampu'),
						'daya'				=> $this->input->post('daya'),
						'jenis_ornamen'		=> $this->input->post('jenis_ornamen'),
						'meterisasi'		=> $this->input->post('meterisasi'),
						'lokasi' 			=> $this->input->post('lokasi'),
						'keterangan' 		=> $this->input->post('keterangan'),		
						'status' 			=> $this->input->post('status'),
						'updated_at' 		=> date('Y-m-d H:i:s'), 								
						);	

				$data = $this->auto->InsertData('ci_tempat',$data);
				// $data['error'] = array('error' => $this->upload->display_errors());
				redirect(base_url('admin/gis/gis_lokasi_list'),'refresh');		 
			}
		}
		else{
			$data['title'] = 'Tambah Lokasi';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/gis/lokasi_add', $data);
			$this->load->view('admin/includes/_footer');
		}
	}
	public function gis_lokasi_view($id='')
	{
		if($id == NULL){ redirect(base_url('admin/gis/gis_lokasi_list')); }
		if($this->input->post('submit')){ 
			$config = array(
				'upload_path' => "./uploads/gis_tempat/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", 
				// 'max_height' => "1200",
				// 'max_width' => "1900"
			);
			$this->load->library('upload', $config);

			if(!empty($_FILES['userfile']['name'])){
				if($this->upload->do_upload())
				{
					// cek foto dan hapus dengan yang baru
					$foto = $this->auto->getAllData('ci_tempat','','',array('id_tempat' => $id));
					if(file_exists('uploads/gis_tempat/'.$foto[0]->gambar)){
						unlink('uploads/gis_tempat/'.$foto[0]->gambar);
					}	
					$data = array(
						'kecamatan'			=> $this->input->post('kecamatan'),
           				'desa'				=> $this->input->post('desa'),
						'nama_tempat' 		=> $this->input->post('nama_tempat'),
						'lat' 				=> $this->input->post('lat'),
						'lng' 				=> $this->input->post('lng'),
						'jenis_lampu'		=> $this->input->post('jenis_lampu'),
						'daya'				=> $this->input->post('daya'),
						'jenis_ornamen'		=> $this->input->post('jenis_ornamen'),
						'meterisasi'		=> $this->input->post('meterisasi'),
						'lokasi' 			=> $this->input->post('lokasi'),
						'keterangan' 		=> $this->input->post('keterangan'),		
						'status' 			=>$this->input->post('status'),
						'updated_at' 		=> date('Y-m-d H:i:s'),
						'gambar' 		=> $_FILES['userfile']['name'],								
						);					
					// var_dump($foto[0]->gambar);
					$data = $this->auto->UpdateDB('ci_tempat','id_tempat='. $id,$data); 
					// var_dump($data);
					redirect(base_url('admin/gis/gis_lokasi_list'),'refresh');
					
				}
				else
				{
					
					$data['error'] = array('error' => $this->upload->display_errors());		
					$data['lokasi'] = $this->auto->getAllData('ci_tempat','','',array('id_tempat' => $id)); 
					$data['gallery'] = $this->auto->DJoin('*','ci_albums_gallery','ci_albums','ci_albums_gallery.id_album=ci_albums.id_album','','',array('lokasi_album' => $id));		
					$data['title'] = 'Edit Lokasi'; 
					$this->load->view('admin/includes/_header',$data);
					$this->load->view('admin/gis/lokasi_edit', $data);
					$this->load->view('admin/includes/_footer');
				}
			}else{
					$data = array(
						'kecamatan'			=> $this->input->post('kecamatan'),
           				'desa'				=> $this->input->post('desa'),
						'nama_tempat' 		=> $this->input->post('nama_tempat'),
						'lat' 				=> $this->input->post('lat'),
						'lng' 				=> $this->input->post('lng'),
						'jenis_lampu'		=> $this->input->post('jenis_lampu'),
						'daya'				=> $this->input->post('daya'),
						'jenis_ornamen'		=> $this->input->post('jenis_ornamen'),
						'meterisasi'		=> $this->input->post('meterisasi'),
						'lokasi' 			=> $this->input->post('lokasi'),
						'keterangan' 		=> $this->input->post('keterangan')	,	
						'status' 		=>$this->input->post('status'),
						'updated_at' 		=> date('Y-m-d H:i:s'),						
						);
					$data = $this->auto->UpdateDB('ci_tempat','id_tempat='. $id,$data); 
					redirect(base_url('admin/gis/gis_lokasi_list'),'refresh');
					// var_dump($_FILES['userfile']['name']);
			}
		}
		else{
			$data['title'] = 'Update Lokasi';  
			$data['lokasi'] = $this->auto->getAllData('ci_tempat','','',array('id_tempat' => $id)); 
			$data['gallery'] = $this->auto->DJoin('*','ci_albums_gallery','ci_albums','ci_albums_gallery.id_album=ci_albums.id_album','','',array('lokasi_album' => $id));
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/gis/lokasi_edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}
 
	public function gis_lokasi_import_excel()
	{
		$this->load->library("PHPExcel");
        $objPHPExcel = new PHPExcel(); 
        $sheet  = $objPHPExcel->getActiveSheet(); 
        $data   = array();        
        if (!empty($_FILES['file']['name'])) {
            $config = array(
				'upload_path' => "./uploads/gis_excel/",
				'allowed_types' => "xls|xlsx|csv",
				'overwrite' => TRUE,
				'max_size' => "2048000",  
			);
			$this->load->library('upload', $config);
			$file = '';
            if ($this->upload->do_upload('file')){
                $media  = $this->upload->data();
                $file    = $media['file_name'];
                $path_file    = './uploads/gis_excel/'. $file;
                
                try {
                    $inputFileType  = PHPExcel_IOFactory::identify($path_file);
                    $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel    = $objReader->load($path_file);
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($path_file, PATHINFO_BASENAME) . '": ' . $e->getMessage());
                }

                $sheet          = $objPHPExcel->getSheet(0);
                $highestRow     = $sheet->getHighestRow();
                $highestColumn  = $sheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++) {               
                    $rowLamp = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
                    if(!empty($rowLamp[0][0]))
                    {
                        $lamp     = array();
                        $lamp[]   = $rowLamp[0][0];             
                        $lamp[]   = $rowLamp[0][1];        
                        $lamp[]   = $rowLamp[0][2];            
                        $lamp[]   = $rowLamp[0][3];          
                        $lamp[]   = $rowLamp[0][4];               
                        $lamp[]   = $rowLamp[0][5];     
                        $lamp[]   = $rowLamp[0][6];      
                        $lamp[]   = $rowLamp[0][7];      
                        $lamp[]   = $rowLamp[0][8];      
                        $lamp[]   = $rowLamp[0][9];      
                        $lamp[]   = $rowLamp[0][10];     
                        $lamp[]   = $rowLamp[0][11];                         

                        $data[]  = $lamp;
                    } 
                } 
            }
        }
        $output = array("data" => $data);
        echo json_encode($output);
	}

	public function gis_converter_xls_to_csv(){
		$path = './uploads/gis_excel/DATABASE_E-LAMP_FINAL.xlsx'; 
		$nama = "oke";
		if(!empty($path)){
			$this->load->library("PHPExcel");
	        $objReader = new PHPExcel(); 
			// $excel = PHPExcel_IOFactory::load($path.$file);
			// $writer = PHPExcel_IOFactory::createWriter($excel, 'CSV');
			// $writer->setDelimiter(";");
			// $writer->setEnclosure("");
			// $writer->save('/uploads/gis_excel/convert_csv/'.$nama.".csv");
		
		$inFile = $path;
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load($inFile);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');   
		$index = 0;
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    		$objPHPExcel->setActiveSheetIndex($index);
   			 // write out each worksheet to it's name with CSV extension
   			$outFile = str_replace(array("-"," "), "_", $worksheet->getTitle()) .".csv";
    		$objWriter->setSheetIndex($index);
    		$objWriter->save($outFile);
   		  $index++;
		}	

		} 
	}

	public function gis_lokasi_save()
	{
		$response       	= true; 
		$id 				= $this->input->post('id');
        if(!empty($id)) {
           $data = array(
           				'kecamatan'			=> $this->input->post('kecamatan'),
           				'desa'				=> $this->input->post('desa'),
						'nama_tempat' 		=> $this->input->post('nama_tempat'),
						'lat' 				=> $this->input->post('lat'),
						'lng' 				=> $this->input->post('lng'),
						'jenis_lampu'		=> $this->input->post('jenis_lampu'),
						'daya'				=> $this->input->post('daya'),
						'jenis_ornamen'		=> $this->input->post('jenis_ornamen'),
						'meterisasi'		=> $this->input->post('meterisasi'),
						'lokasi' 			=> $this->input->post('lokasi'),
						'keterangan' 		=> $this->input->post('keterangan')				
					);
			$this->auto->InsertData('ci_tempat',$data); 
        } else {
            $response  = false;
        }

        $data = array($response,$id);
        echo json_encode(array("data"=>$data));	

	}
	public function gis_lokasi_delete()
	{
		$id = $this->input->post('id'); 
		$this->auto->DeleteDB('ci_tempat','id_tempat = '.$id); 
		if(!empty($id)){		
			echo json_encode(array("status" => TRUE));
		}
		else {
			echo json_encode(array("status" => FALSE, "message"=> "Invalid CSRF Token"),JSON_PRETTY_PRINT);
		} 
	}









	// Album 
    public function gis_album()
    {
        $data['title'] = 'Album ';
		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/gis/album_list', $data);
		$this->load->view('admin/includes/_footer');
    }
    public function gis_album_add()
    {
		if($this->input->post('submit')){
			$config = array(
				'upload_path' => "./uploads/gis_album/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "1200",
				'max_width' => "1900"
			);
			$this->load->library('upload', $config);
			if($this->upload->do_upload())
			{
				$data = array(
					'judul_album' =>$this->input->post('judul_album'),
					'keterangan_album' =>$this->input->post('keterangan'),
					'lokasi_album' =>$this->input->post('lokasi_album'),
					'foto_album' => $this->upload->data('file_name'),								
					);
				$data = $this->auto->InsertData('ci_albums',$data);
				redirect(base_url('admin/gis/gis_album'),'refresh');
			}
			else
			{
				$data['error'] = array('error' => $this->upload->display_errors());				
				$data['title'] = 'Tambah Album ';
				$this->load->view('admin/includes/_header',$data);
				$this->load->view('admin/gis/album_add', $data);
				$this->load->view('admin/includes/_footer');
			}
		}
		else{
			$data['title'] = 'Tambah Album ';
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/gis/album_add', $data);
			$this->load->view('admin/includes/_footer');
		}
	}
	public function gis_album_upload_gallery()
	{
		$config = array(
				'upload_path' => "./uploads/gis_gallery",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'encrypt_name' => TRUE,
				'overwrite' => TRUE,
				'max_size' => "2048000", 
				'max_height' => "1200",
				'max_width' => "1900"
			);
			$this->load->library('upload', $config);

			if($this->upload->do_upload('file'))
			{
				$path = 'uploads/gis_gallery/';
				$data = array(
					'id_album'		=> $this->input->post('id_album'),
					'file_gallery'  => $path.$this->upload->data('file_name'),
					'created_at'    => date('Y-m-d H:i:s')
				);
				$data = $this->security->xss_clean($data);
				$this->auto->InsertData('ci_albums_gallery',$data);
				$this->session->set_flashdata('success','File berhasil diupload');
				$return = array('status' => 'success' , 'message' => 'File Uploaded');
				echo json_encode($return);
			}
			else
			{
				$this->session->set_flashdata('errors',$this->upload->display_errors());
				$return = array('status' => 'error' , 'message' => '');
				echo json_encode($return);
			}
	}
	public function gis_album_view($id='')
	{

		if($id == NULL){ redirect(base_url('admin/gis/gis_album')); }
		if($this->input->post('submit')){ 
			$config = array(
				'upload_path' => "./uploads/gis_album/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", 
				// 'max_height' => "1200",
				// 'max_width' => "1900"
			);
			$this->load->library('upload', $config);

			if(!empty($_FILES['userfile']['name'])){
				if($this->upload->do_upload())
				{
					// cek foto dan hapus dengan yang baru
					$foto = $this->auto->getAllData('ci_albums','','',array('id_album' => $id));
					if(file_exists('uploads/gis_album/'.$foto[0]->foto_album)){
						unlink('uploads/gis_album/'.$foto[0]->foto_album);
					}	
					$data = array(
						'judul_album' 		=> $this->input->post('judul_album'),
						'keterangan_album' 	=> $this->input->post('keterangan'),
						'lokasi_album' 		=>$this->input->post('lokasi_album'),
						'updated_at' 		=> date('Y-m-d H:i:s'),
						'foto_album' 		=> $_FILES['userfile']['name'],								
						);					
					// var_dump($foto[0]->foto_album);
					$data = $this->auto->UpdateDB('ci_albums','id_album='. $id,$data);
					redirect(base_url('admin/gis/gis_album'),'refresh');
					
				}
				else
				{
					$data['error'] = array('error' => $this->upload->display_errors());				
					$data['title'] = 'Upload/Ubah Album';
					$this->load->view('admin/includes/_header',$data);
					$this->load->view('admin/gis/album_edit', $data);
					$this->load->view('admin/includes/_footer');
				}
			}else{
					$data = array(
						'judul_album' 		=> $this->input->post('judul_album'),
						'keterangan_album' 	=> $this->input->post('keterangan'), 
						'lokasi_album' 		=> $this->input->post('lokasi_album'),
						'updated_at' 		=> date('Y-m-d H:i:s'),								
						);
					$data = $this->auto->UpdateDB('ci_albums','id_album='. $id,$data); 
					redirect(base_url('admin/gis/gis_album'),'refresh');
					// var_dump($_FILES['userfile']['name']);
			}
		}
		else{
			$data['title'] = 'Upload/Ubah Album';
			$data['total'] = $this->auto->count_data('ci_albums_gallery','id_album='.$id);
			$data['lokasi'] = $this->auto->getAllData('ci_tempat');
			$data['maps_lokasi'] = $this->auto->DJoin('*','ci_tempat','ci_albums','ci_tempat.id_tempat=ci_albums.lokasi_album','','',array('id_album' => $id));		
			$data['album'] = $this->auto->getAllData('ci_albums','','',array('id_album' => $id));
			$data['gallery'] = $this->auto->getAllData('ci_albums_gallery','','',array('id_album' => $id));
			$this->load->view('admin/includes/_header', $data);
			$this->load->view('admin/gis/album_edit', $data);
			$this->load->view('admin/includes/_footer');
		}		
	}
	public function gis_album_delete()
	{
		$id = $this->input->post('id');
		$foto = $this->auto->getAllData('ci_albums_gallery','','',array('id_album' => $id));
		foreach ($foto as $row) {
			if(file_exists(FCPATH.$row->file_gallery)) 
				{
					unlink(FCPATH.$row->file_gallery);		
				}
		}
		$this->auto->DeleteDB('ci_albums','id_album = '.$id);
		$this->auto->DeleteDB('ci_albums_gallery','id_album = '.$id);
		if(!empty($id)){		
			echo json_encode(array("status" => TRUE));
		}
		else {
			echo json_encode(array("status" => FALSE, "message"=> "Invalid CSRF Token"),JSON_PRETTY_PRINT);
		} 
	}
	public function gis_album_gallery_delete()
	{	
		$id = $this->input->post('id');
		$foto = $this->auto->getAllData('ci_albums_gallery','','',array('id_gallery' => $id));
		foreach ($foto as $row) { 
			unlink($row->file_gallery);
		}	
		$this->auto->DeleteDB('ci_albums_gallery','id_gallery = '.$id);	 	 
		if(!empty($id)){		
			echo json_encode(array("status" => TRUE));
		}
		else {
			echo json_encode(array("status" => FALSE, "message"=> "Invalid CSRF Token"),JSON_PRETTY_PRINT);
		} 
	}
	/* Datatables */
    public function dt_lokasi()
    {
        $lampords = $this->auto->datatable(
            'id_tempat,nama_tempat,lat,lng,lokasi,status,created_at,updated_at',
            'ci_tempat');
        $data = array();
        foreach ($lampords['data']  as $row) 
		{  
			$data[]= array(
				$row['nama_tempat'],
				$row['lat'],
				$row['lng'],
				$row['lokasi'],
				$row['status'],
				'<small>Created: '.date_time($row['created_at']).'<br>'.
				'Updated: '.date_time($row['updated_at']).'</small>',				
				'<div class="btn-group"><a href="'.base_url('admin/gis/gis_lokasi_view/'.$row['id_tempat']).'" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>  Edit</a><a href="#" class="btn btn-sm btn-danger" onclick="hapus('.$row['id_tempat'].')"><i class="fa fa-trash"></i> Hapus</a></div>',
			);
        }
		$lampords['data']=$data;
        echo json_encode($lampords);	
    }
    public function dt_album()
    {
        $lampords = $this->auto->datatable(
            'id_album,judul_album,ci_albums.created_at,ci_albums.updated_at,lokasi_album,nama_tempat',
			'ci_albums',
			'left join ci_tempat on ci_tempat.id_tempat=ci_albums.lokasi_album'
		);
		$data = array();
		$no=0;
        foreach ($lampords['data']  as $row) 
		{  $no++;
			$total = $this->auto->count_data('ci_albums_gallery','id_album='.$row['id_album']);
			$data[]= array(
				$no,
				$row['judul_album'].'<br><span class="badge badge-primary">Ada '.$total.' Foto</span>',
				$row['nama_tempat'], 
				'<small>Created: '.date_time($row['created_at']).'<br>'.
				'Updated: '.date_time($row['updated_at']).'</small>',				
				'<div class="btn-group"><a href="'.base_url('admin/gis/gis_album_view/'.$row['id_album']).'" class="btn btn-sm btn-success"><i class="fa fa-upload"></i> Upload/Edit</a><a href="#" class="btn btn-sm btn-danger" onclick="hapus('.$row['id_album'].')"><i class="fa fa-trash"></i> Hapus</a></div>',
			);
        }
		$lampords['data']=$data;
        echo json_encode($lampords);	
    }
}