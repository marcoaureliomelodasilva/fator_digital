<?php 

/******************************************************
* Aqui estao os codigos de alertas e confimacoes
* e modais que interagem com o sistema
******************************************************/ 

if (isset($alert) && count($alert)>0) {
	$am = new AlertsAndMessages();
	switch ($alert['type']) {
		case 'danger':
	        $config = array(
	            'title' => 'Erro',
	            'id' => 'myModal',
	            'content' => $alert['message'],
	            'label_close' => 'Fechar',
	            'class' => ' modal-primary ',
	            'class_header' => 'bg-danger text-white',
	            'redirect' => (isset($alert['redirect']) && $alert['redirect']!='') ? $alert['redirect'] : '' ,
	        );
			echo $am->modalAlert($config);
			break;
		default:
	        $config = array(
	            'title' => 'Sucesso',
	            'id' => 'myModal',
	            'content' => $alert['message'],
	            'label_close' => 'Fechar',
	            'class' => ' modal-primary ',
	            'class_header' => 'bg-success text-white',
	            'redirect' => (isset($alert['redirect']) && $alert['redirect']!='') ? $alert['redirect'] : '',
	        );
			echo $am->modalAlert($config);
			break;
	}
}
?>

<div class="modal" tabindex="-1" role="dialog" id="confirm-excluir-imagem">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmar exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir esta imagem?</p>
      </div>
      <div class="modal-footer">
      	<?php echo form_open_multipart('banners/'.$banners["id"].'/editar', array('id' => 'form'));?>
	        <button type="sumit" name="act_banner" id="act_banner" class="btn btn-danger" value="excluir-imagem">Excluir</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <input  type="hidden" name="id_banner" id="id-banner" value="<?php echo (isset($banners["id"]) && $banners["id"]>0)?$banners["id"]:0; ?>">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="confirm-excluir-banner">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirmar exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tem certeza que deseja excluir este banner?</p>
      </div>
      <div class="modal-footer">
   	    <button type="button" id="act-excluir-banner" class="btn btn-danger" value="0">Excluir</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>