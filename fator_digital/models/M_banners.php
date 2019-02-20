<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_banners extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }   

    /****************************************************************
	* Faz a insercao e upload dos dados e arquivo do banner
    *****************************************************************/
	public function insertBanner($post)
	{
		$this->load->database('default');

		$t = $this->load->helper('slugifier');
		$slug = new Slugifier();
		$slug->setTransliterate(true);

		$nm_nome = ($post['nm_nome']) ? $slug->slugify($post['nm_nome']) : 'image_'.date('h');
		$nm_img  = $nm_nome.'_'.date('His');

		// configura os dados de upload do bannner
		$config = array(
		'upload_path' => "./public/banners/",
		'allowed_types' => "gif|jpg|png|jpeg|pdf",
		'overwrite' => TRUE,
		'max_size' => "12048000", // 2 MB(2048 Kb)
		'file_name'     =>  $nm_img,
		// 'max_width' => "1048"
		// 'max_height' => "768",
		);

		$this->load->library('upload', $config);
        if (!$this->upload->do_upload('nm_imagem')){

            $upload_error = array('error' => $this->upload->display_errors());

        } else {

			if (isset($this->upload->client_name) && $this->upload->client_name!='' || true) {

				$this->db->select('COUNT(id)');
				$this->db->from('tb_banners');
				$this->db->where('imagem', $this->upload->client_name);
				$query = $this->db->get();
				$num = $query->num_rows();

				$upload = $this->upload->data();

				$post['nm_imagem'] = $nm_img.$upload['file_ext'];
				
				$post['dthr_atual']  = date('Y-m-d H:i:s');
				$post['nm_ativo'] = ($post['nm_ativo']==1 || $post['nm_ativo']=='on') ? 1 : 0 ;

				$insert = array( 
					'nome'	           =>  $post['nm_nome'],
					'imagem'           =>  $post['nm_imagem'],
					'txt_destaque'     =>  $post['nm_txt_dest'],
					'txt_descricao'    =>  $post['nm_txt_desc'], 
					'ordem'            =>  $post['nm_ordem'],
				    'ativo'	           =>  $post['nm_ativo'],
				    'dthr_cadastro'	   =>  $post['dthr_atual']
				);

		 		if ($this->db->insert('tb_banners', $insert)) {
		 			$id = $this->db->insert_id();
		 			// header('Location: /banners');
		 			return array('alert' => array('type'=>'success','message'=>'Banner salvo com sucesso!'));
		        }else{
		        	return array('alert' => array('type'=>'danger','message'=>'Erro no envio do banner!'));
		        }
			
			}

	    }

	}

    /****************************************************************
	* Seleciona todos os banner cadastrados no banco
    *****************************************************************/
	public function selectBanner()
	{
		$this->load->database('default');
		$this->db->select('id, nome, imagem, txt_destaque, txt_descricao, ordem, ativo, dthr_cadastro');
		$this->db->from('tb_banners');
		$this->db->order_by('ordem','ASC');
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		$result = $query->result_array();
		if ($num_rows>0) {
			return $result;
		}		
	}

    /****************************************************************
	* Seleciona um banner cadastrado no banco pelo seu ID
    *****************************************************************/
	public function selectBannerId($id)
	{
		$this->load->database('default');
		$this->db->select('id, nome, imagem, txt_destaque, txt_descricao, ordem, ativo, dthr_cadastro');
		$this->db->from('tb_banners');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		$result = $query->row_array();
		if ($num_rows>0) {
			return $result;
		}		
	}

    /**************************************************************************
	* Seleciona todos os banners validos feito pelo filtro de busca do usuario
    ***************************************************************************/
	public function selectBannerFilter($filter)
	{
		$this->load->database('default');
		$this->db->select('id, nome, imagem, txt_destaque, txt_descricao, ordem, ativo, dthr_cadastro');
		$this->db->from('tb_banners');
	
		// Verifica a opcao de filtro do usuario e configura a query de busca
		switch ($filter["campo_filtro"]) {
			// busca por nome do banner
			case 'nome':
				$this->db->like("nome", $filter["string_filtro"]);
				break;
			// busca pela descricao do banner
			case 'descricao':
				$this->db->like("txt_destaque", $filter["string_filtro"]);
				$this->db->or_like("txt_descricao", $filter["string_filtro"]);
				break;
			// busca pela data de cadastro do banner
			case 'data':
				$dt = _dataHora('Y-m-d', $filter["string_filtro"]);
				$this->db->like("dthr_cadastro", "$dt");
				break;
			// Caso não tenha sido especificado, busca todos os banners
			default:
				$this->db->like("campo_filtro", $filter["string_filtro"]);
				break;
		}
		$query = $this->db->get();
		$num_rows = $query->num_rows();
		$result = $query->result_array();
		if ($num_rows>0) {
			return $result;
		}
	}

    /************************************
	* Edita os dados de banner pelo ID
    *************************************/
	public function editBanner($post)
	{
		$idBanner = $post['id_banner'];
		$this->load->database('default');

		$t = $this->load->helper('slugifier');
		$slug = new Slugifier();
		$slug->setTransliterate(true);

		$post['dthr_atual']  = date('Y-m-d H:i:s');
		$post['nm_ativo'] = ($post['nm_ativo']==1 || $post['nm_ativo']=='on') ? 1 : 0 ;

		$nm_nome = ($post['nm_nome']) ? $slug->slugify($post['nm_nome']) : 'image_'.date('h');
		$nm_img  = $nm_nome.'_'.date('His');


		// Se existir um valor de imagem para upload, entao a imagem é enviada
		if (isset($_FILES['nm_imagem']["name"]) && $_FILES['nm_imagem']["name"]!='') {

			// configura os dados de upload do bannner
			$config = array(
			'upload_path' => "./public/banners/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "12048000", // 2 MB(2048 Kb)
			'file_name'     =>  $nm_img,	
			// 'max_width' => "1048"
			// 'max_height' => "768",
			);

			$this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('nm_imagem')){
	            return array('alert' => array('type'=>'danger','message'=>'Ops, verifique se tipo e tamanho do arquivo enviado.','redirect'=>''));
	        }
       		$upload = $this->upload->data();
			$post['nm_imagem'] = $nm_img.$upload['file_ext'];
			$insert = array( 
				'nome'	           =>  $post['nm_nome'],
				'imagem'           =>  $post['nm_imagem'],
				'txt_destaque'     =>  $post['nm_txt_dest'],
				'txt_descricao'    =>  $post['nm_txt_desc'], 
				'ordem'            =>  $post['nm_ordem'],
			    'ativo'	           =>  $post['nm_ativo'],
			    'dthr_cadastro'	   =>  $post['dthr_atual']
			);

		// Se ja existir um de imagem para upload, entao apenas os dados basicos serão atualizados
		}else{
			$insert = array( 
				'nome'	           =>  $post['nm_nome'],
				'txt_destaque'     =>  $post['nm_txt_dest'],
				'txt_descricao'    =>  $post['nm_txt_desc'], 
				'ordem'            =>  $post['nm_ordem'],
			    'ativo'	           =>  $post['nm_ativo'],
			);
		}

		$this->db->where('id', $idBanner);
 		if ($this->db->update('tb_banners', $insert)) {
 			return array('alert' => array('type'=>'success','message'=>'Banner atualizado com sucesso!','redirect'=>'/'));
        }else{
        	return array('alert' => array('type'=>'danger','message'=>'Erro ao atualizar o banner!','redirect'=>'/'));
        }

	}

    /************************************
	* Deleta um banner pelo seu ID
    *************************************/
	public function deleteBannerId($id)
	{
		$banner = $this->selectBannerId($id);
		$filename = base_url("/public/banners/".$banner['imagem']);

		$banner = $this->selectBannerId($id);
		$filename = "./public/banners/".$banner['imagem'];
		if (file_exists($filename)) {
			@unlink($filename);
			$this->load->database('default');
			$update = array( 'imagem' => '' );
			if (isset($banner['id']) && isset($banner['imagem'])) {
				$this->db->where('id', $banner["id"]);
				if ($this->db->delete('tb_banners')) {
		 			return array('alert' => array('type'=>'success','message'=>'Banner excluido com sucesso!'));
		        }else{
		        	return array('alert' => array('type'=>'danger','message'=>'Erro ao excluir banner!'));
				}
			}
        }else{
        	return array('alert' => array('type'=>'danger','message'=>'Erro na exclusão do banner!'.$filename));
		}
	}

    /*****************************************
	* Deleta uma imagem pelo ID de um banner
    ******************************************/
	public function deleteImageBannerId($id)
	{
		$banner = $this->selectBannerId($id);
		$filename = "./public/banners/".$banner['imagem'];
		if (file_exists($filename)) {
			@unlink($filename);
			$this->load->database('default');
			$update = array( 'imagem' => '' );
			if (isset($banner['id']) && isset($banner['imagem'])) {
				$this->db->where('id', $banner["id"]);
		 		if ($this->db->update('tb_banners', $update)) {
		 			return array('alert' => array('type'=>'success','message'=>'Imagem excluida com sucesso!'));
		        }else{
		        	return array('alert' => array('type'=>'danger','message'=>'Erro ao excluir dados da imagem!'));
				}
			}
        }else{
        	return array('alert' => array('type'=>'danger','message'=>'Erro na exclusão da imagem!'.$filename));
		}
	}

}

