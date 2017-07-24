<?php

	include_once ("class/classe_mensagem.php");

	if ( isset ($_GET['opt']) ) { $opt = limpaDados($_GET['opt']); } else { $opt = "Lista-Mensagem"; }

	//echo "$opt";
	
	switch ( $opt )
	{
		case "Nova-Mensagem":			include_once ("model/mo_form_mensagem.php"); break;
		
		case "Adiciona-Mensagem":		include_once ("catalog/cat_mensagem.php"); break;
		
		case "Lista-Mensagem":			include_once ("view/vi_lista_mensagem.php"); break;
		
		case "Visualiza-Mensagem":		include_once ("view/vi_mensagem.php"); break;
		
		default: echo "<p> Não foi possível entender sua requisição </p>";
	}
?>