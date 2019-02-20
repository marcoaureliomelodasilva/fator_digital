          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Banners</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
				<form class="form-inline my-2 my-md-0" method="POST" action="/banners/filtrar">
					<select class="form-control mr-2" name="campo_filtro" id="campo_filtro">
						<option value="todos">Todos</option>
						<option value="nome">Nome do banner</option>
						<option value="descricao">Descrição</option>
						<option value="data">Data</option>
					</select>
			        <input class="form-control" type="text" placeholder="Palavra chave" name="string_filtro" id="string_filtro">
				</form>
            </div>
          </div>