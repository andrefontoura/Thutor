<?php

	/*
		catalog/cat_mensagem.php
	*/
  
	//echo "<p> Let it go </p>";
  
	if ( isset ($_POST) && !empty ($_POST) )
	{
		$id_cadastro = removeLetra ($_POST['id_cadastro']);
		$mensagem_conteudo = $_POST['mensagem_conteudo'];
		
		$classe_mensagem -> insertMensagem ($pdo, $mensagem_conteudo, $id_cadastro);
	} 
 
?>