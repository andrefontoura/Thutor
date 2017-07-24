<?php

	/* 
		Func.php 
		
		Funções simples para facilitar a vida nos demais arquivos.

		https://www.iconfinder.com/iconsets/flat-circle-content
		
		-> CKEDITOR
		- Adicionar a linha a seguir no final do arquivo onde for necessário uma
		campo ckeditor, lembrando que o id do textarea deve estar na formula
		
		<script>
			// Replace the <textarea id="editor1"> with a CKEditor
			// instance, using default configuration.
			CKEDITOR.replace( 'id_do_textarea' );
		</script>
		
		- Colocar a validação a seguir no form de todo lugar que houver ckeditor
		lembrando que o parametro é um array, assim você pode passar mais do que
		um ID de campo para validação
		
		onSubmit="return contaCaracteresCKEDITOR(['id1','id2','id3'.....]);"
		
		-- Pagina do artigo sem resumo e abstract, só titulo e autor, com opção de autor
		e um 4º nivel

		-- Keyword 
		-- Titulo com tamanho maior, autor com tamanho menor
		-- Capa na Sub categoria
		-- Editorial na sub categoria

	*/
	
	define("LOGIN","e5fe05e808fcfc2fca79d09cf5907537");
	define("SENHA","1e8e0e1e9d1dc4e90927c20e010c76b7");
	define("VALIDO","53aa57bebf663039d26cdbf41957bb83");
		
	function removeLetra ( $var )
	{
		/*
			Remove todas as letras do conjunto
			para evitar bobagens nos dados. Como
			delete e inserts indevidos.
			
			deve ser usado em todos os posts e gets onde o 
			objetivo é ficar apenas com os numeros
			
			Foi adicionado o underline pois por alguma razão
			alguns ids nas tabelas do portal tem _ e outro número
			como ele não afeta nada foi adicionado. (27/04/2017 - André)
		*/
		$var = preg_replace('/[^0-9_]/','', $var);
		//echo $var;
		
		return $var;
	}
	
	
	function limpaDados ($dado)
	{
		/*
			Remove todos os caracteres suspeitos, códigos javascript
			códigos html, espaços e perigos de uma variável. Muito bom
			para por em campos textos simples, onde não há presença de 
			chkeditor.
		*/
		$dado = str_replace ("'"," ",$dado);
		$dado = str_replace ("*"," ",$dado);
		$dado = str_replace (";"," ",$dado);
		$dado = str_replace ("%"," ",$dado);
		$dado = str_replace ("\""," ",$dado);
		$dado = str_replace (")"," ",$dado);
		$dado = str_replace ("("," ",$dado);
		$dado = htmlentities($dado);
		$dado = trim($dado);
		$dado = strip_tags($dado);
		
		return $dado;
	}
	
	function paginasArquivo ($f)
	{
		//$f = "test1.pdf";
		$stream = fopen($f, "r");
		$content = fread ($stream, filesize($f));

		if(!$stream || !$content)
			return 0;

		$count = 0;
		// Regular Expressions found by Googling (all linked to SO answers):
		$regex  = "/\/Count\s+(\d+)/";
		$regex2 = "/\/Page\W*(\d+)/";
		$regex3 = "/\/N\s+(\d+)/";

		if(preg_match_all($regex, $content, $matches))
			$count = max($matches);

		return $count[0];
	}
	
	 function calculaLimit ($limit)
	{
		$limit_2 = $limit * 10; /* (10, 20, 30...) */
		$limit_1 = ($limit - 1) * 10; /* ( 0, 11, 21.. ) */
		
		return " LIMIT 10 OFFSET $limit_1 ";
	}
	
	function criaPaginacao ($pdo, $limit, $sql, $link)
	{
		/*
			Função para criar a paginação.
			
			Primeiro encontra quantos resultados ao total tem.
		*/
		$res = $pdo -> query ($sql);
		
		$qtde_paginas = ceil($res -> rowCount()/ 10);
		
		//echo $qtde_paginas;
		
		echo "<div class='div-form width-100 div-paginacao'> <a href='".$link."1'> <div class='div-paginacao-numero' alt='Voltar a Primeira Página' title='Voltar a Primeira Página'> <p> << </p> </div> </a> ";
		
		/* Cria as paginações pra trás da página atual, como um voltar. */
		for ($z = ($limit-4); $z < $limit; $z++)
		{
			if ( $z > 0 )
				echo "<a href='$link$z'> <div class='div-paginacao-numero'> <p> $z </p> </div> </a>";
		}
		
		/* Cria as paginações da página atual + as próximas, como um avançar.*/
		for ($i = $limit; $i < ($limit+4); $i++)
		{
			if ( $i == $limit ) // Atribui uma colorização diferenciada para indicar qual página estamos vendo
				$class = 'td_1';
			else 
				$class = '';
			
			/* Evita que sejam criadas mais páginas do que existe de resultado */
			if ( $i <= $qtde_paginas )
				echo "<a href='$link$i'> <div class='div-paginacao-numero $class'> <p> $i </p> </div> </a>";
		}
		echo "<a href='".$link.$qtde_paginas."'> <div class='div-paginacao-numero' alt='Avançar a Última Página' title='Avançar a Última Página'> <p> >> </p> </div> </a> </div>";
	}



	