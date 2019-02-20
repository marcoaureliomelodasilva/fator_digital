<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

	public $msg = array();

    /****************************************************************
	* Exibe a index da pagina de banner
    *****************************************************************/
	public function index()
	{
		$this->viewBanners();
	}

    /****************************************************************
	* Controle da view de listagem de banner
    *****************************************************************/
	public function viewBanners()
	{
		$this->load->model('M_banners');
		// Seleciona dados dos banner
		$data['banners'] = $this->M_banners->selectBanner();
		// Monta a estrutura da pagina
		$this->load->view('structure/head');	
		$this->load->view('structure/nav');
		$this->load->view('structure/container_page_open');
		$this->load->view('structure/container_main_open');
		$this->load->view('structure/header');
		$this->load->view('message/message_modal',$data);
		$this->load->view('structure/sidebar');
		$this->load->view('content/listar_banner',$data);
		$this->load->view('structure/container_main_close');
		$this->load->view('structure/footer');
		$this->load->view('structure/container_page_close');
		$this->load->view('structure/footer_script');
	}

    /******************************************************************
	* Controle da view do formulario de insercao de banner
    *******************************************************************/
	public function newBanner()
	{
		$data='';
		$msg = array();
		$action = $this->input->post('act_banner');

		// insere dados de um novo banner
		if (isset($action) && $action == 'enviar_banner') {		
			$post = $this->input->post();
			$this->load->model('M_banners');
   			$this->msg  = $this->M_banners->insertBanner($post);
		}
		if(isset($this->msg['alert']) && count($this->msg['alert'])>0) {$data['alert'] = $this->msg['alert']; };
		// Monta a estrutura da pagina
		$this->load->view('structure/head');	
		$this->load->view('structure/nav');
		$this->load->view('structure/container_page_open');
		$this->load->view('structure/container_main_open');
		$this->load->view('structure/header');
		$this->load->view('message/message_modal',$data);
		$this->load->view('structure/sidebar');
		$this->load->view('content/criar_banner',$data);
		$this->load->view('structure/container_main_close');
		$this->load->view('structure/footer');
		$this->load->view('structure/container_page_close');
		$this->load->view('structure/footer_script');
	}

    /****************************************************************
	* Controle da view do formulario de edicao de banner
    *****************************************************************/
	public function editBanner()
	{
		$data='';
		$msg = array();
		$action = $this->input->post('act_banner');
		$this->load->model('M_banners');
		$id_banner = $this->uri->segment(2);
		$data['banners'] = $this->M_banners->selectBannerId($id_banner);

		// Edita dados de um banner
		if (isset($action) && $action == 'enviar_banner') {
			$post = $this->input->post();
			$post['id_banner'] = $id_banner;
   			$this->msg  = $this->M_banners->editBanner($post);
		}

		// exclui uma imagem do banner apartir da pagina de editar
		if (isset($action) && $action == 'excluir-imagem') {
   			$this->msg  = $this->M_banners->deleteImageBannerId($id_banner);
   			$data['banners']['imagem']='';
		}

		if(isset($this->msg['alert']) && count($this->msg['alert'])>0) {$data['alert'] = $this->msg['alert']; };
		
		$data['id_banner'] = $id_banner;
		// Monta a estrutura da pagina
		$this->load->view('structure/head');	
		$this->load->view('structure/nav');
		$this->load->view('structure/container_page_open');
		$this->load->view('structure/container_main_open');
		$this->load->view('structure/header');
		$this->load->view('message/message_modal',$data);
		$this->load->view('structure/sidebar');
		$this->load->view('content/criar_banner',$data);
		$this->load->view('structure/container_main_close');
		$this->load->view('structure/footer');
		$this->load->view('structure/container_page_close');
		$this->load->view('structure/footer_script');
	}

    /****************************************************************
	* Controle de view da pagina de filtro de banners
    *****************************************************************/
	public function filterBanner()
	{
		$filter = $this->input->post();
		$this->load->model('M_banners');
		$data['banners'] = $this->M_banners->selectBannerFilter($filter);
		// Monta a estrutura da pagina
		$this->load->view('structure/head');	
		$this->load->view('structure/nav');
		$this->load->view('structure/container_page_open');
		$this->load->view('structure/container_main_open');
		$this->load->view('structure/header');
		$this->load->view('message/message_modal',$data);
		$this->load->view('structure/sidebar');
		$this->load->view('content/listar_banner',$data);
		$this->load->view('structure/container_main_close');
		$this->load->view('structure/footer');
		$this->load->view('structure/container_page_close');
		$this->load->view('structure/footer_script');
	}

    /****************************************************************
	* Controle de exclusao de banner
    *****************************************************************/
	public function deleteBanner()
	{
		$post = $this->input->post();
		if (isset($post['id']) && $post['id']>0) {
			$this->load->model('M_banners');
			$this->M_banners->deleteBannerId($post['id']);
		}
	}
}
