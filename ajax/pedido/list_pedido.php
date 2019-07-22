<?php
// retorno da operacao'
if($operacao[0]){
    $msgAlert = "S". $operacao[1];
}else{
    $msgAlert = "N". $operacao[1];
}

// Busca pedido
$registro = $pedido->select();

if($msgAlert){
    if(substr($msgAlert,0,1) == "S") {
        echo '<div class="alert alert-success">'.substr($msgAlert, 1).'</div>';
    } else {
        echo '<div class="alert alert-danger">'.substr($msgAlert, 1).'</div>';
	}
}?>
<h2>Lista Pedidos</h2>
<?php for($i=0;$i<sizeof($registro);$i++){ ?>
</br>
<div class="card">
    <h4>Pedido : <?= $registro[$i]["id"] ?></h4>
    <div class="card-body">
        <div class="row">
            <h5 class="col-md-6">Data : <?= $registro[$i]["data"] ?></h5>
            <h5 class="col-md-6">Total : <?= number_format($registro[$i]["total"],2,',','.') ?></h5>
        </div>
    </div>
    <h4>Produtos</h4>
    <?php
        $pedidoItem->setIdPedido($registro[$i]["id"]);
        $result = $pedidoItem->select();
        for($j=0;$j<sizeof($result);$j++){ 
    ?>
        <div class="card-body">
            <div class="row">
                <h5 class="col-md-3">SKU: <?= $result[$j]["sku"] ?></h5>
                <h5 class="col-md-3">Nome: <?= $result[$j]["nome"] ?></h5>
                <h5 class="col-md-2">Quantidade : <?= $result[$j]["quantidade"] ?></h5>
                <h5 class="col-md-2">Valor Unitario : <?= $result[$j]["vl_unitario"] ?></h5>
                <h5 class="col-md-2">Valor Total : <?= $result[$j]["vl_total"] ?></h5>
            </div>
        </div>
    <?php } ?>
</div>
<?php } ?>


