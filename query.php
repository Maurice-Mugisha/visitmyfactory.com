<?php

    class Query{
	
	    public $query;
	   
	   
	   function __construct($query){
	      $this->query = $query;
	   }
		
	   public function __toString(){
	      return $this->query;
	   }	
		
	   public function execute(){
		  mysql_query($this->query) or die(mysql_error());
	   }
	   
	   public function check_user($email){
	     $query_obj = mysql_query("SELECT * FROM USER WHERE email = '$email' LIMIT 1") or die(mysql_error());
	     while($row = mysql_fetch_array($query_obj));
	     if(strlen($row['email']) > 0)
		   return true;
		 else
		   return false;
       }
	
	}

?>