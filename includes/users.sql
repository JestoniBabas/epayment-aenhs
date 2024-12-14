create table users(
	uid int(11) not null AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) not null,
    uname VARCHAR(30) not null,
    pwd VARCHAR(255) not null,
    created_at datetime not null DEFAULT CURRENT_TIME
);