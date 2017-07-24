<?php

	/*
		model/mo_form_cadastro.php
	*/
	
	$readonly = "";
	
	if ( isset ($_GET['id_cadastro']) )
	{
		$id_cadastro = removeLetra($_GET['id_cadastro']);
		$dados_cadastro = $classe_cadastro -> retornaCadastro ( $pdo, $id_cadastro );
		
		if ( $opt == "Visualizar-Cadastro" ) { $readonly = "readonly"; }
	}
	
?>
	<form action='?mod=Cadastro&opt=Adiciona-Cadastro<?php if ( isset($dados_cadastro) ) { echo "&id_cadastro=$id_cadastro"; } ?>' method='POST' <?php echo $readonly; ?>>
		<div class='div-form'>
			<h3> Nome Completo </h3>
			<input type='text' name='cad_nome' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_nome']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
			
		<div class='div-form'>
			<h3> Data de Nacimento </h3>
			<input type='text' id='datepicker' name='cad_nasc' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_nascimento_br']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>
			<h3> CEP </h3>
			<input type='text' id='cep' name='cad_cep' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_cep']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>	
			<h3> Endereço </h3>
			<input type='text' id='rua' name='cad_rua' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_rua']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>	
			<h3> Bairro </h3>
			<input type='text' id='bairro' name='cad_bairro' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_bairro']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>	
			<h3> Cidade </h3>
			<input type='text' id='cidade' name='cad_cidade' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_cidade']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>	
			<h3> Estado </h3>
			<input type='text' id='uf' name='cad_uf' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_uf']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>	
			<h3> Telefone </h3>
			<input type='text' name='cad_telefone' value='<?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_telefone']; } ?>' required <?php echo $readonly; ?>> </input>
		</div>
		
		<div class='div-form'>	
			<h3> Biografia </h3>
			<textarea id='cad_biografia' name='cad_biografia' required <?php echo $readonly; ?>><?php if ( isset($dados_cadastro) ) { echo $dados_cadastro[1]['cadastro_biografia']; } ?></textarea>
		</div>
		
		<div class='div-form'>	
			<input type='submit' value='Cadastrar'> </input>
		</div>
		
	</form>
	
	<script>
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace( 'cad_biografia' );
		
		$( function() {
			$( "#datepicker" ).datepicker();
		} );
	</script>