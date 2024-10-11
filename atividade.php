<?php 
class Atividade
{
    private $Titulo;
    private $Descricao;
    private $Valor;
    private $DataCriacao; // DateTime
    private $Prazo; // DateTime
    private $anexo;

    public function GetTitulo(){
        return $this->Titulo;
    }

    public function SetTitulo($titulo){
        $this->Titulo = $titulo;
    }

    public function GetDescricao(){
        return $this->Descricao;
    }

    public function SetDescricao($descricao){
        $this->Descricao = $descricao;
    }

    public function GetValor(){
        return $this->Valor;
    }

    public function SetValor($valor){
        $this->Valor = $valor;
    }
    public function GetPrazo(){
        return $this->Prazo
        ;
    }

    public function SetPrazo($prazo){
        $this->Prazo = $prazo;
    }

    public function GetDataCriacao(){
        return $this->DataCriacao;
    }

    public function SetPrazoEntrega($dataCriacao){
        $this->DataCriacao = $dataCriacao;
    }

    public function SetTableAtividade(){
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $nomeBd = "classroomplus";

        // Criando uma conexão com o banco de dados
        $conn = new mysqli($servidor, $usuario, $senha, $nomeBd);

        // Verificando a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Dados
        $titulo = $this->Titulo;
        $desc = $this->Descricao;
        $valor = $this->Valor;
        $prazo = $this->Prazo;
        $dataDeCriacao = new DateTime();
        $dataDeCriacao = date_format($dataDeCriacao, 'Y-m-d H:i:s');

        // Inserindo os dados no banco de dados
        $sql = "INSERT INTO Atividade (titulo, descricao, data_de_criacao, valor, prazo) VALUES ('$titulo', '$desc', '$dataDeCriacao', '$valor', '$prazo')";

        if ($conn->query($sql) === TRUE) {
            echo "Atividade criada com sucesso!";
        } else {
            echo "Erro ao criar sala: " . $conn->error;
        }

        // Fechando a conexão
        $conn->close();
    }
}
?>