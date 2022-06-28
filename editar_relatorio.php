<?php 
    require_once('config.php');

    $id=$_GET['id'];

    $sth = $pdo->prepare("SELECT id, curso, nomeAluno, dataEmprestimo, tituloLivro, dataDevolucao from emprestimo WHERE id = :id");
    $sth->bindValue(':id', $id, PDO::PARAM_STR);
    $sth->execute();

    $reg = $sth->fetch(PDO::FETCH_OBJ);
    $curso = $reg->curso;
    $nomeAluno = $reg->nomeAluno;
    $dataEmprestimo = $reg->dataEmprestimo;
    $tituloLivro = $reg->tituloLivro;
    $dataDevolucao = $reg->dataDevolucao;
    

?>
<link href="" rel="stylesheet" media="screen">
<div align="center">
    <form method="post" action="">
       

    <label for="curso">Curso</label>
        <select name="curso" value="<?=$curso?>">
            <option name="Enfermagem" value="Enfermagem">Enfermagem</option>
            <option name="Hospedagem" value="Hospedagem">Hospedagem</option>
            <option name="Informática" value="Informática">Informática</option>
            <option name="Modelagem" value="Modelagem">Modelagem</option>
        </select>

        <input name="id" type="hidden" value="<?=$id?> required"> <br>

        Nome<input type="text" name="nomeAluno" value="<?=$nomeAluno?>"><br>
        <input name="id" type="hidden" value="<?=$id?>"> <br>

        Empréstimo<input type="date" name="dataEmprestimo" value="<?=$dataEmprestimo?>"><br>
        <input name="id" type="hidden" value="<?=$id?>"> <br>

        Título<input type="text" name="tituloLivro" value="<?=$tituloLivro?>"><br>
        <input name="id" type="hidden" value="<?=$id?>"> <br>

        Devolução<input type="date" name="dataDevolucao" value="<?=$dataDevolucao?>"><br>
        <input name="id" type="hidden" value="<?=$id?>"> <br>

     
          
       
        <button>
        <a href="relatorio.php">Voltar</a>
  </button>

  <button name= "enviar" class= "submit">
      Enviar
</button>
    </form>
</div>

<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $curso = $_POST['curso'];
    $nomeAluno = $_POST['nomeAluno'];
    $dataEmprestimo = $_POST['dataEmprestimo'];
    $tituloLivro = $_POST['tituloLivro'];
    $dataDevolucao = $_POST['dataDevolucao'];

    $sql = "UPDATE emprestimo SET curso = :curso, nomeAluno = :nomeAluno, dataEmprestimo = :dataEmprestimo, tituloLivro = :tituloLivro, dataDevolucao = :dataDevolucao WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
    $sth->bindParam(':curso', $_POST['curso'], PDO::PARAM_INT);
    $sth->bindParam(':nomeAluno', $_POST['nomeAluno'], PDO::PARAM_INT);
    $sth->bindParam(':dataEmprestimo', $_POST['dataEmprestimo'], PDO::PARAM_INT);
    $sth->bindParam(':tituloLivro', $_POST['tituloLivro'], PDO::PARAM_INT);
    $sth->bindParam(':dataDevolucao', $_POST['dataDevolucao'], PDO::PARAM_INT);   
   if($sth->execute()){
        print "<script>alert('Registro alterado com sucesso!');location='relatorio.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}
?>