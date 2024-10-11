<?php
include_once("../../model/BancoDeDados.php");
class Usuario{
    private $Email;
    private $Senha;
    private $Nome;
    private $Cargo;

    public function GetNome(){
        return $this->Nome;
    }

    public function SetNome($nome){
        $this->Nome = $nome;
    }

    public function GetEmail(){
        return $this->Email;
    }

    public function SetEmail($email){
        $this->Email = $email;
    }

    public function GetSenha(){
        return $this->Senha;
    }

    public function SetSenha($senha){
        $this->Senha = $senha;
    }

    public function GetCargo(){
        return $this->Cargo;
    }
    public function SetCargo($cargo){
        $this->Cargo = $cargo;
    }

    public function Cadastrar(){
        $bd = new BancoDeDados();
        $bd->Conexao();

        if (!empty($this->Nome) or !empty($this->Email) or !empty($this->Senha))
        {
            //verificando se o email informado já está sendo utilizado
            $sql = "SELECT email FROM usuarios WHERE email = '$this->Email';"; 
            $result = $bd->conn->query($sql);

            if($result->num_rows == 0){
                $sql = "INSERT INTO usuarios(nome, email, senha) VALUES ('$this->Nome', '$this->Email', '$this->Senha');";

                if ($bd->conn->query($sql) === TRUE) {
                    //pegando o id recém gerado do usuário para que ele seja utilizado durante a navegação pelo site
                    $sql = "SELECT id_usuario FROM usuarios WHERE email = '$this->Email';";  
                    $result = $bd->conn->query($sql);
                    $id_usuario = $result->fetch_row(); 

                    session_start();
                    $_SESSION['id_usuario'] = $id_usuario[0];
                    header("location:../../view/Salas/VisualizarSalas.php");
                } else {
                    header("location:../../view/CadastroLogin/Cadastro.php");
                }
            }else{
                header("location:../../view/CadastroLogin/Cadastro.php");
            }
        }
        else{
            header("location:../../view/CadastroLogin/Cadastro.php");
        }     
        // Fechando a conexão
        $bd->conn->close();   
    }

    public function Logar()
    {
        $bd = new BancoDeDados();
        $bd->Conexao();
        $consulta = "SELECT id_usuario, email, senha FROM usuarios WHERE email = '$this->Email' AND senha = '$this->Senha'";
        $result = $bd->conn->query($consulta);
             
        if ($result->num_rows === 1) {
            $row = $result->fetch_row();
            session_start();
            $_SESSION['id_usuario'] = $row[0];
            session_id();
            $bd->conn->close();
            header("location:../../view/Salas/VisualizarSalas.php");
        } else {
            $bd->conn->close();
            header("location:../../view/CadastroLogin/Login.php");
        }
    }

    public function ObterCargo(){
        $bd = new BancoDeDados();
        session_start();
        $sql = "SELECT cargo from usuarios_por_sala WHERE id_sala = $_SESSION[id_sala] AND id_usuario = $_SESSION[id_usuario]";
        $result = $bd->conn->query($sql);
        $row = $result->fetch_row();
        $this->SetCargo($row);
    }

    public function ExibirDados($id_usuario)
    {
        $bd = new BancoDeDados();
        $bd->Conexao();

        $sql = "SELECT nome, email, senha FROM Usuarios WHERE id_usuario = '{$id_usuario}'";
        $result = $bd->conn->query($sql);

        // Verificando se a chamada foi bem sucedida
        if ($result->num_rows != 1)
        {
          die("Erro ao exibir os dados do usuário: " . $bd->conn->error);
        }

        // Armazenando o resultado em uma variável
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Verificando se existem resultados e printando as Atividades em questão
        $numRows = count($rows);
        if ($numRows > 0) {
            for($i = 0; $i < $numRows; $i++)
            {
                echo
                (
                    '<p><strong>Nome: </strong>' . $rows[$i]['nome'] . '<br>' .  '</p>
                    <p><strong>Email: </strong>' . $rows[$i]['email'] . '<br>'.'</p>'
                );
            }

        } else {
            echo "Nenhum resultado encontrado.";
        }
        // Fechando a conexão
        $bd->conn->close();
    }
}
?>