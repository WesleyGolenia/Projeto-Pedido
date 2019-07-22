<head>
<link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="plugins/font-awesome/css/all.css" rel="stylesheet" />
<link href="assets/css/pedido.css" rel="stylesheet" />
</head>
<body class="bg-light" onload="calculatotal();">
<a  href="index.php" class="btn btn-info btn-icon btn-sm " style="margin-left:20px;">
    <i class="fa fa-undo"></i> Voltar para o Menu
</a>
<div class="row">
	<div class="card col-md-6 order-md-2">
		<div class="card-body">
			<h2>Lista Produtos</h2>
			<div>
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
					<?php for($i=0;$i<sizeof($produtos);$i++){ ?>
					<tr>
						<td class="text-center">
							<?= $produtos[$i]["id"] ?>
						</td>
						<td>
							<?= $produtos[$i]["sku"] ?>
						</td>
						<td>
							<?= $produtos[$i]["nome"] ?>
						</td>
						<td>
							<?= $produtos[$i]["descricao"] ?>
						</td>
						<td>
							<?= number_format($produtos[$i]["preco"],2,',','.') ?>
						</td>
						<td class="text-right">
							<button type="button" rel="tooltip" onclick="javaScript:adicionar_carrinho(<?= $produtos[$i]["id"] ?>,1)" class="btn btn-success btn-icon btn-sm " title="Adicionar ao Carrinho">
								<i class="fas fa-shopping-cart"></i>
							</button>
						</td>
					</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="card col-md-6 order-md-2">
		<div class="card-body">
			<h2>Pedido</h2>
			<div id="div_retorno">
				<table id="datatable" id="tableproduto" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead class="text-primary">
						<th>
						SKU
						</th>
						<th class="text-right">
						Nome
						</th>
						<th class="text-right">
						Quantidade
						</th>
						<th class="text-right">
						Valor Unitario
						</th>
						<th class="text-right">
						Valor Total
						</th>
						<th class="text-right">
						Ação
						</th>
					</thead>
					<tbody>
					<?php foreach($_SESSION['cart'] as $produtos){ ?>
					<tr>
						<td>
							<?= $produtos["sku"] ?>
						</td>
						<td>
							<?= $produtos["nome"] ?>
						</td>
						<td>
							<input type="number" id="qtde<?= $produtos["id"] ?>" name="qtde" required placeholder="quantidade" min="1" max="100" step="1" onchange="calcula_total(this.value,<?= $produtos["valor_unitario"] ?>,<?= $produtos["id"] ?>)" value="<?= $produtos["quantidade"] ?>" />
						</td>
						<td>
							<?= number_format($produtos["valor_unitario"],2,',','.') ?>
						</td>
						<td id="total<?= $produtos["id"] ?>">
							<?= number_format($produtos["valor_total"],2,',','.') ?>
						</td>
						<td class="text-right">
							<button type="button" rel="tooltip" onclick="javaScript:remove_carrinho(<?= $produtos["id"] ?>)" class="btn btn-danger btn-icon btn-sm " title="Deletar Carrinho">
								<i class="fas fa-trash"></i>
							</button>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<td colspan="2">Total</td>
						<td id="qt_total"></td>
						<td></td>
						<td id="vl_total"></td>
						<td></td>
					</tr>
					</tbody>
				</table>
			</div>
			<button type="button" rel="tooltip" onclick="javaScript:insere_pedido()" class="btn btn-info btn-icon btn-sm " title="Inserir Pedido">
				Finalizar Pedido
			</button>
		</div>
	</div>
</div>
<div class="row">
	<div class="card col-md-12 order-md-2">
		<div class="card-body" id="list_pedido">
			<h2>Lista Pedidos</h2>
			<?php for($k=0;$k<sizeof($pedidos);$k++){ ?>
			</br>
			<div class="card">
				<h4>Pedido : <?= $pedidos[$k]["id"] ?></h4>
				<div class="card-body">
					<div class="row">
						<h5 class="col-md-6">Data : <?= date("d/m/Y H:i:s", strtotime($pedidos[$k]["data"])) ?></h5>
						<h5 class="col-md-6">Total : <?= number_format($pedidos[$k]["total"],2,',','.') ?></h5>
					</div>
				</div>
				<h4>Produtos</h4>
				<?php
				 $pedidoItem->setIdPedido($pedidos[$k]["id"]);
				 $result = $pedidoItem->select();
				 for($j=0;$j<sizeof($result);$j++){ 
				?>
					<div class="card-body">
						<div class="row">
							<h5 class="col-md-3">SKU: <?= $result[$j]["sku"] ?></h5>
							<h5 class="col-md-3">Nome: <?= $result[$j]["nome"] ?></h5>
							<h5 class="col-md-2">Quantidade : <?= $result[$j]["quantidade"] ?></h5>
							<h5 class="col-md-2">Valor Unitario : <?= number_format($result[$j]["vl_unitario"],2,',','.') ?></h5>
							<h5 class="col-md-2">Valor Total : <?= number_format($result[$j]["vl_total"],2,',','.') ?></h5>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

</body>
<footer>
	<script src="plugins/jquery/js/jquery.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/pedido.js"></script>
</footer>
