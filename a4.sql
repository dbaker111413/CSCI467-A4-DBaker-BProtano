
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

drop table if exists detail;
drop table if exists item;
drop table if exists vendor;
drop table if exists order_header;
drop table if exists customer;

create table vendor
        (vendor_id int NOT NULL auto_increment,
	name varchar(25),
	primary key (vendor_id));

insert into vendor (name)
        values ('Mobius One');
insert into vendor (name)
        values ('Mobius Two');
insert into vendor (name)
        values ('Mobius Three');
insert into vendor (name)
        values ('Not Mobius');

create table item
	(item_id int NOT NULL auto_increment,
	description varchar(100),
	uom varchar (25),
	location varchar (25),
	on_hand int,
	price double,
	vendor_id int,
	primary key (item_id),
        foreign key (vendor_id) references vendor(vendor_id));

insert into item (description, uom, location, on_hand, price, vendor_id)
        values ('Metal Gear', 'box (4 pieces)', "Groznj grad", 12, 59.99, 1),
               ('Soliton radar', 'box (1 piece)', "Shadow Moses", 4, 39.99, 1),
               ('NVG solid eye', 'box (6 pieces)', "Camp Oemga", 16, 159.99, 1),
               ('C. Box (The Orange)', 'box (1 per duh)', "Big Shell", 42, 10.99, 1),
               ('Active Decoy', 'box (4 pieces)', "Mother Base", 30, 255.99, 1);

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

insert into customer (name, ship_address_line1, ship_address_line2, ship_city, ship_state, ship_zip)
        values ('Outer Heaven', '014 Intrude ave.', 'Tower Building', 'Zanzibar', 'IL', '60115');

insert into customer (name)
        values ('Stonehenge'),
               ('Yellow 13');

create table order_header
       (order_id int NOT NULL auto_increment,
       order_date timestamp,
       order_status varchar (25),
       order_expected_date varchar (10),
       order_lines int,
       customer_id int,
       shipment_id int,
       primary key (order_id),
       foreign key (customer_id) references customer(customer_id));

insert into order_header (order_date, order_status, order_expected_date, order_lines, customer_id)
        values (current_timestamp, 'Released for pick', '2018-01-23', 5, 1),
               (current_timestamp, 'Released for pick', '2018-02-23', 2, 2),
               (current_timestamp, 'Released for pick', '2018-03-23', 6, 3),
               (current_timestamp, 'Released for pick', '2018-04-23', 3, 1),
               (current_timestamp, 'Released for pick', '2018-05-23', 4, 2),
               (current_timestamp, 'Released for pick', '2018-06-23', 4, 1),
               (current_timestamp, 'Released for pick', '2018-07-23', 4, 3),
               (current_timestamp, 'Released for pick', '2018-08-23', 4, 2),
               (current_timestamp, 'Released for pick', '2018-09-23', 4, 1),
               (current_timestamp, 'Released for pick', '2018-11-23', 4, 3),
               (current_timestamp, 'Released for pick', '2018-12-23', 4, 3),
               (current_timestamp, 'Released for pick', '2018-05-24', 4, 2),
               (current_timestamp, 'Released for pick', '2018-05-25', 4, 2),
               (current_timestamp, 'Released for pick', '2018-05-26', 4, 1),
               (current_timestamp, 'Released for pick', '2018-05-27', 4, 1),
               (current_timestamp, 'Released for pick', '2018-05-28', 4, 2),
               (current_timestamp, 'Released for pick', '2018-05-12', 4, 1),
               (current_timestamp, 'Released for pick', '2018-05-13', 4, 3),
               (current_timestamp, 'Released for pick', '2018-05-14', 4, 2),
               (current_timestamp, 'Released for pick', '2018-05-15', 4, 2),
               (current_timestamp, 'Released for pick', '2018-05-17', 4, 2),
               (current_timestamp, 'Released for pick', '2018-05-16', 4, 1),
               (current_timestamp, 'Released for pick', '2018-06-23', 2, 1);

create table detail
       (line_id int NOT NULL auto_increment,
       order_id int,
       item_id int,
       line_qty int,
       primary key (line_id),
       foreign key (order_id) references order_header(order_id));

insert into detail (order_id, item_id, line_qty)
        values (1, 1, 4),
               (1, 2, 1),
               (1, 3, 2),
               (1, 4, 15),
               (1, 5, 6),
               (23, 3, 1),
               (23, 4, 4),
               (23, 5, 14);
