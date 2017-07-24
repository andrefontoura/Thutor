<?php

	/*
		view/vi_lista_cadastro.php
	*/

	
	$dados_cadastro = $classe_cadastro -> retornaCadastro ( $pdo, FALSE );
	
	if ( !empty ($dados_cadastro) )
	{
		
		for ($i = 1; $i < sizeof ($dados_cadastro); $i++ )
		{
			//var_dump($dados_cadastro);
			echo
			"
				<div class='width-100'>
					<p> ID: {$dados_cadastro[$i]['id_cadastro']} <br> Nome: {$dados_cadastro[$i]['cadastro_nome']} </p>
				
					<a href='?mod=Cadastro&opt=Visualizar-Cadastro&id_cadastro={$dados_cadastro[$i]['id_cadastro']}'><button type='button' class='btn btn-success'>Visualizar</button></a>
					<a href='?mod=Cadastro&opt=Editar-Cadastro&id_cadastro={$dados_cadastro[$i]['id_cadastro']}'><button type='button' class='btn btn-default'>Editar</button></a>
					<a href='?mod=Cadastro&opt=Excluir-Cadastro&id_cadastro={$dados_cadastro[$i]['id_cadastro']}' onClick='return dialogYesNo(\"Deseja realmente excluir?\")'><button type='button' class='btn btn-danger'>Excluir</button></a>
				
				</div>
				
				<hr>
			";
		}
		
	} else {
		echo "<div class='div-fail'> Não existem cadastros a serem listados. </div>";
	}
?>