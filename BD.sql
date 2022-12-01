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
	userid int not null,
    FOREIGN KEY (userid) REFERENCES user(id)
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
    idcriador int not null,
    idtipoevento int not null,
    foreign key (idcriador) references userprofile(id),
    foreign key (idtipoevento) references Tipoevento(id)
)Engine=InnoDB;

create table vip(
	id int not null primary key auto_increment,
    npessoas int not null,
    descricao varchar(250) not null,
    nbebidas int not null,
    preco float not null
)Engine=InnoDB;

create table pulseiras(
	id int not null primary key auto_increment,
    estado varchar(25) not null,
    tipo varchar(25) not null,
    codigorp int not null,
	idevento int not null,
    idcliente int not null,
    foreign key (idevento) references eventos(id),
    foreign key (idcliente) references userprofile(id)
)Engine=InnoDB;

create table vip_pulseira(
	id int not null primary key auto_increment,
    idvip int not null,
    foreign key (idvip) references vip(id),
    idpulseira int not null,
    foreign key (idpulseira) references pulseiras(id)
)Engine=InnoDB;

create table noticias(
	id int not null primary key auto_increment,
    titulo varchar(25) not null,
    datanoticia datetime not null,
    descricao varchar(250) not null,
    idcriador int not null,
    foreign key (idcriador) references userprofile(id)
)Engine=InnoDB;

create table faturas(
	id int not null primary key auto_increment,
    datahora_compra datetime not null,
    idpulseira int not null,
    foreign key (idpulseira) references pulseiras(id)
)Engine=InnoDB;

create table bebidas(
	id int not null primary key auto_increment,
    nome varchar(50) not null
)Engine=InnoDB;

create table linha_fatura(
	id int not null primary key auto_increment,
	idbebida int not null,
    foreign key (idbebida) references bebidas(id),
    idfatura int not null,
    foreign key (idfatura) references faturas(id)
)Engine=InnoDB;

create table galerias(
	id int not null primary key auto_increment,
    foto varchar(250) not null,
    idevento int not null,
    foreign key (idevento) references eventos(id)
)Engine=InnoDB;
