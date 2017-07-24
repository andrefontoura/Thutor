<?php

	include_once ("class/classe_cadastro.php");

	if ( isset ($_GET['opt']) ) { $opt = limpaDados($_GET['opt']); } else { $opt = "Lista-Cadastro"; }

	switch ( $opt )
	{
		case "Visualizar-Cadastro":
		case "Novo-Cadastro":
		case "Editar-Cadastro":		include_once ("model/mo_form_cadastro.php"); break;
		
		case "Adiciona-Cadastro":	include_once ("catalog/cat_cadastro.php"); break;
		
		case "Lista-Cadastro":		include_once ("view/vi_lista_cadastro.php"); break;
		
		case "Excluir-Cadastro":		include_once ("catalog/cat_exclui_cadastro.php"); break;
		
		default: echo "<p> Não foi possível entender sua requisição </p>";
	}
?>