<?php

	class Login 
	{
		
		protected $id_login = null;
		protected $id_cadastro = null;
		protected $nivel_login = null;
		
		function __construct ( $pdo )
		{
			if ( !isset ($_SESSION['__id_login__']) )
			{
				
			} else {
				/* Usuario Logado, atribui o id desse usuario no private id_login */
				$this -> id_login = $_SESSION['__id_login__'];
			}
		}
		
		private function sqlListaLogin ( $login_nome, $login_senha )
		{
			$sql =
			"
				SELECT
					id_login,
					login_nome,
					login_nivel
				FROM
					login 
				WHERE
					1 = 1
			";
			
			if ( $login_nome !== FALSE )
				$sql .= " AND login_nome = '$login_nome' ";
			
			if ( $login_senha !== FALSE )
				$sql .= " AND login_senha = '$login_senha' ";
			
			return $sql;
		}
		
		public function returnLogin ( $pdo, $login_nome, $login_senha ) 
		{
			$sql = $this -> sqlListaLogin ( $login_nome, $login_senha );
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
		
		public function insertLogin ( $pdo, $login_nome, $senha )
		{
			$sql =
			"	
				INSERT INTO LOGIN
					( `login_nome`, `login_senha`, `login_nivel` )
					VALUES
					( '$login_nome', '$senha','1')
			";
			
			$res = $pdo -> query ($sql);
			
			if ( $res != null)
			{
				echo "<div class='div-sucess'> <p> Você foi cadastrado com sucesso. </p> </div>";
				$_SESSION['__id_login__'] = $pdo -> lastInsertId();
			}
			else
			{
				echo "<div class='div-fail'> <p> Houve um erro ao cadastrar. Envie a linha a seguir ao desenvolvedor: <hr> $sql </p> </div>";
			}
			
		}
		
	}

	$classe_login = new Login ($pdo);
?>