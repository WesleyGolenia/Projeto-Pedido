
function formatMoney(i) {
	var v = i.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	i.value = v;
}
function formatMoneyJavascript(i) {
	var v = i.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	return v;
}
function removeformatMoney(i) {
	var v = i.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	//v = v.replace(".", ",");
	//v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	//v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	return v;
}


function calcula_total(qtde,valor,id){
    if(qtde <=0){
        alert("Quantidade deve ser maior que 0");
        qtde =1;
    }
    if(qtde.length>=2){
        qtde = qtde.slice(0,2);
    }
	valor_item = qtde * valor;
    valor_item = formatMoneyJavascript(String(valor_item.toFixed(2)));
    $("#total"+id).html(valor_item);
    quantidade_total=0;
    valor_retornado=0;
    $("input[name='qtde']").each(function( index ) {
        quantidade_total += parseInt($(this).val());
    });
	$("td[id^='total']").each(function( index ) {
	  valor_retornado += parseFloat(removeformatMoney($(this).html()));
	});
	valor_retornado = formatMoneyJavascript(String(valor_retornado.toFixed(2)));
	$("#qt_total").html(quantidade_total);
    $("#vl_total").html(valor_retornado);
    adicionar_carrinho(id,qtde);
}
function calculatotal(){
    quantidade_total=0;
    valor_retornado=0;
    $("input[name='qtde']").each(function( index ) {
        quantidade_total += parseInt($(this).val());
    });
	$("td[id^='total']").each(function( index ) {
	  valor_retornado += parseFloat(removeformatMoney($(this).html()));
	});
	valor_retornado = formatMoneyJavascript(String(valor_retornado.toFixed(2)));
	$("#qt_total").html(quantidade_total);
    $("#vl_total").html(valor_retornado);
}
function adicionar_carrinho(id,quantidade) {
    jQuery.ajax({
        url: "ajax/pedido/adiciona_carrinho.php",
        data: {id:id,quantidade:quantidade},
        type: "post",
        success: function (data) {
            jQuery("#div_retorno").html(data);
            calculatotal();
        }
    });  
}
function remove_carrinho(id) {
    jQuery.ajax({
        url: "ajax/pedido/remove_carrinho.php",
        data: {id:id},
        type: "post",
        success: function (data) {
            jQuery("#div_retorno").html(data);
            calculatotal();
        }
    });  
}
function insere_pedido() {
    vl_total = $('#vl_total').html();
    if(parseFloat(vl_total) <=0.00){
        alert("Selecione pelo menos um item");
    }
    else {
        jQuery.ajax({
            url: "ajax/pedido/insere_pedido.php",
            data: {vl_total:vl_total},
            type: "post",
            success: function (data) {
                jQuery("#list_pedido").html(data);
                remove_carrinho(1);
            }
        });  
    }
}
