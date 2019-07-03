<!DOCTYPE html>
<html>
    <head>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <?php 
        //Executar a conexão com BD
        include("conexao.php");
    ?>
    <?php
        $tipo=$_POST['tipo'];
	$data = date('d-m-Y');
    // Dados pessoais;
        $PNome=$_POST['PNome'];
        $UNome=$_POST['UNome'];
        $Email=$_POST['Email'];
        $Telefone=$_POST['Telefone'];
    // Dados sobre a festa;
        $NFesta=$_POST['NFesta'];
        $NConvidado=$_POST['NConvidado'];
        $NMesa=$_POST['NMesa'];
        $NBolo=$_POST['NBolo'];
        $NDJ=$_POST['NDJ'];
        $NBanda=$_POST['NBanda'];
        $Tema=$_POST['Tema'];
    // Onde será a festa;
        $CEP=$_POST['CepO'];
        $Rua=$_POST['RuaO'];
        $Bairro=$_POST['BairroO'];
        $Cidade=$_POST['CidadeO'];
        $UF=$_POST['UfO'];
        $Numero=$_POST['NumeroO'];
        $Mensagem=$_POST['mensagem'];
        //Linha para inserir para no BD
        $sql = mysql_query("INSERT INTO orcamento(Tipo,Data,PNome, UNome, Email, Telefone,NFesta,NConvidado,NMesa,NBolo,NDJ,NBanda,Tema,CEP,Rua,Bairro,Cidade,UF,Numero,Mensagem) VALUES ('$tipo','$data','$PNome','$UNome','$Email','$Telefone','$NFesta','$NConvidado','$NMesa','$NBolo','$NDJ','$NBanda','$Tema','$CEP','$Rua','$Bairro','$Cidade','$UF','$Numero','$Mensagem')");
    ?>
    </head>
    <body>
	<h1>Seu orçamento foi enviado com sucesso!</h1>
    </body>
</html>
