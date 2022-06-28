<?php

require_once('config.php');
try{
    $stmte = $pdo->query("SELECT * FROM emprestimo");
    $executa = $stmte->execute();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="estilo.css" rel="stylesheet">

    
    <title>Relatórios</title>
</head>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
 
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<body>
    <table class="table table-striped table-dark" border="2" align="center">
        <tr>
            <td>Curso</td>
            <td>Nome do Aluno</td>
            <td>Data Empréstimo</td>
            <td>Título</td>
            <td>Data Devolução</td>
            <td>Status</td>
            <td colspan="2" align="center">Opções</td>
        </tr>
       

</body>
</html>

<?php

    if($executa){
        while($reg = $stmte->fetch(PDO::FETCH_OBJ)){ // Para recuperar um ARRAY utilize PDO::FETCH_ASSOC 
?>
    <tr>
		
		<td><?=$reg->curso?></td>
        <td><?=$reg->nomeAluno?></td>
        <td><?=$reg->dataEmprestimo?></td>
        <td><?=$reg->tituloLivro?></td>
        <td><?=$reg->dataDevolucao?></td>
        <td><?=$reg->situacao?></td>
        <td align="right"><a href="editar_relatorio.php?id=<?=$reg->id?>"><button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">Editar<i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
        <td><a href="dar_baixa.php?id=<?=$reg->id?>"><button type="button" class="btn btn-outline-success" data-toggle="button" aria-pressed="false" autocomplete="off">dar baixa<i class="bi bi-check-square-fill" aria-hidden="true"></i></button></a></td>
  
    </tr>
<?php
       }
       print '</table>';
    }else{
           echo 'Erro ao inserir os dados';
    }
}catch(PDOException $e){
      echo $e->getMessage();
}
?>

<button onclick= "window.location.href ='index.php'" align= "left" type = "submit" class = "btn btn-primary" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</i></button>    
