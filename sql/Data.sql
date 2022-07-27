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


insert into `users` (`username`, `email`, `pass`) values ('qwerty', 'asistenteelectronico2@gmail.com', 'e519d416c8b2623331c17695e7c6ab641e96cd0ce3f636b097b1be68fd793e16'/*321654*/);