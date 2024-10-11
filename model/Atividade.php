<?php 
include_once("../../model/BancoDeDados.php");
include_once("../../model/SalaDeAula.php");

class Atividade extends SalaDeAula
{
    private $TituloAtv;
    private $DescricaoAtv;
    private $ValorAtv;
    private $TipoAtv;
    private $DataCriacaoAtv; //datetime
    private $PrazoAtv; //datetime
    private $AnexoAtv;

    public function GetTitulo(){
        return $this->TituloAtv;
    }

    public function SetTitulo($titulo){
        $this->TituloAtv = $titulo;
    }

    public function SetTipo($tipo){
        $this->TipoAtv = $tipo;
    }

    public function GetTipo(){
        return $this->TipoAtv;
    }

    public function GetDescricao(){
        return $this->DescricaoAtv;
    }

    public function SetDescricao($descricao){
        $this->DescricaoAtv = $descricao;
    }

    public function GetAnexo(){
        return $this->AnexoAtv;
    }

    public function SetAnexo($anexo){
        $this->AnexoAtv = $anexo;
    }

    public function GetValor(){
        return $this->ValorAtv;
    }

    public function SetValor($valor){
        $this->ValorAtv = $valor;
    }
    public function GetPrazo(){
        return $this->PrazoAtv;
    }
    public function SetPrazo($prazo){
        if (!empty($prazo)) {
            echo "ta aqui";
            $this->PrazoAtv = new DateTime();
            $prazo = date_format($this->PrazoAtv, 'Y-m-d H:i:s');
            $this->PrazoAtv = $prazo;
        } else {
            $this->PrazoAtv = null;
        }
    }
    public function GetDataCriacao(){
        return $this->DataCriacaoAtv;
    }

