<?php	
	
	include_once "config.php";
	
	if(isset($_SESSION["login_utilizador"]) ){
		
		$login_utilizador = $_SESSION["login_utilizador"];
		
		$sql =  mysql_query("SELECT * FROM utilizadores WHERE username = '$login_utilizador'") or die (mysql_error());
		$contar = mysql_num_rows($sql);

		if($contar == 0){
			
			unset($_SESSION["login_utilizador"]);

			
			header('Location: login.php');
		}
		
	}
	
?>