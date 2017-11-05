   
   
   <?php
       

class User{

	   protected $email;
	   protected $telephone;
	   protected $password;
	   protected $first_name;
	   protected $last_name;
	   protected $other_names;
	   protected $gender;
	   private $category = "SITE_USER";
	   protected $status;
	   protected $profile_photo;
	   protected $signup_date;
	   

	  function __construct($first_name, $last_name, $other_name, $gender, $email, $password, $telephone, $status, $profile_photo, $signup_date){
		   $this->first_name = $first_name;
		   $this->last_name = $last_name;
		   $this->other_name = $other_name;
		   $this->gender = $gender;
		   $this->email = $email;
		   $this->telephone = $telephone;
		   $this->password = $password;
		   $this->status = $status;
		   $this->profile_photo = $status;
		   $this->signup_date = $signup_date;
		   
	   }
   
   
   public function __toString(){
	  return "".$this->first_name."".$this->last_name.
			 "".$this->other_name."".$this->email.
			 "".$this->password.
			 "".$this->telephone;
   }
   
   
   function set_email($email){
	  $this->email = $email;
   }
   
   function get_email(){
	  return $this->email;
   }
   
   function set_password($email){
	  $this->password = $password;
   }
   
   function get_password(){
	  return $this->password;
   }
   
   
   function set_first_name($first_name){
	  $this->first_name = $first_name;
   }
   
   function get_first_name(){
	  return $this->first_name;
   }
   
   function set_last_name($last_name){
	  $this->last_name = $last_name;
   }
   
   function get_last_name(){
	  return $this->last_name;
   }
   
   
   function set_other_names($other_names){
	  $this->other_names = $other_names;
   }
   
   function get_other_names(){
	  return $this->other_names;
   }
   
   function set_category(){
		 $this->category = $category;
   }
	  
  function get_category(){
	 return $this->category;
  }
   
  function add(){
       $first_name = $this->first_name;
	   $last_name = $this->last_name;
	   $other_name = $this->other_name;
	   $gender = $this->gender;
	   $email = $this->email;
	   $password = $this->password;
	   $telephone = $this->telephone;
	   $category = $this->get_category();
	   $status = "ACTIVE";
	   $profile_photo = $this->profile_photo;
	   $signup_date = $this->signup_date;
	   $id = $this->getAUserId();
	   $_SESSION['user_id'] = $id;
	   $query_obj = new Query("INSERT INTO user VALUES('$id', '$first_name', '$gender', '$last_name', '$other_name', 
	                                                '$email', '$telephone', '$category', '$password', '$status',
													'$profile_photo', '$signup_date')");
	  $query_obj->execute();
	  $status = (!$query_obj)? true: false;
	  
	  return $status;
   }
   
   
   public function getAUserId(){
      $id_generator = new IDGenerator();
	  $id = $id_generator->generateUserId();
	  return $id;
   }
   
   

}
   
   ?>