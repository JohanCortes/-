create table users(
    id int auto_increment,
    username varchar(20) unique not null,
    email varchar(50) not null,
    pass varchar(64) not null,
	primary key (id));
    
create table token(
    id int auto_increment,
    val varchar(64) not null,
    fecha timestamp not null,
    duracion time not null,
    primary key (id),
    id_user int not null,
    foreign key (id_user) references users(id));


insert into `users` (`username`, `email`, `pass`) values ('qwerty', 'qwerty@gmail.com', '321654');