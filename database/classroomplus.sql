create database classroomplus;
use classroomplus;

create table Usuarios(
id_usuario int primary key not null auto_increment,
nome varchar(80) not null,
email varchar(100) not null,
senha varchar(25) not null
);

create table Sala_De_Aula(
id_sala int primary key not null auto_increment,
id_criador int not null,
nome varchar(45) not null,
descricao varchar(500),
codigo_de_convite varchar(6) not null,
foreign key (id_criador) references Usuarios(id_usuario)
);

create table Usuarios_Por_Sala(
id_usuario int not null,
id_sala int not null,
cargo varchar(45) not null,
foreign key (id_usuario) references Usuarios(id_usuario),
foreign key (id_sala) references Sala_De_Aula(id_sala)
);

create table Atividades(
id_atividade int primary key not null auto_increment,
titulo varchar(100) not null,
descricao varchar(500),
tipo varchar(45) not null,
data_de_criacao datetime not null,
prazo datetime,
valor double,
id_sala int not null,
foreign key (id_sala) references Sala_De_Aula(id_sala)
);

create table Anexos(
id_anexo int primary key not null auto_increment,
id_atividade int not null,
anexo blob not null,
foreign key (id_atividade) references Atividades(id_atividade)
);

create table Respostas(
id_resposta int primary key not null auto_increment,
id_atividade int not null,
anexo blob not null,
foreign key (id_atividade) references Atividades(id_atividade)
);

create table Grupos(
id_grupo int primary key not null auto_increment,
id_atividade int not null,
foreign key (id_atividade) references Atividades(id_atividade)
);

create table Integrantes_Grupo(
id_grupo int not null,
id_usuario int not null,
foreign key (id_grupo) references Grupos(id_grupo),
foreign key (id_usuario) references Usuarios(id_usuario)
);