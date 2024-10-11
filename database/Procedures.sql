use leon;
-- Retornar as salas de aula nas quais o aluno está matriculado

DELIMITER $$
CREATE PROCEDURE SALAS_MATRICULADAS(IN ID_USUARIO INT) 
BEGIN
SELECT DISTINCT
	sala_de_aula.id_sala as id_sala, sala_de_aula.nome as nome_sala, sala_de_aula.id_criador as criador
FROM
	usuarios_por_sala 
	INNER JOIN sala_de_aula using(id_sala)
WHERE
	usuarios_por_sala.id_usuario = ID_USUARIO;
END
$$ DELIMITER ;

DELIMITER $$
CREATE PROCEDURE NOVO_ID_ATIVIDADE()
BEGIN
	SELECT DISTINCT
		count(id_atividade) + 1 from atividades;
END
$$ DELIMITER ;

DELIMITER $$
CREATE PROCEDURE NOVO_ID_GRUPO()
BEGIN
	SELECT DISTINCT
		count(id_grupo) + 1 from grupos;
END
$$ DELIMITER ;

-- Retornar os dados da sala de aula
DELIMITER $$
CREATE PROCEDURE DADOS_SALA(IN ID_SALA INT) 
BEGIN
    SELECT DISTINCT
        sala_de_aula.nome, sala_de_aula.descricao as 'desc', sala_de_aula.codigo_de_convite,sala_de_aula.id_criador
    FROM
        sala_de_aula
    WHERE
        sala_de_aula.id_sala = ID_SALA;
END
$$ DELIMITER ;


-- Retornar os alunos da sala na qual o aluno está matriculado
DELIMITER $$
CREATE PROCEDURE ALUNOS_DA_SALA(IN ID INT) 
BEGIN
    SELECT DISTINCT
        usuarios.nome
    FROM
		usuarios
        INNER JOIN usuarios_por_sala using(id_usuario)
        INNER JOIN sala_de_aula using(id_sala)
    WHERE
        sala_de_aula.id_sala = ID AND usuarios_por_sala.cargo = 'aluno';
END
$$ DELIMITER ;

-- retornar as atividades das salas de aula
DELIMITER $$
CREATE PROCEDURE ATIVIDADES_DA_SALA(IN ID_TURMA INT) 
BEGIN
SELECT DISTINCT
	atividades.id_atividade,atividades.titulo, atividades.descricao, atividades.prazo , atividades.valor, atividades.tipo
FROM
	atividades
	INNER JOIN sala_de_aula using(id_sala)
WHERE
	sala_de_aula.id_sala = ID_TURMA;
END
$$ DELIMITER ;

-- Retornar os dados atividades das salas de aula
DELIMITER $$
CREATE PROCEDURE DADOS_ATIVIDADE(IN ID INT) 
BEGIN
SELECT DISTINCT
        atividades.titulo, atividades.descricao, atividades.tipo, atividades.prazo, atividades.valor, atividades.id_atividade
    FROM
        atividades
    WHERE
        atividades.id_atividade = ID;
END
$$ DELIMITER ;

-- Info dos alunos da sala
DELIMITER $$
CREATE PROCEDURE ALUNOS_SALA(IN TURMA_ID INT) 
BEGIN
	SELECT DISTINCT
        usuarios.id_usuario as id_usuario, nome as nome_usuario, email as email_usuario
    FROM
        usuarios
        INNER JOIN usuarios_por_sala using(id_usuario)
    WHERE
        usuarios_por_sala.id_sala = TURMA_ID AND usuarios_por_sala.cargo = "aluno";
END
$$ DELIMITER ;

-- id dos alunos da sala
DELIMITER $$
CREATE PROCEDURE ID_ALUNOS_SALA(IN TURMA_ID INT) 
BEGIN
	SELECT DISTINCT
        usuarios.id_usuario as id_usuario
    FROM
        usuarios
        INNER JOIN usuarios_por_sala using(id_usuario)
    WHERE
        usuarios_por_sala.id_sala = TURMA_ID AND usuarios_por_sala.cargo = "aluno";
END
$$ DELIMITER ;
        
 -- Retornar Integrantes do Grupo
CREATE OR REPLACE VIEW DADOS_INTEGRANTES_GRUPO AS 
SELECT DISTINCT
	usuarios.nome as nome_usuario,
	usuarios.email as email_usuario,
	integrantes_grupo.id_grupo,
    grupos.id_atividade
FROM
	usuarios
	INNER JOIN integrantes_grupo using(id_usuario)
    INNER JOIN grupos using(id_grupo);
    select * from atividades;

-- Filtrando a View dos integrantes
DELIMITER $$
CREATE PROCEDURE FILTRAR_INTEGRANTES(IN atividade_id INT) 
BEGIN
	select * from DADOS_INTEGRANTES_GRUPO where id_atividade = atividade_id;
END
$$ DELIMITER ;
select * from atividades;
CALL FILTRAR_INTEGRANTES(9);

-- Excluir usuários
DELIMITER $$
 CREATE PROCEDURE EXCLUIR_USUARIO(IN ID INT)
 BEGIN
  DELETE FROM
	Usuarios
  WHERE
    Usuarios.id_usuario = ID;
 END $$
DELIMITER ;

-- Retornar as respostas da atividade
DELIMITER &&
CREATE PROCEDURE RESPOSTAS_DA_ATIVIDADE(IN ID INT)
BEGIN
 SELECT
  conteudo, anexo
 FROM
  Respostas r
  INNER JOIN Atividades atv USING (id_atividade)
 WHERE
  atv.id_atividade = ID;
END &&
DELIMITER ;
--