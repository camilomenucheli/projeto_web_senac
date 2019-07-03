<?php
	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
	// Dados para conexão com BD
	$host = "localhost";
	$usuario = "camilo1";
	$senha = "Camilo0902";
	$bd = "lilasf";

	// Linha de conexão com BD
	$conexao = mysql_connect($host,$usuario,$senha) or die(mysql_error());
	mysql_select_db($bd) or die(mysql_error());
?>