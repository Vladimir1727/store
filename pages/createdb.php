<?php
include_once('classes.php');
tools::setparam('localhost','root','123456','shop');
$pdo=tools::connect();
$roles='create table roles(
	id int not null auto_increment primary key,
	role varchar(32) not null unique
	)default charset=utf8';
$customer='create table customers(
	id int not null auto_increment primary key,
	login varchar(32) not null unique,
	pass varchar(128) not null,
	roleid int,
	foreign key (roleid) references roles(id)
	on update cascade,
	discount int,
	total int,
	imagepath varchar(255)
	)default charset=utf8';
$cat='create table categories(
	id int not null auto_increment primary key,
	category varchar(64) not null unique
	)default charset=utf8';
$sub='create table subcategories(
	id int not null auto_increment primary key,
	subcategory varchar(64) not null unique,
	catid int,
	foreign key (catid) references categories(id)
	on update cascade
	)default charset=utf8';
$item='create table items(
	id int not null auto_increment primary key,
	itemname varchar(128) not null,
	catid int,
	foreign key (catid) references categories(id)
	on update cascade,
	subid int,
	foreign key (subid) references subcategories(id)
	on update cascade,
	pricein int not null,
	pricesale int not null,
	info varchar(256) not null,
	rate double,
	imagepath varchar(256) not null,
	action int
	)default charset=utf8';
$cart='create table carts(
	id int not null auto_increment primary key,
	customerid int,
	foreign key (customerid) references customers(id)
	on delete cascade,
	itemid int,
	foreign key (itemid) references items(id)
	on delete cascade,
	datein date,
	price int
	)default charset=utf8';
$order='create table orders(
	id int not null auto_increment primary key,
	customerid int,
	foreign key (customerid) references customers(id)
	on delete cascade,
	itemid int,
	foreign key (itemid) references items(id)
	on delete cascade,
	datein date,
	price int,
	ordername int not null
	)default charset=utf8';
$image='create table images(
	id int not null auto_increment primary key,
	itemid int,
	foreign key (itemid) references items(id)
	on delete cascade,
	imagepath varchar(255)
	)default charset=utf8';
$sale='create table sales(
	id int not null auto_increment primary key,
	customername varchar(32),
	itemname varchar(128),
	pricein int,
	pricesale int,
	datesale date
	)default charset=utf8';
$pdo->query($roles);
$pdo->query($customer);
$pdo->query($cat);
$pdo->query($sub);
$pdo->query($item);
$pdo->query($cart);
$pdo->query($order);
$pdo->query($sale);
$pdo->query($image);