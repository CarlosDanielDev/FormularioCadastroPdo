<?php
    require_once 'Funcoes.php';
    require_once  'Despesa.php';

    $des = new Despesa();
    $fun = new Funcoes();
    if (isset($_POST['desp'])){
        if ($des->queryInsert($_POST[]) == true){
            echo'Ok ok  ok';
        }else{
            echo '<script type="text/javascript">alert("ERROR- Impossível cadastrar")</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf8">
    <title>DESPESA</title>
</head>
<body>
    <div>
        <pre>
            <form method="post" name="formDes">
                <fieldset>
                    <legend>Despesa</legend>
                    <label>Id-Frete:<input type="number" name="idF" required></label>
                    <label>Titulo:<input placeholder="Titulo" type="text" name="tit" required></label>
                    <label>Descrição:<input placeholder="Descreva A Despesa" type="text" name="desc" required></label>
                    <label>Valor:<input placeholder="R$" type="text" name="valor" required></label>
                    <label>Data:<input type="date" name="data" required></label>
                    <input type="submit" name="desp" value="Inserir Dados">
                    <input type="hidden" name="desp">
                </fieldset>
            </form>
        </pre>
    </div>
</body>
</html>