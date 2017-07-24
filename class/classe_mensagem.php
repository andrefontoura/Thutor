<?php
	
	class Mensagem
	{
		
		public function sqlListaMensagem ( $id_mensagem )
		{
			$sql = 
			"
				SELECT
					c.*,
					m.*,
					DATE_FORMAT ( m.mensagem_data, '%d/%m/%Y') as mensagem_data_br
				FROM
					mensagem m
				INNER JOIN
					cadastro c on m.cadastro_id = c.id_cadastro
				WHERE
					1 = 1
			";
			
			if ( $id_mensagem !== false )
				$sql .= " AND m.id_mensagem = '$id_mensagem' ";
			
			return $sql;
		}
	
		public function retornaMesagem ( $pdo, $id_mensagem )
		{
			$sql = $this -> sqlListaMensagem ( $id_mensagem );
			$sql_s_l = $sql;
			//$sql .= calculaLimit($limit);
			$res = $pdo -> query ($sql);
			
			//echo $sql;
			
			$return = array();
			
			if ( $res -> rowCount() > 0 )
			{
				array_push ($return, $sql_s_l );
				while ( $row = $res -> fetch (PDO::FETCH_ASSOC) )
				{
					array_push($return, $row);
				}
			}
			
			return $return;
		}
		
		public function insertMensagem ( $pdo, $mensagem_conteudo, $cadastro_id )
		{
			$sql =
			"
				INSERT INTO
					mensagem
					(`mensagem_conteudo`,`cadastro_id`,`mensagem_data` )
					VALUES
					('$mensagem_conteudo','$cadastro_id',NOW())
			";
			
			$res = $pdo -> query ($sql);
			
			if ( $res !== false )
				echo "<div class='div-sucess' > <p> A mensagem foi enviada </div>";
			else
				echo "<div class='div-fail'> <p> Algo deu errado <hr> $sql </p> </div>";
		}
	}
	
	$classe_mensagem = new Mensagem();

?>