<?php
function abrirConexao() {
	
	$con = @mysql_connect("127.0.0.1", "root","");
	
	if (! $con) {
		die ("Erro ao abrir a conexao com o MySQL: " . mysql_error ());
	}
	
	mysql_select_db ("matutos", $con);
	
	return $con;
}
?>