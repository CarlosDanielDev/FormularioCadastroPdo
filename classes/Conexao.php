<?php

class Conexao{
    private $usuario, $senha, $banco, $server;
    private static $pdo;
    public function __construct($usuario, $senha, $banco, $server){
        $this->usuario = "root";
        $this->senha = "toor";
        $this->banco = "matt";
        $this->server = "localhost";
    }

    public function conectar(){
        try {
            if(is_null(self::$pdo)){
                self::$pdo = new PDO("mysql:host".$this->server.";dbname=".$this->banco, $this->usuario, $this->senha );
                echo "CONECTADO!!";
            }else{
            return self::$pdo;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return self::$pdo;
    }

}