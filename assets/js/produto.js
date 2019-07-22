function formatMoney(i) {
	var v = i.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	i.value = v;
}
function cancela() {
    $("#id").val('');
    $("#sku").val('');
    $("#nome").val('');
    $("#descricao").val('');
    $("#preco").val('');
    $("#btn_salva").html("Adicionar");
    $("#btn_cancela").hide();
}

function consulta_produto(sku) {
    var retorno;
    if(sku){
        jQuery.ajax({
            url: "ajax/produto/recupera_produto.php",
            async:false,
            data: {sku: sku},
            type: "post",
            dataType: "json",
            success: function (data) {
                if(data != null && data != "null"){
                    retorno = data.situacao;
                }
            }
        });
    }
return retorno;
}


function salva(id) {
        id = $('#id').val();
        sku = $('#sku').val();
        nome = $('#nome').val();
        descricao = $('#descricao').val();
        preco = $('#preco').val();
		  if(sku == ""){
			  $("#valida_sku").html("Favor preencher um SKU");
			  $("#valida_sku").show();
			  $("#sku").focus();
			  return;
		  }
		  if(id == undefined || id == ''){
			  if(consulta_produto(sku)){
				 $("#valida_sku").html("Produto já existe no sistema com esse SKU");
				 $("#valida_sku").show();
				 $("#sku").focus();
				 return;
			  }
		  }
		  jQuery.ajax({
			  url: "ajax/produto/insere_produto.php",
			  data: {id:id,sku:sku,nome:nome,descricao:descricao,preco:preco},
			  success: function (data) {
				  	jQuery("#div_retorno").html(data);
					cancela();
			  }
		 });
}

function recupera_produto(id) {
    if (id){
        jQuery.ajax({
            url: "ajax/produto/recupera_produto.php",
            data: {id: id},
            type: "post",
            dataType: "json",
            success: function (data) {
              //  var result = $.parseJSON(data);
                $("#id").val(data.id);
                $("#sku").val(data.sku);
                $("#nome").val(data.nome);
                $("#descricao").val(data.descricao);
                $("#preco").val(data.preco);
                $("#btn_salva").html("Salvar");
                $("#btn_cancela").show();
                $("#valida_cpf").hide();
                $("#cpf").focus();
            }
        });
    }
}

function excluir_produto(id) {
	if(confirm('Deseja excluir esse produto?')){
		jQuery.ajax({
			url: "ajax/produto/excluir_produto.php",
			data: {id:id},
			type: "post",
			success: function (data) {
				jQuery("#div_retorno").html(data);
			}
		});   
	}
}

function bloquear_produto(id) {
    jQuery.ajax({
        url: "ajax/produto/bloquear_produto.php",
        data: {id:id},
        success: function (data) {
            jQuery("#div_retorno").html(data);
        }
    });
}
