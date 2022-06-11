<?php


define('DB_HOSTNAME', 'localhost');
define('DB_DATABASE', 'gate');
define('DB_USERNAME', 'gate');
define('DB_PASSWORD', 'SUA_SENHA');
define('DB_PREFIX', '');
define('DB_CHARSET', 'LATIN1');

function DBConnect(){ # Abre Conexão com Database
	$link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
	mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
	return $link;
}

function DBClose($link){ # Fecha Conexão com Database
	@mysqli_close($link) or die(mysqli_error($link));
}

function DBEscape($dados){ # Proteje contra SQL Injection
	$link = DBConnect();
	
	if(!is_array($dados)){
		$dados = mysqli_real_escape_string($link,$dados);
	}else{
		$arr = $dados;
		foreach($arr as $key => $value){
			$key	= mysqli_real_escape_string($link, $key);
			$value	= mysqli_real_escape_string($link, $value);
			
			$dados[$key] = $value;
		}
	}
	DBClose($link);
	return $dados;
}

function DBExecute($query){ # Executa um Comando na Conexão
	$link = DBConnect();
	$result = mysqli_query($link,$query) or die(mysqli_error($link));
	
	DBClose($link);
	return $result;
}

function lista($linhas = 0, $key = ''){
		$sql  ="select * from visitantes ";
		if($key != ''){
			$sql .="WHERE  ";
			$sql .="nome like '%$key%'  or ";
			$sql .="cpf like '%$key%'  or ";
			$sql .="data like '%$key%'  or ";
			$sql .="placa like '%$key%' ";
		}
		$sql .="order by data desc ";
		$linhas > 0 ? $sql  .= "limit $linhas " : "";
		$result	= DBExecute($sql);

		if(!mysqli_num_rows($result)){

		}else{
			while($retorno = mysqli_fetch_assoc($result)){
				$dados[] = $retorno;
			}
		}
		
		echo "<table>";
		echo "<thead>
				<tr>
					<th>NOME</th>
					<th>CPF</th>
					<th>DESTINO</th>
					<th>OM</th>
					<th>VEICULO</th>
					<th>DATA</th>
					<th>OBS</th>
					<th>FOTO</th>
					</th>
				</tr>
			</thead>";
		foreach($dados as $a){
			echo "<tr>
					<td>$a[nome]</td>
					<td>$a[cpf]</td>
					<td>$a[destino]</td>
					<td>$a[om]</td>
					<td>$a[placa]</td>
					<td>$a[data]</td>
					<td>$a[obs]</td>
					<td><img width='150' src='$a[imagem]'></td>
				</tr>";
		}
		echo "</table>";
	}


if($_POST['metodo'] == "foto"){
	$cpf = $_POST['cpf'];
	$obs = $_POST['obs'];
	$nome = $_POST['nome'];
	$destino = $_POST['destino'];
	$om = $_POST['om'];
	$placa = $_POST['placa'];
	$imagem = $_POST['imagem'];
	
	$sql  ="insert into visitantes ";
	$sql .=" (cpf, nome, destino, om, placa, obs, imagem  ) ";
	$sql .=" values ";
	$sql .=" ('$cpf', '$nome', '$destino', '$om', '$placa', '$obs', '$imagem' ) ";
	
	if(DBExecute($sql)){
		echo "ok";
	}else{
		echo "erro";
	}
	
}

if($_POST['metodo'] == "lista"){
	$termo = $_POST['termo'];
	lista("0", $termo);
	
}


?>