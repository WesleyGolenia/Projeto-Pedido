<head>
<link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="plugins/font-awesome/css/all.css" rel="stylesheet" />
<link href="assets/css/produto.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="content">
<a  href="index.php" class="btn btn-info btn-icon btn-sm " style="margin-left:20px;">
    <i class="fa fa-undo"></i> Voltar para o Menu
</a>
  	<div class="card col-md-6 order-md-1">
    <h2>Produtos</h2>
   		<input id="id" name="id" type="hidden"/>
		<div class="form-group">
			<label for="sku">SKU</label>
			<input type="text" class="form-control" id="sku" name="sku" aria-describedby="sku" placeholder="Digite o SKU">
			<small id="valida_sku" class="form-text mensagem"></small>
		</div>

		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome" placeholder="Digite o nome do produto">
			<small id="valida_nome" class="form-text text-muted"></small>
		</div>

		<div class="form-group">
			<label for="descricao">Descrição</label>
			<textarea rows="4" cols="50" class="form-control" id="descricao" name="descricao" aria-describedby="descricao" placeholder="Digite a descricao"></textarea>
		</div>

		<div class="form-group">
			<label for="preco">Preço</label>
			<input type="text" class="form-control" id="preco" name="preco" onkeyup="formatMoney(this)" maxlength="10">
			<small id="valida_preco" class="form-text text-muted"></small>
		</div>
		<button id="btn_salva" name="btn_salva" onclick="javaScript:salva(<?= $registro[$i]["id"] ?>)" class="btn btn-success btn-round">Adicionar</button>
		<button id="btn_cancela" name="btn_cancela" onclick="javaScript:cancela(<?= $registro[$i]["id"] ?>)" class="btn btn-danger btn-round" style="display:none">Cancelar</button>
    </div>
</div>
</br>
<div class="row">
	<div class="card col-md-6 order-md-2">
			<div class="card-body">
			<h2>Lista Produtos</h2>
			<div id="div_retorno">
				<table id="datatable" id="tableproduto" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead class="text-primary">
						<th class="text-center">
						ID
						</th>
						<th>
						SKU
						</th>
						<th class="text-right">
						Nome
						</th>
						<th class="text-right">
						Descricao
						</th>
						<th class="text-right">
						Preço
						</th>
						<th class="text-right">
						Ação
						</th>
					</thead>
					<tbody>
					<?php for($i=0;$i<sizeof($registro);$i++){ ?>
					<tr>
						<td class="text-center">
							<?= $registro[$i]["id"] ?>
						</td>
						<td>
							<?= $registro[$i]["sku"] ?>
						</td>
						<td>
							<?= $registro[$i]["nome"] ?>
						</td>
						<td>
							<?= $registro[$i]["descricao"] ?>
						</td>
						<td>
							<?= number_format($registro[$i]["preco"],2,',','.') ?>
						</td>
						<td class="text-right">
							<?php if($registro[$i]["situacao"] == 'A'){ ?>
								<button type="button" rel="tooltip" onclick="javaScript:bloquear_produto(<?= $registro[$i]["id"] ?>)" class="btn btn-primary btn-icon btn-sm " title="Bloquear produto"><i class="fas fa-check"></i>
							<?php }else{ ?>
								<button type="button" rel="tooltip" onclick="javaScript:bloquear_produto(<?= $registro[$i]["id"] ?>)" class="btn btn-danger btn-icon btn-sm " title="Desbloquear produto"><i class="fas fa-ban"></i>
							<?php } ?>
							</button>
							<button type="button" rel="tooltip" onclick="javaScript:recupera_produto(<?= $registro[$i]["id"] ?>)" class="btn btn-success btn-icon btn-sm " title="Editar produto">
								<i class="fas fa-edit"></i>
							</button>
							<button type="button" rel="tooltip" onclick="javaScript:excluir_produto(<?= $registro[$i]["id"] ?>)" class="btn btn-danger btn-icon btn-sm " title="Deletar produto">
								<i class="fas fa-times"></i>
							</button>
						</td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>
</body>
<footer>
	<script src="plugins/jquery/js/jquery.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/produto.js"></script>
</footer>
