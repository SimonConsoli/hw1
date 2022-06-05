create database lebonblog;

use lebonblog;


create table users(
    personID INTEGER AUTO_INCREMENT,
    name varchar(255),
    surname varchar(255),
    username varchar(15),
    email varchar(255),
    password varchar(20),
    PRIMARY KEY (personID)
);

create table posts(
    IDpost INTEGER primary key AUTO_INCREMENT,
    IDutente INTEGER,
    titolo VARCHAR(80),
    opinion VARCHAR(4000),
    time timestamp not null default current_timestamp on update current_timestamp,
    FOREIGN KEY(IDutente)references users(personID)
)


