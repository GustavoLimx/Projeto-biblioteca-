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

    <title>Relatórios</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script> src = "https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"</script>
        
		<script type="text/javascript" language="javascript">
		$(document).ready(function() {
			$('#listar-usuario').DataTable({
                			
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "proc_pesq_user.php",
					"type": "POST",
                    
                    
				}
			});
		} );
</script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
    editor = new $.fn.dataTable.Editor( {
        ajax: "proc_pesq_user.php",
        table: "#listar_usuario",
        
    } );
    $('#example').DataTable( {
        dom: "Bfrtip",
        ajax: "proc_pesq_user.php",

    select: true,
        buttons: [
            { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }

    ]
    } );
} );
</script>
</head>
    <body>
        <h1> Relatorio</h1>
        <table id="listar-usuario" class="table table-striped table-dark" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Nome do Aluno</th>
                    <th>Data Empréstimo</th>
                    <th>Título</th>
                    <th>Data Devolução</th>
                    <th>Situacao</th>
                    <td colspan="2" align="center">Opções</td>
                </tr>

            </thead>
        </table>
    </body>
<?php
    if($executa){
        while($reg = $stmte->fetch(PDO::FETCH_OBJ)){ 
              
?>


  
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

<a href="index.php"><button>Voltar para o menu</button></a>