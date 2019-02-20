<div class="col-md-12 order-md-1">
    <div class="row">
	    <h4 class="col-md-12 d-flex justify-content-between align-items-center mb-3">
	    	<span class="text-muted">Lista de banner</span>
	    </h4>
	    <div class="col-md-12 order-md-1">
	        <div class="row">
				<ul class="list-group w-100">
					<?php 
					// Exibe todos os banners salvos em banco na ordem definida pelo o usuario
					if (isset($banners) && count($banners)>0) {
						foreach ($banners as $k => $v) {
							// Caminho e arquivo do banner
							$file = base_url("/public/banners/".$v['imagem']);
							// Caminho e arquivo do banner padão caso não tenha sido salvo o banner
							$fileDefault = base_url("/public/banners/banner_default.jpg");
					?>
						<li class="list-group-item item-list-<?php echo $v['id']; ?>" data-toggle="collapse" href="#cps-<?php echo $k; ?>" role="button" aria-expanded="false" aria-controls="cps-<?php echo $k; ?>">
							<div class="f-right align-items-right w-100">
								  <span class="text-gray-dark m-0 p-0">
								  	<strong class="p-1"><?php echo $v['ordem']; ?></strong> - 
								  	<strong class="p-1"><?php echo $v['nome']; ?></strong> - 
								  	<span><?php echo _dataHora('d/m/Y H:i:s', $v['dthr_cadastro']); ?></span>
								  </span>
								  <div class="float-right">
									 	<a class="block-collapse btn btn-primary btn-sm" href="/banners/<?php echo $v['id']; ?>/editar">
									 		<i class="fas fa-edit"></i> Editar</a>

										<a class="block-collapse btn btn-danger btn-sm excluir-imagem" href="#" name="excluir-banner" data-id="<?php echo $v['id']; ?>" data-toggle="modal" data-target="#confirm-excluir-banner">
											<i class="far fa-trash-alt"></i> Excluir</a>
								  </div>
							</div>
							<p class="media-body pb-3 mb-0 mt-3 small lh-125 collapse" id="cps-<?php echo $k; ?>">
								<?php if (isset($v['imagem']) && $v['imagem']!='') { ?>
								<img height="160" src="<?php echo $file; ?>">
								<?php }else{ ?>
								<img height="160" src="<?php echo $fileDefault; ?>">
								<?php } ?>
							</p>
						</li>
					<?php 
						}	
					}else{
					?>
					<li class="list-group-item text-center">
						Nenhum banner foi encontrado.
					</li>
					<?php } ?>
				</ul>
	        </div>
	    </div>
	</div>
</div>