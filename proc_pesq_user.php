<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	array(0 =>'curso'), 
	array(1 => 'nomeAluno'),
	array(2 => 'dataEmprestimo'),
	array(3 => 'tituloLivro'),
	array(4 => 'dataDevolucao'),
	array(5 => 'situacao')
);

//Obtendo registros de número total sem qualquer pesquisa
$result_user = "SELECT curso, nomeAluno, dataEmprestimo, tituloLivro, dataDevolucao, situacao FROM emprestimo";
$resultado_user = mysqli_query($conn, $result_user);
$qnt_linhas = mysqli_num_rows($resultado_user);

//Obter os dados a serem apresentados
$result_usuarios = "SELECT curso, nomeAluno, dataEmprestimo, tituloLivro, dataDevolucao, situacao  FROM emprestimo WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_usuarios.=" AND ( nomeAluno LIKE '".$requestData['search']['value']."%' ";    
	$result_usuarios.=" OR curso LIKE '".$requestData['search']['value']."%' ";
	$result_usuarios.=" OR situacao LIKE '".$requestData['search']['value']."%' )";
}

$resultado_usuarios=mysqli_query($conn, $result_usuarios);
$totalFiltered = mysqli_num_rows($resultado_usuarios);
//Ordenar o resultado
//$result_usuarios.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_usuarios=mysqli_query($conn, $result_usuarios);

// Ler e criar o array de dados
$dados = array();
while( $row =mysqli_fetch_array($resultado_usuarios) ) {  
	$dado = array(); 
	$dado[] = $row["curso"];
	$dado[] = $row["nomeAluno"];
	$dado[] = $row["dataEmprestimo"];
	$dado[] = $row["tituloLivro"];
	$dado[] = $row["dataDevolucao"];
	$dado[] = $row["situacao"];



	$dados[] = $dado;
}


//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	//"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json
