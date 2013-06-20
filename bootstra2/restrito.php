<?php

// A sess�o precisa ser iniciada em cada p�gina diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario >= 2;

// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
	// Redireciona o visitante de volta pro login
	header("Location: noticias.php"); exit;
    }else{
        header("Location: admin/index.php"); exit;
        
        }

?>


