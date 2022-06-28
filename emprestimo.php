<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/css-layout/1.1.1/css-layout.min.js" rel="stylesheet">
    <link href="estilo_add.css" rel="stylesheet">
    <title>Empréstimo</title>
</head>
<body>
    <button onclick= "window.location.href ='index.php'" align= "left" type = "submit" class = "btn btn-primary" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</i></button>    

<div class= 'container'>
<div class= 'card'>
    <form name="formEmprestimo" method="POST" action="emprestimo.php">
        <label for="curso">Curso</label>
        <select class="form-select" aria-label="Default select example" name="curso" value="<?=$curso?>"required>
            <option name="Enfermagem" value="Enfermagem">Enfermagem</option>
            
            <option name="Hospedagem" value="Hospedagem">Hospedagem</option>
            
            <option name="Informática" value="Informática">Informática</option>
            
            <option name="Modelagem" value="Modelagem">Modelagem</option>
        </select>
        <br>
        Nome: <input type="text" name="nomeAluno" required>
        <br> <br>
        Empréstimo: <input type="date" name="dataEmprestimo" required>
        <br> <br>
        Título: <input type="text" name="tituloLivro" required>
        <br> <br>
        Devolução: <input type="date" name="dataDevolucao" required>
        <br> <br>
        
        

        <button name= "Enviar" class= "submit, btn btn-outline-success">
      Enviar
</button>
        
    </form>
</div>
</div>
</body>
</html>


<?php 
    require_once('config.php');
        if(isset($_POST['Enviar'])){
            $curso=$_POST['curso'];
            $nomeAluno=$_POST['nomeAluno'];
            $dataEmprestimo=$_POST['dataEmprestimo'];
            $tituloLivro=$_POST['tituloLivro'];
            $dataDevolucao=$_POST['dataDevolucao'];

        try{
            $stmte = $pdo->prepare("INSERT INTO emprestimo(curso, nomeAluno, dataEmprestimo, tituloLivro, dataDevolucao) VALUES(?, ?, ?, ?, ?)");
            $stmte -> bindParam(1, $curso, PDO::PARAM_STR);
            $stmte -> bindParam(2, $nomeAluno, PDO::PARAM_STR);
            $stmte -> bindParam(3, $dataEmprestimo, PDO::PARAM_STR);
            $stmte -> bindParam(4, $tituloLivro, PDO::PARAM_STR);
            $stmte -> bindParam(5, $dataDevolucao, PDO::PARAM_STR);
            $executa = $stmte->execute();

            if($executa){
                echo 'Dados inseridos com sucesso';
                header('location: relatorio.php');
            }else{
                echo "erro ao inserir dados";
            }

        
        
        
        }catch(PDOException $e){
            echo $e->GetMessage();
        }
        
        }
    

?>
