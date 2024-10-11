<?php
 include_once ("../../model/Atividade.php");
 include_once("../../model/BancoDeDados.php");

 class Resposta extends Atividade
 {
    private $conteudo_resposta;
    private $anexo_resposta;

    public function SetConteudoResposta($conteudo_resposta){
        $this->conteudo_resposta = $conteudo_resposta;
    }

    public function GetConteudoResposta(){
        return $this->conteudo_resposta;
    }

    public function SetAnexo($anexo){
        $this->anexo_resposta = $anexo;
    }

    public function EnviarResposta($id_atividade)
    {
        if (!empty($this->conteudo_resposta))
        {
            $bd = new BancoDeDados();
            $bd->Conexao();
    
            $sql = "INSERT INTO Respostas(conteudo, anexo, id_atividade) VALUES ('$this->conteudo_resposta', '$this->anexo_resposta', $id_atividade)";
            
            if ($bd->conn->query($sql) === TRUE)
            {
              header("location:../../view/Salas/Sala.php");
            }

            else
            {
              echo "Erro ao enviar a resposta: " . $bd->conn->error;
            }

           $bd->conn->close();
        }

        else
        {
            echo ("Preencha pelo menos o campo da resposta!");
        }
    }

    public function CarregarRespostas($id_atividade)
    {
      $bd = new BancoDeDados();
      $bd->Conexao();

      $sql = "CALL RESPOSTAS_DA_ATIVIDADE($id_atividade)";
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
            echo
            (
                '<div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-title">' . 'Resposta: ' .$rows[$i]['conteudo'] . '<br>' .  '</h6>
                            <h6 class="card-title">'. 'Anexo: ' . $rows[$i]['anexo'] . '<br>'.'</h6>
                        </div>
                    </div>
                </div>'
            );
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