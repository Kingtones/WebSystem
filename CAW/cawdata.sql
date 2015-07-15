create database caw_data;
	use caw_data;

	create table user(
		user_id int unsigned not null auto_increment primary key,
		user_name varchar(16) not null,
		password varchar(40) not null,
		email varchar(100) not null,
		expe int unsigned not null default '0',
		times int unsigned not null default '3',
		anonymity varchar(20) 
		user_state int not null default '0';
		);

	create table anonymity(
		anonymity_name varchar(20) not null primary key,
		anonymity_state int not null
		);
 
	create table article (
		article_id int unsigned not null auto_increment primary key,
		article_title varchar(100) not null,
		article_author varchar(16) not null,
		article_body text not null,
		time varchar(20) not null,
		moti_time varchar(20) not null

		);
	create table anon_article(
		anon_id int unsigned not null auto_increment primary key,
		anon_title varchar(100) not null,
		anon_author varchar(16) not null,
		anon_name varchar(20) not null,
		anon_body text not null,
		time varchar(20) not null,
		moti_time varchar(20) not null
		);
	create table anon_comment(
		anon_id int unsigned not null,
		parent_id int unsigned not null,
		id int unsigned not null auto_increment primary key,
		author_id int unsigned not null,
		anon_name varchar(20) not null,
		content text not null,
		time varchar(20) not null
		
		
	);
	create table comment(
		article_id int unsigned not null,
		parent_id int unsigned not null,
		id int unsigned not null auto_increment primary key,
		content text not null,
		author_id int unsigned not null,
		time varchar (20) not null
		author varchar(16) not null
		);
	create  table message(
		sender_id int unsigned not null,
		receiver_id int unsigned not null,
		time varchar(20) not null
		);
	create  table care(
		user_id int unsigned not null,
		friend_id int unsigned not null,
		time varchar(20) not null
		);
	grant select,insert,update,delete on caw_data.* to caw_user identified by 'caw_user_pw';


create event anonymity_event4 on schedule every 1 day starts'2015-07-09 06:00:00'
	do update anonymity set anonymity_state=0;

create event anonymity_event on schedule every 1 day starts'2015-07-09 06:00:00'
	do update user set anonymity=null,times=3;