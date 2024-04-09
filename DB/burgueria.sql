drop database if exists burguer2;

create database burguer2;

use  burguer2;

create table clientes (
	id int not null unique auto_increment,
	nome varchar(120) not null,
	telefone varchar(14) not null,
	endereco varchar(200) not null,
	email varchar(120) not null,
	cpf varchar(11) not null,
	password varchar(255) not null,
	imagem varchar(255) not null,
	primary key(id)
);

create table produtos (
	id int not null unique auto_increment,
	nome varchar(80) not null,
	preco decimal(10,2) not null,
	ingredientes varchar(255) not null,
	imagem varchar(255) not null,
	primary key(id)
);

create table pedidos (
	id int not null auto_increment,
	clientes_id int,
	status varchar(45),
	primary key (id),
	constraint fk_clientes_pedidos
	foreign key (clientes_id)
	references clientes(id)
);


create table pedidos2(
	pedidos_id int,
	produtos_id int,
	primary key (pedidos_id, produtos_id),
	
	constraint fk_pedidos_pedidos2
	foreign key (pedidos_id)
	references pedidos (pedidos_id),
	
		constraint fk_produtos_pedidos2
	foreign key (produtos_id)
	references produtos (produtos_id)
);



