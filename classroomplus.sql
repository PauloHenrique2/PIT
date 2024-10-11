create database classroomplus;
use classroomplus;

create table Usuarios(
id_usuario int primary key not null auto_increment,
nome varchar(80) not null,
email varchar(100) not null,
senha varchar(25) not null
);

select * from usuarios;

create table SalaDeAula(
id_sala int primary key not null auto_increment,
nome varchar(45) not null,
descricao varchar(500),
codigo_de_convite varchar(6) not null
);

create table Atividade(
atividade_id int primary key not null auto_increment,
titulo varchar(100) not null,
descricao varchar(500),
data_de_criacao datetime not null,
data_de_entrega datetime,
prazo datetime,
valor double
);

select * from salaDeAula;
select * from aluno;
select * from Atividade;