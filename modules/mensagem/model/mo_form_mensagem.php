<?php
	
	/*
		model/mo_form_mensagem.php
	*/
	
	include_once ("class/classe_cadastro.php");
	
	$dados_cadastro = $classe_cadastro -> retornaCadastro ($pdo, FALSE);
	//var_dump ($dados_cadastro);

?>

	<form action='?mod=Mensagem&opt=Adiciona-Mensagem' method='POST' >
		<div class='div-form'>
			<h3> Enviar para </h3>
			<?php
				
				echo "<select name='id_cadastro'> <option value='0' > Selecione um Cadastro </option>";
				for ( $i = 1; $i < sizeof($dados_cadastro); $i++ )
				{
					echo "<option value='{$dados_cadastro[$i]['id_cadastro']}'> {$dados_cadastro[$i]['cadastro_nome']} </option>";
				}
				
				echo "</select>";
				
			?>
		</div>
	
		<div class='div-form'>	
			<h3> Mensagem Texto </h3>
			<textarea id='mensagem_conteudo' name='mensagem_conteudo' required></textarea>
		</div>
		
		<div class='div-form'>	
			<input type='submit' value='Cadastrar'> </input>
		</div>
		
	</form>
	
	<script>
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace( 'mensagem_conteudo' );
		
	</script>