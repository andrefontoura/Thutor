<?php
	
	/*
		view/vi_lista_mensagem.php
	*/
	
	if ( isset ($_GET['id_mensagem']) ) { $id_mensagem = removeLetra($_GET['id_mensagem']); } else { $id_mensagem = FALSE; } 
	
	$dados_mensagem = $classe_mensagem -> retornaMesagem ( $pdo, FALSE );
	
	if ( !empty($dados_mensagem) )
	{
		
		for ( $i = 1; $i < sizeof($dados_mensagem); $i++ )
		{
			//var_dump($dados_mensagem);
			for ( $i = 1; $i < sizeof ($dados_mensagem); $i++ )
			{
				echo 
				"
					<table>
						<tr>
							<td>
								<p>{$dados_mensagem[$i]['cadastro_nome']}</p>
							</td>
							
							<td>
								<p>{$dados_mensagem[$i]['mensagem_data_br']}</p>
							</td>
							
							<td>
				";
				
				if ( $id_mensagem <= 0 )
				{
					echo "<a href='?mod=Mensagens&id_mensagem={$dados_mensagem[$i]['id_mensagem']}'><button type='button' class='btn btn-defaul'>Visualizar</button></a>";
				}
				
				echo "		
								
							</td>
						</tr>
						
						<tr>
							<td colspan='3'>
								{$dados_mensagem[$i]['mensagem_conteudo']}
							</td>
						</tr>
					</table>
					
					<hr>
				";
			}
		}	
		
	} else {
		echo "<div class='div-fail'> <p> Não há mensagens a se exibir </p> </div>";
	}

?>