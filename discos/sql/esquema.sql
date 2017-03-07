create database db_discos default character set utf8 collate utf8_unicode_ci;

create user admin@localhost identified by 'admin';

grant all on admin.* to admin@localhost;

flush privileges;

use db_discos;

create table usuario(
    login varchar(150) not null primary key,
    password varchar(256) not null
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

create table disco(
    id int auto_increment not null primary key,
    title varchar(150) not null
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

create table autor(
    id int auto_increment not null primary key,
    nombre varchar(150) not null
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;

create table discos_autor(
    id_disco int not null,
    id_autor int not null,
    foreign key(id_disco) references disco(id) on delete cascade on update cascade,
    foreign key(id_autor) references autor(id) on delete cascade on update cascade
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;