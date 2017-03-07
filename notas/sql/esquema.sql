create database notas default character set utf8 collate utf8_unicode_ci;

create user usuarionotas@localhost identified by 'clavenotas';

grant all on notas.* to usuarionotas@localhost;

flush privileges;

use notas;

create table usuario (
    email varchar(150) not null primary key,
    password varchar(256) not null,
    falta date not null,
    tipo enum('administrador', 'avanzado', 'usuario') not null default 'usuario',
    estado tinyint
) engine=innodb  default charset=utf8 collate=utf8_unicode_ci;