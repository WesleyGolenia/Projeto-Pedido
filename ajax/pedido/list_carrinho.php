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
