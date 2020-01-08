create database wim;
use wim;


create table contato(
codigo int unsigned auto_increment not null,
nome varchar(45),
email varchar(45),
comentario varchar(280),
primary key(codigo)
);

create table usuario(
cpf char(17) not null,
nome varchar(45) not null,
usuario varchar(20) not null,
senha varchar(50) not null,
datanascimento date not null,
email varchar(30) not null,
sexo varchar(10) not null,
pais varchar(30) not null, 
estado varchar(20) not null,
endereco varchar(90) not null,
complemento varchar(20), 
telefone varchar(20) not null,
data date not null,
hora time not null,
minutos varchar(20) not null,
cargo char (1) not null,
cmd varchar(120) not null,
primary key(cpf)
);


create table carteira(
codigo int unsigned auto_increment not null,
saldo double(12,2) not null,
recebido double(12,2) not null,
cmd varchar(120) not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);


create table deposito(
codigo int unsigned auto_increment not null,
num_cartao varchar(30) not null,
validade date not null,
proprietario varchar(45) not null,
seguranca int not null,
carteira_codigo int unsigned not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(carteira_codigo)REFERENCES carteira(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);

create table doacao(
codigo int unsigned auto_increment not null,
valor double(12,2) not null,
local_de_doacao varchar(30) not null,
data date not null,
horario time not null,
minutos varchar(20) not null,
carteira_codigo int unsigned not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(carteira_codigo)REFERENCES carteira(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);


create table compartilhamento(
codigo int unsigned auto_increment not null,
quantidade int not null,
minutos varchar(20) not null,
primary key(codigo)
);


create table propaganda(
codigo int unsigned auto_increment not null,
horario time not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);


create table notificacao(
codigo int unsigned auto_increment not null,
titulo varchar(30) not null,
descricao varchar(180) not null,
cor varchar(20) not null,
ativo char(1) not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);


create table metas(
codigo int unsigned auto_increment not null,
total_atual int not null,
total_anterior int not null,
abrigo_atual int not null,
abrigo_anterior int not null,
instituicoes_atual int not null,
instituicoes_anterior int not null,
data date not null,
minutos varchar(20) not null,
primary key(codigo)
);


create table saque(
codigo int unsigned auto_increment not null,
banco varchar(20) not null,
tipo varchar(20) not null,
agencia int not null,
conta varchar(15) not null,
data date not null,
quantia double(9,2) not null,
status varchar(20) not null,
minutos varchar(20) not null,
carteira_codigo int unsigned not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(carteira_codigo)REFERENCES carteira(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);


create table troca(
codigo int unsigned auto_increment not null,
produto varchar(30) not null,
valor double(9,2) not null,
data date not null,
status varchar(20) not null,
carteira_codigo int unsigned not null,
usuario_cpf char(14) not null,
primary key(codigo),
foreign key(carteira_codigo)REFERENCES carteira(codigo),
foreign key(usuario_cpf)REFERENCES usuario(cpf)
);


/*Usuarios Teste*/
insert into usuario(cpf,nome,usuario,senha,datanascimento,email,sexo,pais,estado,endereco,complemento,telefone,data,hora,minutos,cargo,cmd)values('741-852-963-00','Marao','marao',md5('123'),19921210,'marao@hotmail.com','Masculino','Brasil','Minas Gerais','Contagem','Apt 101','313351-8592',20190311,223155,'1061334991','c','$2y$10$nTmoodEaKgdwk9DGnnUaru6Lg3Vdokl2kiNA93KaI6LIguHhVveIO');
/*ADM Teste*/
insert into usuario(cpf,nome,usuario,senha,datanascimento,email,sexo,pais,estado,endereco,complemento,telefone,data,hora,minutos,cargo,cmd)values('987.654.321-00','Italo','italoalmeidah',md5('companywim@12345'),20000101,'21702241@aluno.cotemig.com.br','Masculino','Brasil','Minas Gerais','25 de Marco','502','319837-9952',20190310,200000,'1061334871','a','$2y$10$OAvYiMclGDw.Uk.zNVCNtOEElcM0dPNsMR6UQ/wdwJ0j8swgPLlf');
insert into usuario(cpf,nome,usuario,senha,datanascimento,email,sexo,pais,estado,endereco,complemento,telefone,data,hora,minutos,cargo,cmd)values('123.456.789-00','Mario','mariowillian',md5('99340910mM@'),20011101,'21701377@aluno.cotemig.com.br','Masculino','Brasil','Minas Gerais','Rio Acima','Canto das Águas','3199910-7569',20190311,213055,'1061334930','a','$2y$10$LFPW1qdAN9x9h382TB/E.O7c8wCsy6NMOuTlMSlwGta1G6obnXfMy');

/*Carteiras Teste*/
insert into carteira(codigo,saldo,recebido,cmd,usuario_cpf) values(null, 10, 0, '$2y$10$nTmoodEaKgdwk9DGnnUaru6Lg3Vdokl2kiNA93KaI6LIguHhVveIO', '741-852-963-00');
insert into carteira(codigo,saldo,recebido,cmd,usuario_cpf) values(null, 10, 0, '$2y$10$OAvYiMclGDw.Uk.zNVCNtOEElcM0dPNsMR6UQ/wdwJ0j8swgPLlf', '987.654.321-00');
insert into carteira(codigo,saldo,recebido,cmd,usuario_cpf) values(null, 10, 0, '$2y$10$LFPW1qdAN9x9h382TB/E.O7c8wCsy6NMOuTlMSlwGta1G6obnXfMy', '123.456.789-00');

/*Notificacao Teste*/
insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, 'Sucesso!', 'Obrigado por usar a nossa plataforma.', 'alert success', 's', '741-852-963-00');
insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, 'Curiosidade!', 'Voce pode enviar duvida ou sugestao na nossa pagina inicial.', 'alert info', 's', '741-852-963-00');
insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, 'Cuidado!', 'Evite trapacear em nossa plataforma.', 'alert', 's', '741-852-963-00');
insert into notificacao(codigo,titulo,descricao,cor,ativo,usuario_cpf) values(null, 'Aviso!', 'Pense bem caso queira excluir sua conta.', 'alert warning', 's', '741-852-963-00');

