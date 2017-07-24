<?php


	session_start();
	
	include_once ("func.php");
	include_once ("class/classe_pdo.php");
	include_once ("class/classe_login.php");

		
	if ( isset ($_GET['mod']) ) { $mod = limpaDados($_GET['mod']); } else { $mod = "Home"; } 
	
	if ( isset($_SESSION['__id_login__']) && $mod === "Login" ) { $mod = "Cadastro"; } 
	if ( !isset($_SESSION['__id_login__']) && $mod !== "Login" && $mod !== "Home" ) { $mod = "Home"; }
	
	if ( $mod == "Sair" ) { unset ($_SESSION['__id_login__']); } 
?>


<!DOCTYPE html>
	<html lang='pt-br'>
	<head>
		<meta charset='UTF8'></meta>
		<title>Biblioteca de Artigos - Fontoura Editora</title>
			<link rel="stylesheet" href="css/estilo.css">
			<link rel="stylesheet" href="css/estilo_submenu.css">
			
			<script src="js/jquery.js" type="text/javascript"></script>
			<script src="js/thutor.js" type="text/javascript"></script>
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
			
				<?php if ( !isset($_SESSION['__id_login__']) ) { /* Exibe apenas se o usuario não estiver logado */ ?>
				<h2> Acesso ao sistema </h2>
				<div class='width-100 login'>
					<form action='?mod=Login&opt=Logar-Sistema' method='POST'>
						<input type='text' name='login_name'> </input>
						<input type='password' name='login_pass1'> </input>
						<input type='submit' value='Logar no sistema'> </input>
					</form>
				</div>
				
				<h3> Nossa marca </h3>
		
				<p> <b> H de Humano: </b> evidenciamos o “h” em nossa marca
				porque acreditamos na importância do fator humano.
				Para nós o potencial e o talento humano são os únicos
				recursos verdadeiramente inesgotáveis e capazes de
				promover mudanças exponenciais na
				sociedade e nos negócios. </p>
				
				<?php } else {  
						
						echo 
						"
							<a href='?mod=Cadastro&opt=Meu-Cadastro'> <div class='div-button'> <p> Cadastro </p> </div> </a>
							<a href='?mod=Usuarios'> <div class='div-button'> <p> Usuarios </p> </div> </a>
							<a href='?mod=Mensagens'> <div class='div-button'> <p> Mensagens </p> </div> </a>
							<a href='?mod=Sair'> <div class='div-button'> <p> Sair </p> </div> </a>
						";
						
					}
				?>
				
			</section>
			
				
			<section id='middle'>
				
				<?php
					
					/*
						Switch para determinar pelo link, qual módulo acessar, uma variante do 
						processo de MVC pelo link amigável
					*/
					
					switch ( $mod ) 
					{
						
						case "Login":					include_once("modules/login/index.php"); break;
						case "Cadastro":
						case "Usuarios":				include_once("modules/cadastro/index.php"); break;
						case "Mensagem":				include_once("modules/mensagem/index.php"); break;
			
						default:	
							echo 
							"
								<h2>Sobre Nós</h2>
								<p>Somos uma organização com interesse genuíno em pessoas. Queremos transformar o mundo dos negócios e a sociedade por meio de uma nova forma de fazer gestão de pessoas e organizações.</p>

								<p>Acreditamos e compartilhamos a Filosofia de Gestão, uma proposta inovadora de gestão que potencializa os resultados de sua organização, carreira e/ou vida pessoal. Por meio de conceitos simples como a felicidade, o respeito, a valorização das pessoas, a coerência entre o discurso e a prática, conseguimos promover o equilíbrio entre o bem estar e o lucro.</p>

								<h2>Nossos diferenciais:</h2>
								
								<ul>
									<li>Exclusividade: única empresa detentora de licença para a aplicação da Filosofia de Gestão</li>
									<li>Soluções personalizadas com aplicação de metodologia comprovada</li>
									<li>Profissionais experientes com diferentes vivências focados em Compartilhar e Desenvolver</li>
								</ul>
							";
					}
				
				?>
			</section>

			<aside id="sidebar">
				<?php if ( !isset($_SESSION['__id_login__']) ) { /* Exibe apenas se o usuario não estiver logado */ ?>
				
				<h2> Não é cadastrado? </h2>
				
				<p> Crie seu cadastro agora, é fácil e rápido. </p>
				
				<p> Cadastrado você pode enviar e receber mensagens diretamente de nossos representantes ou até mesmo de outros usuários. </p>
				
				<?php include_once ("modules/login/model/mo_form_login.php"); ?>
				
				<?php } else { ?>
				
				<?php } ?>
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