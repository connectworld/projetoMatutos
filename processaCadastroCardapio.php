<?php 
    if (isset($_POST["nome"])) {
		
	include_once 'conectaBanco.php';
	$con = abrirConexao();
	mysql_set_charset('UTF8', $con);
		
	$origens = array('"',"'",'/','*','true','false','=','where','drop','delete','from','WHERE','DELETE','FROM','DROP','SELECT');
	$distino = "";
		
        $dados = array();
		
	$dados[0] = strtoupper( str_replace($origens, $distino, $_POST['nome']));
	$dados[1] = strtoupper( str_replace($origens, $distino, $_POST['descricao']));
	$dados[2] = strtoupper(str_replace($origens, $distino, $_POST['preco']));
                   
		
	//RECEBENDO A IMAGEM
	//RECEBENDO A IMAGEM
	$foto = $_FILES['foto']['tmp_name'];
	$tamanho = $_FILES['foto']['size'];
	$tipo = $_FILES['foto']['type'];
		
		
	if ($foto == "") {
            //$sql = mysql_query("select max(cast(codigo as decimal)) as codigo from esc_cad_aluno_capa");
            //while ($linha = mysql_fetch_array($sql)) {
            //	$codCliente = $linha['codigo'];
            //}
                    
            //$codigoInsert = $codCliente + 1;
            /*$codCliente = $codCliente + 1;
            $insert = mysql_query("insert into esc_cad_aluno_capa ()");*/
                    
            //PEGANDO DATA NO FORMATO DO BANCO
            //$data = date('Y-m-d H:i:s');
                    
            $insert = "insert into cardapio (nome,descricao,preco,exclusao_logica) values ('$dados[0]','$dados[1]','$dados[2]',1)";
			
            $result = mysql_query($insert);
			mysql_close($con);
			
		if ($result) {
                   echo "<script>window.location='cadastros.php';alert('CARDAPIO CADASTRADO COM SUCESSO');</script>";
                    //echo "cadastrou";
		}
		else{
                    echo "<script>window.location='cadastroCardapios.php';alert('ERRO AO CARDAPIO');</script>";
                    //echo "nao cadastrou";
		}
	}
	elseif ($foto != "") {
           $fp = fopen($foto,"rb");
            $conteudo = fread($fp, $tamanho);	
            $conteudo = addslashes($conteudo);
            fclose($fp);
            
            //$sql = mysql_query("select max(cast(codigo as decimal)) as codigo from esc_cad_aluno_capa");
            //while ($linha = mysql_fetch_array($sql)) {
            //		$codCliente = $linha['codigo'];
            //	}
            //	$codigoInsert = $codCliente + 1;
			/*$codCliente = $codCliente + 1;
			$insert = mysql_query("insert into esc_cad_aluno_capa ()");*/
            
            //$data = date('Y-m-d H:i:s');
            
            $insert = "insert into cardapio (nome,descricao,preco,imagem,exclusao_logica) values ('$dados[0]','$dados[1]','$dados[2]','$conteudo',1)";
			
            $result = mysql_query($insert);
            mysql_close($con);
            if ($result) {
                echo "<script>window.location='cadastroAluno.php';alert('CARDAPIO CADSATRADO COM SUCESSO');</script>";
                //echo "1";
            }
            else{
		echo "<script>window.location='cadastro.php';alert('ERRO AO CADASTRAR CARDAPIO');</script>";
                //echo"2";
				//echo "sql errada2";
            }
    }
		
}
else{
    header("Location: cadastros.php");
}
?>