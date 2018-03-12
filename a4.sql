
/*

  Author:     Bradley Protano + Daniel Baker
  Class:      CSCI 467 Software Engineering
  Instructor: Kaisone Rush
  Semester:   Spring 2018
  Due:        03/29/2018

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
	primary key (item_id));

create table customer
	(customer_id int NOT NULL auto_increment,
	name varchar (25),
	lname varchar (25),
	fname varchar (25),
	email varchar (25),
	phone_area varchar (3),
        phone_middle varchar (3),
	phone_end varchar (4),
	phone_ext varchar (4),
	address_line1 varchar (25),
	address_line2 varchar (25),
	city varchar (25),
	state varchar (2),
        zip varchar (6),
	ship_address_line1 varchar (25),
	ship_address_line2 varchar (25),
	ship_city varchar (25),
	ship_state varchar (2),
	ship_zip varchar (6),
	username varchar (10),
	password varchar (10),
	comments varchar (280),
	primary key (customer_id));
