<?php
session_start();
//conex�o com o servidor
$conect = mysql_connect("localhost", "root", "");

// Caso a conex�o seja reprovada, exibe na tela uma mensagem de erro
if (!$conect) die ("<h1>Falha na conex�o com o Banco de Dados!</h1>");

// Caso a conex�o seja aprovada, ent�o conecta o Banco de Dados.	
$db = mysql_select_db("test");

/*Configurando este arquivo, depois � s� voc� dar um include em suas paginas php, isto facilita muito, pois caso haja necessidade de mudar seu Banco de Dados
voc� altera somente um arquivo*/
?>