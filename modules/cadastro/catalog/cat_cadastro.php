<?php
	
	/*
		catalog/cat_cadastro.php
	*/
	
	if ( isset($_POST) && !empty ($_POST) )
	{
		if ( isset ($_POST['cad_nome']) ) { $cad_nome = limpaDados($_POST['cad_nome']); } else { $cad_nome = FALSE; }
		if ( isset ($_POST['cad_nasc']) ) { $cad_nasc = limpaDados($_POST['cad_nasc']); } else { $cad_nasc = FALSE; }
		if ( isset ($_POST['cad_cep']) ) { $cad_cep = limpaDados($_POST['cad_cep']); } else { $cad_cep = FALSE; }
		if ( isset ($_POST['cad_rua']) ) { $cad_rua = limpaDados($_POST['cad_rua']); } else { $cad_rua = FALSE; }
		if ( isset ($_POST['cad_bairro']) ) { $cad_bairro = limpaDados($_POST['cad_bairro']); } else { $cad_bairro = FALSE; }
		if ( isset ($_POST['cad_cidade']) ) { $cad_cidade = limpaDados($_POST['cad_cidade']); } else { $cad_cidade = FALSE; }
		if ( isset ($_POST['cad_uf']) ) { $cad_uf = limpaDados($_POST['cad_uf']); } else { $cad_uf = FALSE; }
		if ( isset ($_POST['cad_telefone']) ) { $cad_telefone = limpaDados($_POST['cad_telefone']); } else { $cad_telefone = FALSE; }
		if ( isset ($_POST['cad_biografia']) ) { $cad_biografia = $_POST['cad_biografia']; } else { $cad_biografia = ""; }
		if ( isset ($_GET['id_cadastro']) ) { $id_cadastro = removeLetra($_GET['id_cadastro']); } else { $id_cadastro = 0; }
		
		if ( $id_cadastro > 0 )
		{
			/* É um update */
			$classe_cadastro -> updateCadastro ( $pdo, $id_cadastro, $cad_nome, $cad_nasc, $cad_cep, $cad_rua, $cad_bairro, $cad_cidade, $cad_uf, $cad_telefone, $cad_biografia );
		} else {
			/* É um insert */
			$classe_cadastro -> insertCadastro ( $pdo, $cad_nome, $cad_nasc, $cad_cep, $cad_rua, $cad_bairro, $cad_cidade, $cad_uf, $cad_telefone, $cad_biografia );
		}
		
	} else {
	
	}
?>