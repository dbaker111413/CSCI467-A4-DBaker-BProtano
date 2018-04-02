
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
        values ('Cessna Aircraft Company');
insert into vendor (name)
        values ('Honeywell');
insert into vendor (name)
        values ('General Electric');
insert into vendor (name)
        values ('ACSS');

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
        values ('A32 Rudder', 'Crate (8 pieces)', "Aisle 3A, Bin 2", 22, 759.99, 1),
               ('RNAV/GNSS radar', 'Box (1 piece)', "Aisle 1C, Bin 5", 4, 1239.99, 4),
               ('Stroboscopic Navigation Light', 'Box (12 pieces)', "Aisle 4 Row 4", 16, 159.99, 2),
               ('1/2 inch Ball Bearings', 'Box (80 pieces)', "Aisle 1C Bin 4", 424, 30.99, 3),
               ('B12 Hydralic Fluid', '4 Gallons', "Aisle 5 Shelf 1", 60, 290.00, 3),
               ('C17 Yoke', 'Box (1 piece)', "Aisle 2A Row 4", 13, 890.00, 1);

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

insert into customer (name, ship_address_line1, ship_address_line2, ship_city, ship_state, ship_zip, address_line1, address_line2, city, state, zip, lname, fname, email,
                        phone_area, phone_middle, phone_end, comments)
        values ('Belkan', '2014 Normal Rd.', 'Building 2', 'Dekalb', 'IL', '60115', '110 E. John St.', '103', 'Champaign', 'IL', '61820', 'Protano', 'Bradley', 'not@real.email',
	          555,555,5555, 'This is placeholder text.'),
               ('Mobius Cor', '110 E. John St.', '103', 'Champaign', 'IL', '61820', '2014 Normal Rd.', 'Building 2', 'Dekalb', 'IL', '60115', 'Baker', 'Daniel', 'so@real.email',
          	  555,555,5555, 'This text is significant'),
               ('ArmsTech', '1800 W. Foster Ave.', 'Floor 3', 'Chicago', 'IL', '60625', '110 E. John St.', '103', 'Champaign', 'IL', '61820', 'Protano', 'Bradley','not@aip.email',
	          555,555,5555, 'This is text that could include preferences that do not fit a variable.'),
               ('Feisar', '312 Auburn Rd.', 'Rm 130', 'Elgin', 'IL', '60170',  '2014 Normal Rd.', 'Building 2', 'Dekalb', 'IL', '60115', 'Baker', 'Daniel', 'so@real.email',
          	  555,555,5555, 'This text is significant and meaninfdul');


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
        values (current_timestamp, 'Released for pick', '2018-04-05', 6, 1),
               (current_timestamp, 'Released for pick', '2018-04-16', 7, 2),
               (current_timestamp, 'Customer Approved', '2018-04-24', 3, 2),
               (current_timestamp, 'Customer Approved', '2018-04-27', 2, 3),
               (current_timestamp, 'Released for pick', '2018-04-29', 5, 3),
               (current_timestamp, 'Released for pick', '2018-05-02', 12, 4),
               (current_timestamp, 'Customer Approved', '2018-05-03', 1, 1),
               (current_timestamp, 'Created', '2018-08-17', 3, 4);

create table detail
       (line_id int NOT NULL auto_increment,
       order_id int,
       item_id int,
       line_qty int,
       primary key (line_id),
       foreign key (order_id) references order_header(order_id));

insert into detail (order_id, item_id, line_qty)
        values (1, 2, 4),
               (1, 1, 1),
               (1, 3, 2),
               (1, 4, 15),
               (1, 6, 6),
               (1, 5, 6),
               (3, 2, 14),
               (3, 1, 12),
               (3, 3, 8),
               (2, 3, 15),
               (2, 6, 6),
               (2, 4, 18),
               (2, 2, 4),
               (2, 1, 1),
               (2, 3, 2),
               (2, 5, 15),
               (4, 6, 4),
               (4, 5, 10),
               (5, 1, 40),
               (5, 2, 13),
               (5, 3, 3),
               (5, 4, 22),
               (5, 5, 6),
               (6, 5, 8),
	       (6, 2, 9),
               (6, 1, 11),
               (6, 3, 24),
               (6, 4, 35),
               (6, 6, 7),
               (6, 5, 18),
	       (6, 2, 25),
               (6, 1, 1),
               (6, 3, 4),
               (6, 4, 8),
               (6, 6, 12),
               (7, 5, 6),
               (8, 3, 1),
               (8, 4, 120),
               (8, 5, 14);
