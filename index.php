<?php


	session_start();
	
	include_once ("func.php");
	include_once ("class/classe_pdo.php");
	include_once ("class/classe_login.php");

		
	if ( isset ($_GET['mod']) ) { $mod = limpaDados($_GET['mod']); } else { $mod = "Home"; } 

?>


<!DOCTYPE html>
	<html lang='pt-br'>
	<head>
		<meta charset='UTF8'></meta>
		<title>Biblioteca de Artigos - Fontoura Editora</title>
			<link rel="stylesheet" href="3rd/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" href="css/estilo.css">
			<link rel="stylesheet" href="css/estilo_submenu.css">
			<link rel="stylesheet" href="3rd/jquery-ui/jquery-ui.css">
			
			
			<script src="js/jquery.js" type="text/javascript"></script>
			<script src="js/thutor.js" type="text/javascript"></script>
			<script src="3rd/jquery-ui/jquery-ui.js"></script>
			<script src="3rd/ckeditor/ckeditor.js"></script>
			
			<script>
				 <!-- Adicionando Javascript -->
				$(document).ready(function() {

					function limpa_formulário_cep() {
						// Limpa valores do formulário de cep.
						$("#rua").val("");
						$("#bairro").val("");
						$("#cidade").val("");
						$("#uf").val("");
						//$("#ibge").val("");
					}
					
					//Quando o campo cep perde o foco.
					$("#cep").blur(function() {

						//Nova variável "cep" somente com dígitos.
						var cep = $(this).val().replace(/\D/g, '');

						//Verifica se campo cep possui valor informado.
						if (cep != "") {

							//Expressão regular para validar o CEP.
							var validacep = /^[0-9]{8}$/;

							//Valida o formato do CEP.
							if(validacep.test(cep)) {

								//Preenche os campos com "..." enquanto consulta webservice.
								$("#rua").val("Pesquisando...");
								$("#bairro").val("Pesquisando...");
								$("#cidade").val("Pesquisando...");
								$("#uf").val("Pesquisando...");
								//$("#ibge").val("...");

								//Consulta o webservice viacep.com.br/
								$.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

									if (!("erro" in dados)) {
										//Atualiza os campos com os valores da consulta.
										$("#rua").val(dados.logradouro);
										$("#bairro").val(dados.bairro);
										$("#cidade").val(dados.localidade);
										$("#uf").val(dados.uf);
										//$("#ibge").val(dados.ibge);
									} //end if.
									else {
										//CEP pesquisado não foi encontrado.
										limpa_formulário_cep();
										alert("CEP não encontrado.");
									}
								});
							} //end if.
							else {
								//cep é inválido.
								limpa_formulário_cep();
								alert("Formato de CEP inválido.");
							}
						} //end if.
						else {
							//cep sem valor, limpa formulário.
							limpa_formulário_cep();
						}
					});
				});

			</script>
	</head>
	
	
	<body>
		<div id="pagewrap">

			<header>
				<img src='img/thutor-logo.svg'>
				
			</header>
				
			<section id="content">

				<a href='?mod=Usuarios'> <div class='div-button'> <p> Usuarios </p> </div> </a>
				<a href='?mod=Mensagens'> <div class='div-button'> <p> Mensagens </p> </div> </a>
	
			</section>
			
				
			<section id='middle'>
				
				<?php
					
					/*
						Switch para determinar pelo link, qual módulo acessar, uma variante do 
						processo de MVC pelo link amigável
					*/
					
					switch ( $mod ) 
					{
						case "Cadastro":
						case "Usuarios":				include_once("modules/cadastro/index.php"); break;
						case "Mensagem":
						case "Mensagens":				include_once("modules/mensagem/index.php"); break;
					}
				
				?>
			</section>

			<aside id="sidebar">
				<?php
					
					/*
						Switch para determinar pelo link, qual módulo acessar, uma variante do 
						processo de MVC pelo link amigável
					*/
					
					switch ( $mod ) 
					{
						case "Cadastro":
						case "Usuarios":				
								echo 
								"
									<a href='?mod=Usuarios&opt=Novo-Cadastro'> <div class='div-button'> <p> Novo Cadastro </p> </div> </a>
									<a href='?mod=Usuarios&opt=Lista-Cadastro'> <div class='div-button'> <p> Listar Cadastro </p> </div> </a>
								";
								break;
								
						case "Mensagem":				
						case "Mensagens":				
							echo 
								"
									<a href='?mod=Mensagens&opt=Nova-Mensagem'> <div class='div-button'> <p> Nova Mensagem </p> </div> </a>
									<a href='?mod=Mensagens&opt=Lista-Mensagem'> <div class='div-button'> <p> Listar Mensagem </p> </div> </a>
								";
							break;
					}
				
				?>
			</aside>
			
			
			<footer>
				<a href='http://www.anddfontoura.com.br' target='_BLANK'>
					<h4>AnddFontoura</h4>
					<p>Desenvolvimento WEB</p>
				</a>
			</footer>
	
		</div>

	</body>
	
</html>