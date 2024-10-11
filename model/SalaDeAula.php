<?php
include_once("../../model/BancoDeDados.php");

class SalaDeAula
{    
    private $Id_Sala;
    private $Nome;
    private $Desc;
    private $CodigoConvite;
    private $Criador;

    public function GetNome(){
        return $this->Nome;
    }

    public function SetNome($nome){
        $this->Nome = $nome;
    }
    public function GetDesc(){
        return $this->Desc;
    }

    public function SetDesc($desc){
        $this->Desc = $desc;
    }
    public function GetCodigo(){
        return $this->CodigoConvite;
    }

    public function SetCodigo($codigoConvite){
        $this->CodigoConvite = $codigoConvite;
    }

    public function GetIdSala(){
        return $this->Id_Sala;
    }

    public function CriarSala($id_usuario)
    {
        $bd = new BancoDeDados();
        $codigoConvite = rand(100000,999999);
        
        // Verificando se o código de convite já existe no banco de dados
        $bd->Conexao();
        $sql = "SELECT codigo_de_convite FROM Sala_De_Aula WHERE codigo_de_convite = '{$codigoConvite}' ";
        $resultado = $bd->conn->query($sql);

        if ($resultado->num_rows > 0)
        {
          $bd->conn->close();
          echo "Código de convite já existente, crie a sala novamente!";
        }

        else
        {
          $bd->conn->close();
          $this->SetCodigo($codigoConvite);
        }
        
        if (isset($this->Nome) && isset($this->CodigoConvite) && isset($id_usuario))
        {
            //Estabelecendo uma conexão com o Banco de Dados
            $bd = new BancoDeDados;
            $bd->Conexao();

            //verificando se já existe uma sala criada com esse nome pelo usuário
            $sql = "SELECT nome FROM sala_de_aula WHERE id_criador = $id_usuario";
            $result = $bd->conn->query($sql);
            $rows = $result->fetch_all();

            $verify = false;
            foreach($rows as $value){
                echo "num tem";
                if ($value == $this->Nome){
                    echo "tem";
                    $verify = true;
                }
            }

            if ($verify === FALSE){
            // Inserindo os dados da sala de aula no Banco de Dados, e criando uma relação com o usuário através da tabela "usuários por sala"
            $sql = "INSERT INTO Sala_de_Aula(nome, descricao, codigo_de_convite, id_criador) VALUES ('$this->Nome', '$this->Desc', '$this->CodigoConvite', $id_usuario)";
            
            
            if (($bd->conn->query($sql) == TRUE)) {
                $sql = "select id_sala from sala_de_aula WHERE codigo_de_convite = '$this->CodigoConvite';";
                $result = $bd->conn->query($sql);
                if($result->num_rows === 1){
                    $this->Id_Sala = $result->fetch_row()[0];
                    $sql = "INSERT INTO usuarios_por_sala(id_usuario, id_sala, cargo) VALUES($id_usuario, $this->Id_Sala, 'professor')";
                    if (($bd->conn->query($sql) === TRUE)) {
                        $bd->conn->close();
                        header("location:../../view/Salas/VisualizarSalas.php");
                    }
                }else{
                    echo "deu ruim";
                }   
            }
            else{
                echo("Você já criou uma sala com esse nome!");
                //header("location:../../view/Salas/VisualizarSalas.php");
            }
        }

        // Fechando a conexão
        $bd->conn->close();
        }
        else{
            echo "deu ruim";
        }
    }
    public function IngressarSala($id_usuario){
        $bd = new BancoDeDados;
        $bd->Conexao();


        $sql = "SELECT id_sala from sala_de_aula WHERE codigo_de_convite = '$this->CodigoConvite';";
        $result = $bd->conn->query($sql);

        if ($result->num_rows == 1)  //Verificando se uma sala com o código de convite informado existe
        {
            $row = $result->fetch_row();
            $this->Id_Sala = $row[0];
            $sql = "SELECT id_usuario from usuarios_por_sala where id_usuario = $id_usuario AND id_sala = $this->Id_Sala";
            $result = $bd->conn->query($sql);
            $row = $result->fetch_row();

            if(!$row[0]) //Verificando se o usuário já é um membro da sala de aula
            {
                $sql = "INSERT into usuarios_por_sala(id_sala, id_usuario, cargo) VALUES($this->Id_Sala, $id_usuario, 'aluno')";
                if($bd->conn->query($sql) === true){
                header("location:../../view/Salas/VisualizarSalas.php");
                }
                else{
                    echo "deu ruim";
                }
                
            } 
            else{
                echo "Você já está matriculado nesta sala";
                header("location:../../view/Salas/IngressarSala.php");
            }
        }   
        else {echo "Código Inválido"; //header("location:../../view/Salas/IngressarSala.php");}
        $bd->conn->Close();
        } 
    }

    public function GetAllInfo($id_sala){
        $bd = new BancoDeDados;
        $bd->Conexao();

        $sql = "CALL DADOS_SALA($id_sala)";
        $result = $bd->conn->query($sql);

        // Verificando se a chamada foi bem sucedida
        if ($result === FALSE) {
            header('../view/VisualizarSalas.php');
        }

        // Armazenando o resultado em uma variável
        $dados = $result->fetch_row();

        if($result->num_rows === 1){
            $row = $result->fetch_row();
            $this->Nome = $dados[0];
            $this->Desc = $dados[1];
            $this->CodigoConvite = $dados[2];
            $this->Criador = $dados[3];
        }
        else{
            header('../view/VisualizarSalas.php');
        }

        $bd->conn->close();
    }

    public function CarregarTurmas($id){
        $bd = new BancoDeDados();
        $bd->Conexao();

        $sql = "CALL SALAS_MATRICULADAS($id)";
        $result = $bd->conn->query($sql);
        $numRows = $result->num_rows;

        //Verificando se existem resultados e printando as salas em questão
        if ($numRows > 0) {
            // Armazenando o resultado em uma variável
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            for($i = 0; $i < $numRows; $i++){
               echo(
                '<div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="card-title">' . $rows[$i]["nome_sala"] . '</h4>
                            <h6 class="card-title">'. $rows[$i]["criador"] .'</h6>
                        </div>
                        <div class="card-footer">
                            <form action="../../view/Salas/Sala.php" method="POST">
                            <input type="submit" name="Entrar" value="Entrar"/>
                            <input type="hidden" name="id_sala" value="'.$rows[$i]["id_sala"].'">
                            </form>
                        </div>
                    </div>
                </div>');     
            }

        } else {
            echo "<p>Você não pertence a nenhuma sala!</p>";
        }
        // Fechando a conexão
        $bd->conn->close();
    }

    public function ExibirDadosDaTurma(){
    echo('
        <main>
        <section class="infoSala">
            <section id="nomeTurma">
                <h1>'. $this->Nome .
                    '<br>
                    -
                </h1>
            </section>
            <p>Descrição da Turma: </p>
            <i>'.
                $this->Desc .
            '</i>
            <br>
            <br>
            <p>Código de Convite: <strong>'. $this->CodigoConvite .'</strong></p>
            <button href = "location: ../../view/visualizarIntegrantes.php" id="verIntegrantesBtn">Ver Integrantes</button>
        </section>

        <br>
        ');
    }
}
?>
