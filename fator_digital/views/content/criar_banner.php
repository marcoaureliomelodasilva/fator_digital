<?php
    // Pagina de criação e edição de banner
	$banners["id"]            = (isset($banners["id"]) && $banners["id"]>0)? $banners["id"] : 0 ;
	$banners["nome"]          = (isset($banners["id"]) && $banners["id"]!='')? $banners["nome"] : '' ;
	$banners["imagem"]        = (isset($banners["id"]) && $banners["id"]!='')? $banners["imagem"] : '' ;
	$banners["txt_destaque"]  = (isset($banners["id"]) && $banners["id"]!='')? $banners["txt_destaque"] : '' ;
	$banners["txt_descricao"] = (isset($banners["id"]) && $banners["id"]!='')? $banners["txt_descricao"] : '' ; 
	$banners["ordem"]         = (isset($banners["id"]) && $banners["id"]!='')? $banners["ordem"] : '' ;
	$banners["ativo"]         = (isset($banners["id"]) && $banners["id"]!='')? 'checked=checked' : '' ;
	$banners["dthr_cadastro"] = (isset($banners["id"]) && $banners["id"]!='')? $banners["dthr_cadastro"] : '' ;
	$file_banner = base_url("/public/banners/".$banners["imagem"]);
?>

<div class="col-md-12 order-md-1">
    <div class="row">
	    <h4 class="col-md-12 d-flex justify-content-between align-items-center mb-3">
	    	<span class="text-muted">Cadastro e edição de banner</span>
	    </h4>
	    <div class="col-md-12 list-group mb-3 d-flex ">
	        <div class="list-group-item d-flex justify-content-between lh-condensed">
	        	<div class="col-md-6 order-md-1">
				<?php 
				if ($banners["id"]>0) {
					echo form_open_multipart('banners/'.$banners["id"].'/editar', array('id' => 'form'));
				}else{
					echo form_open_multipart('banners/novo', array('id' => 'form'));
				}	
				?>
		            <label for="id_nome">Nome</label>
		            <input type="text" name="nm_nome" class="form-control" id="id_nome" placeholder="" value="<?php echo $banners["nome"]; ?>" required="">

		            <label for="id_txt_dest">Destaque</label>
		            <input type="text" name="nm_txt_dest" class="form-control" id="id_txt_dest" placeholder="" value="<?php echo $banners["txt_destaque"]; ?>">

		            <label for="nm_txt_desc">Descrição</label>
		            <input type="text" name="nm_txt_desc" class="form-control" id="nm_txt_desc" placeholder="" value="<?php echo $banners["txt_descricao"]; ?>">		

		            <label for="nm_ordem">Ordem</label>
		            <input type="text" name="nm_ordem" class="form-control" id="nm_ordem" placeholder="" value="<?php echo $banners["ordem"]; ?>">
					
					<div class="form-group mt-3">
						<div class="<?php echo ($banners['imagem'] == '')? 'd-block' : 'd-none' ; ?>">
				            <label for="nm_imagem">Buscar arquivo</label>
				            <input type="file" name="nm_imagem" class="form-control border-0 p-0" id="nm_imagem" placeholder="">
			            </div>
		           	</div>

					<div class="custom-control custom-checkbox mb-3">
						<input type="checkbox" name="nm_ativo" class="custom-control-input" id="nm_ativo" placeholder="" <?php echo $banners["ativo"]; ?>>
						<label class="custom-control-label" for="nm_ativo">Banner ativo</label>
					</div>	

		            <button type="sumit" name="act_banner" class="btn btn-primary btn-lg btn-block mt-3" id="act_banner" value="enviar_banner">Salvar</button>	
					
				</form>
				</div>
				<div class="col-md-6 order-md-2">
					<div class="<?php echo ($banners['imagem'] == '')? 'd-none' : 'd-block' ; ?>">
						<?php echo form_open_multipart('banners/novo', array('id' => 'form'));?>
						<img width="100%" src="<?php echo $file_banner; ?>">
						<a href="#" id="excluir-imagem" name="excluir-imagem" data-id="<?php echo $banners["id"]; ?>" class="btn btn-danger btn-sm btn-block mt-3 col-md-4" data-toggle="modal" data-target="#confirm-excluir-imagem"><i class="far fa-trash-alt mr-1"></i> Excluir imagem</a>
						</form>
					</div>
			    </div>
	        </div>
	    </div>
	</div>
</div>