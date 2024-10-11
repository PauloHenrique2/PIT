<?php
 include_once ("../model/SalaDeAula.php");
 include_once("../model/BancoDeDados.php");

 class Postagem extends SalaDeAula
 {
    private $conteudo_post;
    private $tipo_post;
    private $dataDeCriacao_post;
    private $anexo_post;

    public function SetConteudo($conteudo){
        $this->conteudo_post = $conteudo;
    }

    public function GetConteudo(){
        return $this->conteudo_post;
    }

    public function GetTipo(){
        return $this->tipo_post;
    }

    public function SetTipo($tipo){
        $this->tipo_post = $tipo;
    }

    public function GetDataCriacao(){
        return $this->dataDeCriacao_post;
    }

    public function SetDataCriacao($data){
        $this->dataDeCriacao_post = $data;
    }
    public function GetAnexo(){
        return $this->anexo_post;
    }

    public function SetAnexo($anexo){
        $this->anexo_post = $anexo;
    }


    public function CriarPostagem($id_sala, $id_usuario)
    {
        if (!empty($this->conteudo_post) && !empty($this->dataDeCriacao_post) && !empty($this->tipo_post))
        {
           $bd = new BancoDeDados();
           $bd->Conexao();

           $dataDeCriacao = new DateTime();
           $dataDeCriacao = date_format($dataDeCriacao, 'Y-m-d H:i:s');
           $this->dataDeCriacao_post = $dataDeCriacao;

           $sql = "INSERT INTO Postagens(conteudo, tipo, data_criacao, anexos, id_sala, id_usuario) VALUES ('$this->conteudo_post', '$this->tipo_post', '$this->dataDeCriacao_post', '$this->anexo_post', $id_sala, $id_usuario)";

           if ($bd->conn->query($sql) === TRUE)
           {
             echo "Postagem criada com sucesso!";
           }

           else
           {
             echo "Erro ao criar postagem: " . $bd->conn->error;
           }

           $bd->conn->close();
        }

        else
        {
            echo ("Preencha todos os campos!");
        }
    }

    public function CarregarPostagens($id_sala)
    {
      $bd = new BancoDeDados();
      $bd->Conexao();

      $sql = "CALL POSTAGENS_DA_SALA($id_sala)";
      $result = $bd->conn->query($sql);

      if ($result === FALSE)
      {
        die ("Erro ao chamar a stored procedure: " . $bd->conn->error);
      }

      $rows = $result->fetch_all(MYSQLI_ASSOC);

      $numRows = count($rows);
      if ($numRows > 0)
      {
        for($i = 0; $i < $numRows; $i++)
        {
            echo $rows[$i]['conteudo'] . "\n";
            echo $rows[$i]['tipo'] . "\n";
            echo $rows[$i]['anexos'] . "\n";
        }
      }
      
      else
      {
        echo "Nenhum resultado encontrado.";
      }

      $bd->conn->close();
    }
 }
?>