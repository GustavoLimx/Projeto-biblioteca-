<?php 
    require_once('config.php');

    $id=$_GET['id'];

    $sth = $pdo->prepare("SELECT id, situacao from emprestimo WHERE id = :id");
    $sth->bindValue(':id', $id, PDO::PARAM_STR); 
    $sth->execute();

    $reg = $sth->fetch(PDO::FETCH_OBJ);
    $situacao = $reg->situacao;
    
    
?>
<link href="" rel="stylesheet" media="screen">

<div class= "container">
<div class="card">
    

<div align="center">
    <form method="post" action="dar_baixa.php">
        <h2>

        <select name="situacao" value="<?=$situacao?>" required>
            <option name="D" value="D">Devolvido</option>
            <option name="P" value="P">Pendente</option>
        </select>
       
        <input name="id" type="hidden" value="<?=$id?> required"> <br>

</h2>
<button>
        <a href="relatorio.php">Voltar</a>
  </button>

  <button name= "enviar" class= "submit">
      Enviar
</button>
    </form>
</div>
</div>
</div>

<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $situacao = $_POST['situacao'];
    
    

    $sql = "UPDATE emprestimo SET situacao = :situacao WHERE id = :id";
    $sth = $pdo->prepare($sql);
    $sth->bindParam(':id', $_POST['id'], PDO::PARAM_INT);   
    $sth->bindParam(':situacao', $_POST['situacao'], PDO::PARAM_INT);   
   if($sth->execute()){
        print "<script>alert('Registro alterado com sucesso!');location='relatorio.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}
?>