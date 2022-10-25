Create database EcstasyClub;

use EcstasyClub;

Create table UserProfile(
	id int not null primary key auto_increment,
    nome varchar(25) not null,
    apelido varchar(25) not null,
    datanascimento date not null,
	codigoRP int,
    userid int,
    FOREIGN KEY (userid) REFERENCES user(id)
)Engine=InnoDB;