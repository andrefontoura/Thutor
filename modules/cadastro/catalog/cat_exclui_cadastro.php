<?php

	/*
		catalog/cat_exclui_cadastro.php
	*/

	if ( isset ($_GET['id_cadastro']) )
	{
		$id_cadastro = removeLetra($_GET['id_cadastro']);
		$classe_cadastro -> inativaCadastro($pdo, $id_cadastro);
		
	} else {
		
	}
	
?>