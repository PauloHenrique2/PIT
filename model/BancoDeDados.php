<?php
DEFINE("SERVIDOR","MYSQL:host=localhost;dbname=teste;charset=utf8");
DEFINE("USUARIO","root");
DEFINE("SENHA","");

class BancoDeDados
{    
public $conn;
    
    public function Conexao()
    { 
        $servidor = "localhost";
        $usuario = "root";
        $senhaBd = "";
        $nomeBd = "leon";
        try{
            $this->conn = new mysqli($servidor, $usuario, $senhaBd, $nomeBd);
        }
        catch(Exception $err){
            echo("Houve um erro:" .$err->getMessage());
        }
    }

}



