drop database EcstasyClub;

Create database EcstasyClub;

use EcstasyClub;

Create table disco(
	id int not null primary key auto_increment,
	nome varchar(25) not null,
    nif varchar(9) not null,
    localidade varchar(25) not null,
    codpostal varchar(8) not null,
    morada varchar(50) not null,
    lotacao int not null
)Engine=InnoDB;

Create table userProfile(
	id int not null primary key auto_increment,
	nome varchar(25) not null,
	apelido varchar(25) not null,
	datanascimento date not null,
	codigoRP varchar(25),
	sexo varchar(9),
	user_id int not null,
    FOREIGN KEY (user_id) REFERENCES user(id)
)Engine=InnoDB;

Create table tipoevento(
	id int not null primary key auto_increment,
    tipo varchar(25)
)Engine=InnoDB;

Create table eventos(
	id int not null primary key auto_increment,
    nome varchar(25) not null,
    descricao varchar(750) not null,
    cartaz varchar(250) not null,
    dataevento datetime not null,
    numbilhetesdisp int not null,
    preco float not null,
    estado varchar(25) not null,
    id_criador int not null,
    id_tipo_evento int not null,
    foreign key (id_criador) references userprofile(id),
    foreign key (id_tipo_evento) references Tipoevento(id)
)Engine=InnoDB;

create table vip(
	id int not null primary key auto_increment,
    npessoas int not null,
    descricao varchar(750) not null,
    nbebidas int not null,
    preco float not null
)Engine=InnoDB;

create table pulseiras(
	id int not null primary key auto_increment,
    estado varchar(25) not null,
    tipo varchar(25) not null,
    codigorp varchar(25),
	id_evento int not null,
    id_cliente int not null,
    foreign key (id_evento) references eventos(id),
    foreign key (id_cliente) references userprofile(id)
)Engine=InnoDB;

create table vip_pulseira(
	id int not null primary key auto_increment,
    id_vip int not null,
    foreign key (id_vip) references vip(id),
    id_pulseira int not null,
    foreign key (id_pulseira) references pulseiras(id)
)Engine=InnoDB;

create table noticias(
	id int not null primary key auto_increment,
    titulo varchar(25) not null,
    datanoticia datetime not null,
    descricao varchar(750) not null,
    id_criador int not null,
    foreign key (id_criador) references userprofile(id)
)Engine=InnoDB;

create table faturas(
	id int not null primary key auto_increment,
    datahora_compra datetime not null,
    preco float not null,
    id_pulseira int not null,
    foreign key (id_pulseira) references pulseiras(id)
)Engine=InnoDB;

create table bebidas(
	id int not null primary key auto_increment,
    nome varchar(50) not null
)Engine=InnoDB;

create table linha_fatura(
	id int not null primary key auto_increment,
	id_bebida int not null,
    foreign key (id_bebida) references bebidas(id),
    id_fatura int not null,
    foreign key (id_fatura) references faturas(id)
)Engine=InnoDB;

create table galerias(
	id int not null primary key auto_increment,
    foto varchar(250) not null,
    id_evento int not null,
    foreign key (id_evento) references eventos(id)
)Engine=InnoDB;