    public function SetDataCriacao(){
        $dataDeCriacao = new DateTime();
        $dataDeCriacao = date_format($dataDeCriacao, 'Y-m-d H:i:s');
        $this->DataCriacaoAtv = $dataDeCriacao;
    }
    public function CriarAtividade($id_sala)
    {
        //Estabelecendo uma conexão com o Banco de Dados
        if (!empty($this->TituloAtv) && !empty($this->DescricaoAtv)){
            $bd = new BancoDeDados;
            $bd->Conexao();
            
            //Obtendo uma nova id para a atividade a ser criada
            $sql = "CALL NOVO_ID_ATIVIDADE;";
            $result = $bd->conn->query($sql);

            if ($result === FALSE) {
                die("Erro ao chamar a stored procedure: " . $bd->conn->error);
            }

            // Armazenando o resultado em uma variável
            $id_atividade = $result->fetch_row()[0];
            $bd->conn->close();

            // Inserindo os dados no banco de dados
            $bd->Conexao();
            if (!empty($this->PrazoAtv)){
                $sql = "INSERT INTO Atividades(id_atividade, titulo, descricao, data_de_criacao, prazo, valor, tipo, id_sala) VALUES ($id_atividade, '$this->TituloAtv', '$this->DescricaoAtv', '$this->DataCriacaoAtv', '$this->PrazoAtv', '$this->ValorAtv', '$this->TipoAtv', $id_sala)";
            }
            else{
                $sql = "INSERT INTO Atividades(id_atividade, titulo, descricao, data_de_criacao, prazo, valor, tipo, id_sala) VALUES ($id_atividade, '$this->TituloAtv', '$this->DescricaoAtv', '$this->DataCriacaoAtv', null, '$this->ValorAtv', '$this->TipoAtv', $id_sala)";
            }

            if ($bd->conn->query($sql) === TRUE) {
                echo "Atividade criada com sucesso!";
                header('location: ../../view/Salas/Sala.php');
            } else {
                echo "Erro ao criar sala: " . $bd->conn->error;
            }

            // Fechando a conexão
            $bd->conn->close();
        }
        else{
            echo("Preencha todos os campos!!!");
        }
    }
    public function CarregarAtividades($id_sala){ 
        $bd = new BancoDeDados();
        $bd->Conexao();

        $sql = "CALL ATIVIDADES_DA_SALA($id_sala)";
        $result = $bd->conn->query($sql);

        // Verificando se a chamada foi bem sucedida
        if ($result === FALSE) {
        die("Erro ao chamar a stored procedure: " . $bd->conn->error);
        }

        // Armazenando o resultado em uma variável
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Verificando se existem resultados e printando as Atividades em questão
        $numRows = count($rows);
        if ($numRows > 0) {
            for($i = 0; $i < $numRows; $i++)
            {
                echo('
                    <li>
                        <div class="col-md-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title">' . $rows[$i]['titulo'] . '<br>' .  '</h4>
                                    <h6 class="card-title">'.  $rows[$i]["tipo"] . '<br>'.'</h6>
                                    <h6 class="card-title">'. 'Descrição: ' . $rows[$i]["descricao"] . '<br>'.'</h6>
                                </div>
                                <div class="card-footer">
                                    <h6 class="card-title">'. 'Prazo: ' . $rows[$i]['prazo'] . '<br>' .'</h6>
                                    <h6 class="card-title">'. 'Valor: ' .$rows[$i]['valor'] . ' pts' . '</h6>
                                    <form action="../../view/Atividades/Grupos.php" method="POST">
                                    <input type="hidden" name="id_atividade" value="'.$rows[$i]["id_atividade"].'">
                                    <input type="submit" name="Entrar" value="Entrar"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    ');
            }

        } else {
            echo "Nenhum resultado encontrado.";
        }
        // Fechando a conexão
        $bd->conn->close();
    }
    public function DefinirGrupo($id_sala,$numGrupos){
        $bd = new BancoDeDados;
        $bd->Conexao();
        
        //Adquirindo os alunos 
        $sql = "CALL ALUNOS_SALA($id_sala)";
        $result = $bd->conn->query($sql);

        // Verificando se a chamada foi bem sucedida
        if ($result === FALSE) {
        die("Erro ao chamar a stored procedure: " . $bd->conn->error);
        }

        // Armazenando o resultado em uma variável
        $alunos = $result->fetch_all(MYSQLI_ASSOC);
        $bd->conn->close();

        // Verificando se existem resultados
        if (!empty($alunos)) {
            $grupos = []; // Inicializando a array que comportará os grupos da atividade.
            $i = 0; //Contadora utilizada para definir para qual grupo cada aluno vai.
        
            // Preenchendo os grupos
            foreach ($alunos as $aluno) {
                //$i % $numGrupos + 1; -> Essa operação calcula o resto da divisão entre a contadora do loop e o número 
                //de alunos e soma 1, com o intuito de definir para qual grupo cada aluno vai, separando-os de forma cíclica.
                $grupos["Grupo" . ($i % $numGrupos + 1)][] = [$aluno['id_usuario'], $aluno['nome_usuario']];
                $i++;
            }
            return $grupos;
        } else {
            return "Não há alunos nesta turma";
        }       
    }

    public function InserirGrupo($grupos, $id_atividade){
        if(is_array($grupos)){
            $g = 0;
            $bd = new BancoDeDados;
            foreach ($grupos as $grupo => $valor) {
                //Obtendo uma nova id para o grupo a ser criado
                $bd->Conexao();
                $sql = "CALL NOVO_ID_GRUPO;";
                $result = $bd->conn->query($sql);
                if ($result === FALSE) 
                {
                    die("Erro ao chamar a stored procedure: " . $bd->conn->error);
                }
                $id_grupo = $result->fetch_row()[0];  
                $bd->conn->close();
                
                $bd->Conexao();
                $sql = "INSERT INTO Grupos(id_grupo, id_atividade) values($id_grupo, $id_atividade)";
                $result = $bd->conn->query($sql);
        
                if ($result === TRUE) {  
                    foreach($valor as $integrantes)
                    {
                        if(!empty($integrantes))
                        {
                            $bd->conn->close();
                            $bd->Conexao();
                            $sql = "INSERT INTO Integrantes_Grupo(id_grupo, id_usuario) values($id_grupo,$integrantes[0])";
                            if ($bd->conn->query($sql) === TRUE) {  
                                echo "Deu bom";
                            }
                            else{
                                return false;
                            }
                        }
                        else{
                            return false;
                        }
                    }
                $g++;
                }
                else
                {
                    return false;
                }
            }
        }
        else{
            return false;
        }
    }
    
    public function CriarAtividadeEmGrupo($id_sala, $numGrupos){
        //Definindo os grupos da atividade
        $grupos = $this->DefinirGrupo($id_sala, $numGrupos);
        //Verificando se o método retornou os grupos ou uma mensagem de erro
        if(is_array($grupos))
        {
            if (!empty($this->TituloAtv) && !empty($this->DescricaoAtv))
            {
                //Estabelecendo uma conexão com o Banco de Dados
                $bd = new BancoDeDados;
                $bd->Conexao();
                
                //Obtendo uma nova id para a atividade a ser criada
                $sql = "CALL NOVO_ID_ATIVIDADE;";
                $result = $bd->conn->query($sql);
                if ($result === FALSE) {
                    die("Erro ao chamar a stored procedure: " . $bd->conn->error);
                }
                // Armazenando o resultado em uma variável
                $id_atividade = $result->fetch_row()[0];
                $bd->conn->close();
                // Inserindo os dados no banco de dados
                $bd->Conexao();
                if (!empty($this->PrazoAtv)){
                    $sql = "INSERT INTO Atividades(id_atividade, titulo, descricao, data_de_criacao, prazo, valor, tipo, id_sala) VALUES ($id_atividade, '$this->TituloAtv', '$this->DescricaoAtv', '$this->DataCriacaoAtv', '$this->PrazoAtv', '$this->ValorAtv', '$this->TipoAtv', $id_sala)";
                }
                else{
                    $sql = "INSERT INTO Atividades(id_atividade, titulo, descricao, data_de_criacao, prazo, valor, tipo, id_sala) VALUES ($id_atividade, '$this->TituloAtv', '$this->DescricaoAtv', '$this->DataCriacaoAtv', null, '$this->ValorAtv', '$this->TipoAtv', $id_sala)";
                }
                if ($bd->conn->query($sql) === TRUE) {
                    
                } else {
                    echo "Erro ao criar sala: " . $bd->conn->error;
                }

                // Fechando a conexão
                $bd->conn->close();
                if($this->InserirGrupo($grupos, $id_atividade)){
                    echo "Atividade Criada com sucesso!";
                }
            }
            else
            {
                return [false, "Preencha os campos obrigatórios!"];
            }
        }
        else{
            return [false, $grupos[1]];
        }
    }

    public function CarregarGrupos($id_atividade){
        $bd = new BancoDeDados;
        $bd->Conexao();

        $sql = "CALL FILTRAR_INTEGRANTES($id_atividade)";
        $result = $bd->conn->query($sql);

        // Verificando se a chamada foi bem sucedida
        if ($result === FALSE) {
        die("Erro ao chamar a stored procedure: " . $bd->conn->error);
        }
        
        if($result->num_rows > 0){
            $alunos = $result->fetch_all(MYSQLI_ASSOC);
            $num = 0;
            $grupo = $alunos[0]['id_grupo'] - 1;

            for ($i = 0; $i< (count($alunos)); $i++) {
                if($grupo == $alunos[$i]['id_grupo']){
                    echo "<h6>- " . $alunos[$i]['nome_usuario'] . "<br>Email: " . $alunos[$i]['email_usuario'] . "</h6>";
                }
                else{
                    $num++;
                    $grupo++;
                    echo "<br> <br><h1>Grupo $num</h1>";
                    echo "<h6>- " . $alunos[$i]['nome_usuario'] . "<br>Email: " . $alunos[$i]['email_usuario'] . "</h6>";
                }
            }
        }
        else{
            header("location: ../../view/Salas/Sala.php");
        }
    }
}
?>
