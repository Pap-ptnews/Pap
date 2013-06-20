<?php
	include 'config.php';
	error_reporting (255);
	
	
	// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) AND (empty($_POST['username']) OR empty($_POST['password']))) {
	header("Location: noticias.php"); exit;
}

$usuario =$_POST['username'];
$senha = $_POST['password'];

// Validação do usuário/senha digitados
$sql = "SELECT `id_utilizador`, `username`, `nivel` FROM `utilizadores` WHERE (`username` = '". $usuario ."') AND (`password` = '". ($senha) ."') LIMIT 1";
$query = mysql_query($sql) or die(mysql_error());
if (mysql_num_rows($query) != 1) {
	// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
	echo "Login inválido!"; exit;
} else {
	// Salva os dados encontados na variável $resultado
	$resultado = mysql_fetch_assoc($query);

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $resultado['id_utilizador'];
	$_SESSION['UsuarioNome'] = $resultado['username'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];

	// Redireciona o visitante
	header("Location: restrito.php"); exit;
}
?>