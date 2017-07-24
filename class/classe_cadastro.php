<?php
	
	/*
	
	*/

	class Cadastro
	{
	
		private function sqlListaCadastro ( $id_cadastro )
		{
			$sql = 
			"	
				SELECT 
					*,
					DATE_FORMAT ( cadastro_nascimento, '%d/%m/%Y') as cadastro_nascimento_br
				FROM
					cadastro
				WHERE 
					cadastro_ativo = '1'
			";
		
			
			if ( $id_cadastro !== FALSE )
				$sql .= " AND id_cadastro = '$id_cadastro' ";
			
			return $sql;
		}
		
		public function retornaCadastro ( $pdo, $id_cadastro )
		{
			$sql = $this -> sqlListaCadastro ( $id_cadastro );
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
		
		public function updateCadastro ( $pdo, $id_cadastro, $cad_nome, $cad_nasc, $cad_cep, $cad_rua, $cad_bairro, $cad_cidade, $cad_uf, $cad_telefone, $cad_biografia )
		{
			$data_nasc = explode ("/",$cad_nasc);
			$cad_nasc = "{$data_nasc[2]}-{$data_nasc[1]}-{$data_nasc[0]}";
			
			$sql =
			"
				UPDATE
					cadastro
				SET
					`cadastro_nome` = '$cad_nome',
					`cadastro_nascimento` = '$cad_nasc',
					`cadastro_biografia` = '$cad_biografia',
					`cadastro_cep` = '$cad_cep',
					`cadastro_rua` = '$cad_rua',
					`cadastro_bairro` = '$cad_bairro',
					`cadastro_cidade` = '$cad_cidade',
					`cadastro_uf` = '$cad_uf',
					`cadastro_telefone` = '$cad_telefone'
				WHERE
					`id_cadastro` = '$id_cadastro'
			";
			
			$res = $pdo -> query ($sql);
			
			if ( $res !== false )
				echo "<div class='div-sucess' > <p> Seu cadastro foi atualizado e está disponível para ser utilizado </div>";
			else
				echo "<div class='div-fail'> <p> Algo deu errado <hr> $sql </p> </div>";
		}

		
		public function insertCadastro ( $pdo, $cad_nome, $cad_nasc, $cad_cep, $cad_rua, $cad_bairro, $cad_cidade, $cad_uf, $cad_telefone, $cad_biografia )
		{
			$data_nasc = explode ("/",$cad_nasc);
			$cad_nasc = "{$data_nasc[2]}-{$data_nasc[1]}-{$data_nasc[0]}";
			
			$sql =
			"
				INSERT INTO 
					cadastro
					(	
						`cadastro_nome`,
						`cadastro_nascimento`,
						`cadastro_biografia`,
						`cadastro_criacao`,
						`cadastro_cep`,
						`cadastro_rua`,
						`cadastro_bairro`,
						`cadastro_cidade`,
						`cadastro_uf`,
						`cadastro_telefone`,
						`cadastro_ativo`
					)
					VALUES
					(
						'$cad_nome',
						'$cad_nasc',
						'$cad_biografia',
						NOW(),
						'$cad_cep',
						'$cad_rua',
						'$cad_bairro',
						'$cad_cidade',
						'$cad_uf',
						'$cad_telefone',
						1
					)
			";
			
			//echo $sql;
			
			$res = $pdo -> query ($sql);
			
			if ( $res !== false )
				echo "<div class='div-sucess' > <p> Seu cadastro foi inserido e está disponível para ser utilizado </div>";
			else
				echo "<div class='div-fail'> <p> Algo deu errado <hr> $sql </p> </div>";
			
		}
		
		public function inativaCadastro( $pdo, $id_cadastro )
		{
			$sql = 
			"
				UPDATE
					cadastro
				SET
					cadastro_ativo = '0'
				WHERE
					id_cadastro = '$id_cadastro'
			";
			
			$res = $pdo -> query ($sql);
			
			if ( $res !== false )
				echo "<div class='div-sucess' > <p> Seu cadastro foi inativado </div>";
			else
				echo "<div class='div-fail'> <p> Algo deu errado <hr> $sql </p> </div>";
			
		}
	
	}
	
	$classe_cadastro = new Cadastro($pdo);
	
?>