<!DOCTYPE html>
<html>
    <head>
    	<link href="../css/bootstrap.min.css" rel="stylesheet">
    	<link href="../css/meucss.css" rel="stylesheet">
    </head>
	<body>
		<h3>Pesquisa</h3>
		<form class="formP col-md-12 col-xs-12" method="post" action="consulta.php">
			<div class="col-md-4">
			<label for="lblNome">Primeiro Nome:</label>
            <input type="Nome" class="form-control" id="pesquisa" name="Pnome" placeholder="João">
            </div>
            <div class="col-md-4">
			<label for="lblNome">Ultimo Nome:</label>
            <input type="UNome" class="form-control" id="Unome" name="Unome" placeholder="Silva">
            </div>
            <button type="submit" class="botaoP btn btn-primary" value="pesquisa" name="pesquisa">Buscar</button>
		</form>
		<?php 
        	//Executar a conexão com BD
        	include("conexao.php");
    	?>	
		<?php
			$Pnome=$_POST['Pnome'];
			$Unome=$_POST['Unome'];
			
		if ($Pnome == '' and $Unome == '') {
				$cod=mysql_query("SELECT * FROM orcamento ORDER BY Data DESC");;
		}
		elseif($Pnome != '' and $Unome == ''){
			$Pnome='%'.$Pnome.'%';
			$cod=mysql_query("SELECT * FROM orcamento WHERE PNome like '$Pnome' ORDER BY Data DESC");
		}
		elseif($Pnome != '' and $Unome != ''){
			$Pnome='%'.$Pnome.'%';
			
			$cod=mysql_query("SELECT * FROM orcamento WHERE PNome like '$Pnome' AND UNome like '$Unome' ORDER BY Data DESC");
		}
		elseif($Pnome == '' and $Unome != ''){
			$Unome='%'.$Unome.'%';
			$cod=mysql_query("SELECT * FROM orcamento WHERE UNome like '$Unome' ORDER BY Data DESC");
		}
				echo '<table border="1" class="table table-responsive table-bordered">';
				echo '<thead class="table-hover"><tr>';
				echo '<th>Tipo</th>';
				echo '<th>Data</th>';
				echo '<th>Nome</th>';
				echo '<th>Sobrenome</th>';
				echo '<th>Email</th>';
				echo '<th>Telefone</th>';
				echo '<th>Nome Festa</th>';
				echo '<th>Nº Convidado</th>';
				echo '<th>Nº Mesa</th>';
				echo '<th>Nº Bolo</th>';
				echo '<th>Nome DJ</th>';
				echo '<th>Nº Banda</th>';
				echo '<th>Tema</th>';
				echo '<th>CEP</th>';
				echo '<th>Rua</th>';
				echo '<th>Bairro</th>';
				echo '<th>Cidade</th>';
				echo '<th>UF</th>';
				echo '<th>Numero</th>';
				echo '<th>Mensagem</th>';
				echo '</tr></thead>';
				echo '<tr>';
			$sql=$cod; 
			while ($row = mysql_fetch_assoc($sql)) {
				echo '<td>'.$row['Tipo'].'</td>';
				echo '<td>'.$row['Data'].'</td>';
				echo '<td>'.$row['PNome'].'</td>';
				echo '<td>'.$row['UNome'].'</td>';
				echo '<td>'.$row['Email'].'</td>';
				echo '<td>'.$row['Telefone'].'</td>';
				echo '<td>'.$row['NFesta'].'</td>';
				echo '<td>'.$row['NConvidado'].'</td>';
				echo '<td>'.$row['NMesa'].'</td>';
				echo '<td>'.$row['NBolo'].'</td>';
				echo '<td>'.$row['NDJ'].'</td>';
				echo '<td>'.$row['NBanda'].'</td>';
				echo '<td>'.$row['Tema'].'</td>';
				echo '<td>'.$row['CEP'].'</td>';
				echo '<td>'.$row['Rua'].'</td>';
				echo '<td>'.$row['Bairro'].'</td>';
				echo '<td>'.$row['Cidade'].'</td>';
				echo '<td>'.$row['UF'].'</td>';
				echo '<td>'.$row['Numero'].'</td>';
				echo '<td>'.$row['Mensagem'].'</td>';
				echo '</tr>';
			}
		?>
	</body>
</html>