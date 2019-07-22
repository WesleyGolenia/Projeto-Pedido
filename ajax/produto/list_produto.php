<?php
// retorno da operacao'
if($operacao[0]){
    $msgAlert = "S". $operacao[1];
}else{
    $msgAlert = "N". $operacao[1];
}

// Busca produtos
$produto->setId(NULL);
$registro = $produto->select();

if($msgAlert){
    if(substr($msgAlert,0,1) == "S") {
        echo '<div class="alert alert-success">'.substr($msgAlert, 1).'</div>';
    } else {
        echo '<div class="alert alert-danger">'.substr($msgAlert, 1).'</div>';
	}
}?>

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
                <i class="fa fa-edit"></i>
            </button>
            <button type="button" rel="tooltip" onclick="javaScript:excluir_produto(<?= $registro[$i]["id"] ?>)" class="btn btn-danger btn-icon btn-sm " title="Deletar produto">
                <i class="fa fa-times"></i>
            </button>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>


