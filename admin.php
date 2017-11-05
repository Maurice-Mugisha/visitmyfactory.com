   
   
   <?php
   
   
class Admin extends User{
	   
 
	  
  protected $category = "ADMIN_USER";
  
  function __construct($first_name, $last_name, $other_name, $email, $password, $telephone){
	   $this->first_name = $first_name;
	   $this->last_name = $last_name;
	   $this->other_name = $other_name;
	   $this->email = $email;
	   $this->password = $password;
	   $this->telephone = $telephone;
   }
  
  /** @Override */
  public function __toString(){
  
  return "".$this->first_name."".$this->last_name.
		 "".$this->other_name."".$this->email.
		 "".$this->password.
		 "".$this->telephone.
		 "".$this->type;
  }
  
  function set_category(){
	  $this->category = $category;
  }
		  
  function get_category(){
	  return $this->category;
  }
		  
	   
}
   
   
   ?>