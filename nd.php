<?php

   $db_obj = new Database();
   
   $db_obj->connect_to_the_server(); // Consider usin g a singleton
   $db_obj->create_database();
   $db_obj->select_database();  
   $db_obj->create_tables();

class Database{
  
  //visit790412_vmfdc
  
  public function __construct(){
  
  }
  
  public function __toString(){
  
  }
  
  function connect_to_the_server(){
	  // mysql_connect("localhost", "cpses_virg9166cv", "CGPA5.0class");
	  mysql_connect("localhost", "root", "CGPA5.0class");
  }
  
  function create_database(){
       mysql_query("CREATE DATABASE IF NOT EXISTS visit790412_vmfdc") or die(mysql_error());
  }
  
  function select_database(){
       mysql_select_db("visit790412_vmfdc");
  }
  
  function create_tables(){
       $query0_0 = mysql_query("CREATE TABLE IF NOT EXISTS Factory(
	                          factory_id varchar(32) not null,
							  branch_id varchar(32) not null,
							  cvr varchar(50) not null unique,
	                          name varchar(150) not null,
							  sector varchar(100),
							  sub_sector varchar(100),
							  language varchar(50),
							  booking varchar(15),
							  availability_status int(2),
							  potential_structure varchar(10),
							  logo varchar(255),
							  PRIMARY KEY(factory_id, branch_id)
							  )") or die(mysql_error());
		
		$query0_2 = mysql_query("CREATE TABLE IF NOT EXISTS factory_description(
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         description text,
								 PRIMARY KEY(factory_id, branch_id)
		                         );")or die(mysql_error()); 
								  
		$query0_0_0 = mysql_query("CREATE TABLE IF NOT EXISTS factory_visit_type(
		                          visit_type_id varchar(32) not null,
					              factory_id varchar(32) not null,
					              branch_id varchar(32) not null,
					              visit_type varchar(150) not null,
								  PRIMARY KEY(visit_type_id)
								  )") 
								  or die(mysql_error());
		$query0_0_0 = mysql_query("CREATE TABLE IF NOT EXISTS factory_visit_purpose(
		                          visit_purpose_id varchar(32) not null,
					              factory_id varchar(32) not null,
					              branch_id varchar(32) not null,
					              visit_purpose varchar(150) not null,
								  PRIMARY KEY(visit_purpose_id)
								  )") 
								  or die(mysql_error()); 
							  
		$query0_1 = mysql_query("CREATE TABLE IF NOT EXISTS factory_contact(
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         contact_type varchar(30),
								 contact_description varchar(100),
							     contact varchar(100),
								 PRIMARY KEY(factory_id, branch_id, contact_type)
		                         );")or die(mysql_error());
								 
		$query0_2 = mysql_query("CREATE TABLE IF NOT EXISTS factory_address(
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         country varchar(100),
								 city varchar(100),
								 postal_code varchar(20),
							     street varchar(100),
								 block varchar(100),
								 floor varchar(100),
								 PRIMARY KEY(factory_id, branch_id)
		                         );")or die(mysql_error());
								 
		$query0_2 = mysql_query("CREATE TABLE IF NOT EXISTS factory_location(
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         longitude varchar(100),
								 latitude varchar(100),
								 PRIMARY KEY(factory_id, branch_id)
		                         );")or die(mysql_error()); 
								 // for general factories distribution around the world, dashboard purposes.
								 
		// Events
		$query0_3 = mysql_query("CREATE TABLE IF NOT EXISTS factory_event(
		                         
								 factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
								 event_id varchar(32) not null,
								 
								 event_title varchar(150),
								 category varchar(50),
								 secondary_category varchar(50),
								 host_language varchar(50),
		                         start_date varchar(30),
								 end_date varchar(30),
								 cod varchar(30),
								 start_time varchar(30),
								 end_time varchar(30),
								 cot varchar(30),
								 maxnov int(6),
								 minnov int(6),
								 max_age int(3),
								 min_age int(3),
								 
								 wwwd varchar(500),
								 wwwp varchar(500),
								 notes varchar(500),
								 
								 wwwb varchar(300),
								 cp varchar(20),
								 ce varchar(80),
								 status varchar(20) DEFAULT 'ACTIVE',
								 PRIMARY KEY(factory_id, branch_id, event_id)
		                         );")or die(mysql_error());
								 
		
		$query0_3 = mysql_query("CREATE TABLE IF NOT EXISTS factory_event_template(
		                         
								 factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
								 template_id varchar(32) not null,
								 
								 template_name varchar(150),
								 host_language varchar(50),
								 category varchar(50),
								 secondary_category varchar(50),
								 start_time varchar(30),
								 end_time varchar(30),
								 cot varchar(30),
								 maxnov int(6),
								 minnov int(6),
								 max_age int(3),
								 min_age int(3),
								 
								 wwwd varchar(500),
								 wwwp varchar(500),
								 notes varchar(500),
								 
								 wwwb varchar(300),
								 cp varchar(20),
								 ce varchar(80),
								 PRIMARY KEY(factory_id, branch_id, template_id)
		                         );")or die(mysql_error());
		
		$query0_2 = mysql_query("CREATE TABLE IF NOT EXISTS factory_event_address(
		                         event_id varchar(32) not null,
							     country varchar(32) not null,
								 city varchar(32) not null,
								 postcode varchar(32) not null,
								 street varchar(32) not null,
								 block varchar(32) not null
		                         );")or die(mysql_error());
								 
		$query0_2 = mysql_query("CREATE TABLE IF NOT EXISTS factory_event_template_address(
		                         template_id varchar(32) not null,
							     country varchar(32) not null,
								 city varchar(32) not null,
								 postcode varchar(32) not null,
								 street varchar(32) not null,
								 block varchar(32) not null
		                         );")or die(mysql_error()); 
		
		//USERS						 
		$query1_0 = mysql_query("CREATE TABLE IF NOT EXISTS User(
		                         user_id varchar(32) not null,
							     first_name varchar(50) not null,
		                         last_name varchar(50),
								 other_names varchar(80),
								 gender enum('M', 'F'),
								 email varchar(100),
								 telephone varchar(20),
								 category varchar(20),
								 password varchar(255),
								 status varchar(20),
								 profile_photo varchar(255),
								 signup_date date not null,
								 PRIMARY KEY(user_id)
		                         );") or die(mysql_error());
	    
		$query0_2 = mysql_query("CREATE TABLE IF NOT EXISTS user_address(
		                         user_id varchar(32) not null,
							     country varchar(32) not null,
								 postcode varchar(32),
								 city varchar(32) not null,
								 street varchar(32),
								 PRIMARY KEY(user_id)
		                         );")or die(mysql_error());
								 
		$query1_0 = mysql_query("CREATE TABLE IF NOT EXISTS factory_user_map(
		                         user_id varchar(32) not null,
								 factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
								 PRIMARY KEY(user_id, factory_id, branch_id)
							     );") or die(mysql_error());
								 
		$query1_1 = mysql_query("CREATE TABLE IF NOT EXISTS user_privilege(
		                         user_id varchar(32) not null,
							     privilege_id int(3) not null,
								 PRIMARY KEY(user_id, privilege_id)
		                         );") or die(mysql_error());
		
		$query1_2 = mysql_query("CREATE TABLE IF NOT EXISTS user_subscriptions(
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         user_id varchar(32) not null,
								 seen int(1) not null,
								 PRIMARY KEY(factory_id, branch_id, user_id)
		                         );") or die(mysql_error());
								 
		$query1_3 = mysql_query("CREATE TABLE IF NOT EXISTS user_visit(
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         user_id varchar(32) not null,
								 event_id varchar(32) not null,
								 date date,
								 PRIMARY KEY(factory_id, branch_id, user_id, date)
		                         );") or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS visit_price(
		                         price_id varchar(32) not null,
		                         event_id varchar(32) not null,
								 category enum('CHILDREN', 'ADULTS', 'OTHER'),
								 price int(6),
								 PRIMARY KEY(price_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS booking(
		                         booking_number bigint(30) AUTO_INCREMENT,
		                         event_id varchar(32) not null,
		                         user_id varchar(32) not null,
								 date date not null,
								 time time not null,
								 number_of_tickets int(4) not null,
								 other_details varchar(255),
								 PRIMARY KEY(booking_number)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS charge(
		                         charge_id bigint(30) AUTO_INCREMENT,
		                         event_id varchar(32) not null,
		                         category varchar(100) not null,
								 unit_price float(7, 4) not null,
								 PRIMARY KEY(charge_id)
		                         );")or die(mysql_error());
		
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS media_device(
		                         visit_id bigint not null AUTO_INCREMENT,
		                         year int(5) not null,
								 month int(2) not null,
								 date int(2) not null,
								 time varchar(20),
								 device varchar(20),
								 os varchar(60),
								 PRIMARY KEY(visit_id)
		                         );")or die(mysql_error());
		
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS page(
		                         page_id int(3) not null,
							     name varchar(50) not null,
								 PRIMARY KEY(page_id)
		                         );") or die(mysql_error());
		
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS per_page_traffic(
		                         load_id bigint not null AUTO_INCREMENT,
								 page_id int not null,
		                         year int(5) not null,
								 month int(2) not null,
								 date int(2) not null,
								 time varchar(20),
								 PRIMARY KEY(load_id)
		                         );")or die(mysql_error());
		
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS per_factory_traffic(
		                         load_id bigint(30) not null AUTO_INCREMENT,
								 factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
		                         year int(5) not null,
								 month int(2) not null,
								 date int(2) not null,
								 time varchar(20),
								 PRIMARY KEY(load_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS gallery(
		                         image_id bigint(30) not null AUTO_INCREMENT,
								 factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
								 user_id varchar(32),
								 image_name varchar(512) not null,
		                         date date not null,
								 time time not null,
								 visibility varchar(20),
								 PRIMARY KEY(image_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS event_gallery(
		                         image_id bigint(30) not null AUTO_INCREMENT,
								 event_id varchar(32) not null,
								 user_id varchar(32),
								 type enum('ORDINARY', 'PRIMARY'),
								 image_name varchar(512) not null,
		                         date date not null,
								 time time not null,
								 visibility varchar(20),
								 PRIMARY KEY(image_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS visitor_gallery(
		                         image_id bigint(30) not null AUTO_INCREMENT,
								 event_id varchar(32) null,
								 user_id varchar(32),
								 type varchar(20),
								 image_name varchar(512) not null,
		                         date date not null,
								 time time not null,
								 visibility varchar(20),
								 PRIMARY KEY(image_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS visit_request(
		                         request_id bigint(30) not null AUTO_INCREMENT,
								 factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
								 user_id varchar(32),
								 date date not null,
								 time time not null,
								 type enum('EVENT', 'UNSOLICITED'),
								 event_id varchar(32),
								 user_request_flag enum('CANCELLED', 'WAITING', 'TIMED_OUT'),
								 factory_request_flag enum('ACCEPTED', 'REJECTED', 'PENDING', 'DELETED'),
								 PRIMARY KEY(request_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS inquiry(
		                         inquiry_id bigint(50) not null AUTO_INCREMENT,
								 date date not null,
								 time time not null,
								 email varchar(150) not null,
								 phone varchar(32) not null,
							     name varchar(32) not null,
								 subject varchar(32) not null,
								 inquiry text not null,
								 PRIMARY KEY(inquiry_id)
		                         );")or die(mysql_error());
		
		$query0_0 = mysql_query("CREATE TABLE IF NOT EXISTS contact(
	                             type varchar(40) unique not null
								 )") or die(mysql_error());
		
		
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS message(
		                         message_id varchar(32) not null,
								 date date not null,
								 time time not null,
								 subjectline varchar(150) not null,
							     mark varchar(32) not null,
								 sender_id varchar(32) not null,
								 receiver_id varchar(32) not null,
								 response_to varchar(32),
								 PRIMARY KEY(message_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS message_content(
		                         content_id varchar(32) not null,
								 message_id varchar(32) not null,
							     format varchar(32) not null,
								 content_data text not null,
								 PRIMARY KEY(content_id)
		                         );")or die(mysql_error());
		
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS notification(
		                         notification_id bigint(30) not null AUTO_INCREMENT,
		                         source_id varchar(32) not null,
								 destination_id varchar(32) not null,
							     date date not null,
								 time time not null,
								 type varchar(50) not null,
								 description text not null,
								 mark varchar(20) not null,
								 PRIMARY KEY(notification_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS commission(
		                         commission_id bigint(30) not null AUTO_INCREMENT,
		                         factory_id varchar(32) not null,
							     branch_id varchar(32) not null,
								 percentage DECIMAL(5, 2),
								 type enum('FIXED', 'VARIABLE'),
							     date date not null,
								 time time not null,
								 amount DECIMAL(9, 2),
								 PRIMARY KEY(commission_id)
		                         );")or die(mysql_error());
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS vat(
		                         vat_id bigint(30) not null AUTO_INCREMENT,
		                         country_code varchar(10) not null,
							     tax_rate DECIMAL(5, 2) not null,
							     date date not null,
								 time time not null,
								 PRIMARY KEY(vat_id)
		                         );")or die(mysql_error());
								 
								 
		$query2_0 = mysql_query("CREATE TABLE IF NOT EXISTS search_engine(
		                         id bigint(30) not null AUTO_INCREMENT,
								 title text not null,
		                         page_url varchar(255) not null,
							     page_content TEXT not null,
								 PRIMARY KEY(id)
		                         );")or die(mysql_error());

		
  }
  
  
}
  
?>