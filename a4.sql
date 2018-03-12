/*
item(item_id, description, uom, location_id, on_hand,price, barcode)
customer(customer_id, name, rep_lname,rep_fname, email, phone, shipping_id, billing_id,
		username, password, comments)
address(address_id, address_line1, address_line2, city, state, zip)
*/

drop table if exists item;
drop table if exists customer;
drop table if exists address;

create table item
	(item_id int NOT NULL auto_increment,
	description varchar(100),
	uom varchar (25),
	location varchar (25),
	on_hand int,
	price double,
	primary key (item_it));

insert into item (description, uom, location_id, on_hand, price)
	values ('1/3 inch Lugnut', 'box (16 nuts per)', 'Dock 1', '20', '5.89');

create table customer
	(customer_id int NOT_NULL auto_increment,
	name varchar (25),
	rep_lname varchar (25),
	rep_fname varchar (25),
	email varchar (25),
	phone varchar (10)
	phone_ext varchar (4),
	shipping_id int,
	billing_id int,
	username. varchar (10),
	password varchar (10)
	comments varchar (280),
	primary key (customer_id));

create table address
	(address_id int NOT_NULL auto_increment,
	address_line1 varchar (25),
	address_line2 varchar (25),
	city varchar (25),
	zip varchar (6),
	primary key (address_id));