/*Saldo da carteira Teste*/
update carteira set saldo = saldo + 40.00 where codigo = 1;
/*Deposito Teste*/
insert into deposito(codigo,num_cartao,validade,proprietario,seguranca,carteira_codigo,usuario_cpf) values(null, '001122', 20190311, 'Marao', 123, 1, '741-852-963-00');

/*Doacoes Teste*/
	/*Abrigo*/
	insert into doacao(codigo,valor,local_de_doacao,data,horario,minutos,carteira_codigo,usuario_cpf) values(null, '12.00', 'Abrigo', 20190401, 195626, '1061361600', 1, '741-852-963-00');
	insert into doacao(codigo,valor,local_de_doacao,data,horario,minutos,carteira_codigo,usuario_cpf) values(null, '6.00', 'Abrigo', 20190401, 195636, '1061361600', 1, '741-852-963-00');
    /*Instituicao*/
	insert into doacao(codigo,valor,local_de_doacao,data,horario,minutos,carteira_codigo,usuario_cpf) values(null, '16.00', 'Instituicao', 20181223, 195626, '1061220633', 1, '741-852-963-00');
	insert into doacao(codigo,valor,local_de_doacao,data,horario,minutos,carteira_codigo,usuario_cpf) values(null, '8.00', 'Instituicao', 20181123, 195636, '1061142600', 1, '741-852-963-00');
    
/*Metas Teste*/
	/*Antiga*/
    insert into metas(codigo, total_atual, total_anterior, abrigo_atual, abrigo_anterior, instituicoes_atual, instituicoes_anterior, data, minutos) values(null, 50, 25, 10, 5, 20, 10, 20181201, '1061274000');
    /*Atual*/
    insert into metas(codigo, total_atual, total_anterior, abrigo_atual, abrigo_anterior, instituicoes_atual, instituicoes_anterior, data, minutos) values(null, 100, 50, 20, 10, 40, 20, 20190101, '1061275122');

/*Compartilhamento Teste*/
insert into compartilhamento(codigo,quantidade,minutos) values(null, 1, '1061214967');

/*Propaganda Teste*/
insert into propaganda(codigo,horario,usuario_cpf) values(null,'15:15:00','741.852.963-00');

/*Saque Teste*/
insert into saque(codigo,banco,tipo,agencia,conta,data,quantia,status,minutos,carteira_codigo,usuario_cpf) values(null, 'Itau', 'poupanca', 101, 3456, '20190311', '10.00', 'pendente', '1061334991', 1, '741-852-963-00');

insert into troca(codigo,produto,valor,data,status,carteira_codigo,usuario_cpf) values(null, 'bolo', 20, 20190707, 'pendente', :carteira_codigo, :usuario_cpf)