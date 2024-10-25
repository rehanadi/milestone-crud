create table users (
	id int auto_increment primary key,
	name varchar(100) not null,
	email varchar(100) not null,
	password varchar(255) not null,
	phone varchar(100) not null,
	gender char(1) not null,
	address text not null,
	created_at timestamp default current_timestamp
);