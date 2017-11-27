<?php
require_once 'Conexao.php';
require_once 'Funcoes.php';
class Despesa {
    private $con, $obgf, $id, $idF, $tit, $desc, $valor, $data;
    
    public function __construct($con, $obgf, $id,$idF, $tit, $desc, $valor, $data){
        $this->con = new Conexao("root", "toor", "matt", "localhost");
        $this->obgf = new Funcoes();
        $this->id = $id;
        $this->idF = $idF;
        $this->tit = $tit;
        $this->desc = $desc;
        $this->valor = $valor;
        $this->data = $data;
    }
    public function __set($name, $value){
        $this->$name = $value;
    }
    public function __get($name){
        return $this->$name;
    }
    public function querySelection($dado){
        try{
            $this->id = $this->obgf->b64($dado,2);
            $cst = $this->con->conectar()->prepare("SELECT `id`,`idFrete`, `titulo`, `descricao`, `valor`, `data` FROM `despesa` WHERE `id` = ':id'");
            $cst->bindParam(":id", $this->id, PDO::PARAM_INT);
            $cst->execute();
        }catch (PDOException $e){
            echo '<p>ERROR:</p>'. $e->getMessage();
        }
        return $cst;
    }
    public function querySelect(){
        try{
             $cst = $this->con->conectar()->prepare("SELECT `titulo`, `descricao`, `valor` FROM `despesa`");
             $cst->execute();
             return $cst->fetchAll();
        }catch (PDOException $e){
            echo '<p>ERROR:</p>' .$e->getMessage();
        }
        return $cst;
    }

    public function queryInsert($dados){
        try{
            $this->idF = $this->obgf->b64($dados['idF'],1);
            $this->tit = $this->obgf->caractereTrat($dados['tit'],1);
            $this->desc = $this->obgf->caractereTrat($dados['desc'],1);
            $this->valor = $dados['valor'];
            $this->data = $this->obgf->datas(2);
            $cst = $this->con->conectar()->prepare("INSERT INTO `despesa`(`idFrete`, `titulo`, `descricao`, `valor`, `data`) VALUES (':idF',':tit',':desc',':valor',':data')");
            $cst->bindParam(':idF', $this->idF, PDO::PARAM_INT);
            $cst->bindParam(':tit', $this->tit, PDO::PARAM_STR);
            $cst->bindParam(':desc', $this->desc, PDO::PARAM_STR);
            $cst->bindParam(':valor', $this->valor, PDO::PARAM_STR);
            $cst->bindParam(':data', $this->data, PDO::PARAM_STR);
            if ($cst->execute()){
                return'Ok';
            }else{
                return'<p>IHH RAPAZ, DEU NÃO Hein...</p>';
            }
        }catch (PDOException $e){
            echo '<p>ERROR:</p>'. $e->getMessage();
        }
        return $cst;
    }
    public function queryUpdate($dados){
        try{
            //$this->id = $this->obgf->openSsl($dados['id'],2);//
            $this->idF = $this->obgf->b64($dados['idF'],2);
            $this->tit = $this->obgf->caractereTrat($dados['tit'],1);
            $this->desc = $this->obgf->caractereTrat($dados['desc'],1);
            $this->valor = $dados['valor'];
            $cst = $this->con->conectar()->prepare("UPDATE `despesa` SET `idFrete`=':idF',`titulo`=':tit',`descricao`=':desc',`valor`=':valor' WHERE `id`=':id'");
            $cst->bindParam(':id', $this->id, PDO::PARAM_INT);
            $cst->bindParam(':idF', $this->idF, PDO::PARAM_INT);
            $cst->bindParam(':tit', $this->tit, PDO::PARAM_STR);
            $cst->bindParam(':desc', $this->desc, PDO::PARAM_STR);
            $cst->bindParam(':valor', $this->valor, PDO::PARAM_STR);
            if ($cst->execute()){
                echo '<p>ATUALIZADO COM SUCESSO !</p>';
            }else {
                echo '<p>IHH RAPAZ, DEU NÃO Hein...</p>';
            }
        }catch (PDOException $e){
            return $e->getMessage();
        }
        return $cst;
    }
    public function queryDelete($dados){
        try{
            $this->id = $this->obgf->b64($dados['id'],2);
            $this->idF = $this->obgf->b64($dados['idF'],2);
            $this->tit = $this->obgf->caractereTrat($dados['tit'],1);
            $this->desc = $this->obgf->caractereTrat($dados['desc'],1);
            $this->valor = $dados['valor'];
            $this->data = $this->obgf->datas(2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `despesa` WHERE `id`=':id'");
            $cst->bindParam(':id', $this->id, PDO::PARAM_INT);
            if ($cst->execute()){
                echo '<p>DELETADO COM SUCESSO</p>';
            }else{
                return '<p>IHH RAPAZ, DEU NÃO Hein...</p>';
            }

        }catch (PDOException $e){
            return '<p>ERROR:</p>'. $e->getMessage();
        }
        return $cst;
    }

}
//sha1() criptografa senhas//