<?php
session_start();
if(!filter_input(INPUT_POST,"signup_form")){
	header("location:index.php");
	exit();
}
class form_action_helper{
	protected $f_data;
	protected $error;
	function __construct(){
		$this->error=new stdClass();//Define as a object veriable
		$this->f_data=(object)filter_input_array(INPUT_POST);//Load form post data and covert to object
		$this->check_form();//Run checking function
		$this->insert_to_database();//Run Insert to database function

	}
	private function FPAE($key=NULL){//Form Post array key exists echek function
		return array_key_exists($key,(array)$this->f_data)?1:0;
	}
	private function check_form(){
		$form_fields_check_data=array_unique(array($this->FPAE("fname"),$this->FPAE("lname"),$this->FPAE("email"),$this->FPAE("password"),$this->FPAE("cpassword")));
		if(intval($form_fields_check_data[0])===0):
			$this->error->main="HTML modified, please try again.";
		else:
			if(!$this->f_data->fname){$this->error->fname="Can't left empty";}//First name empty check
			elseif(preg_match('/[^a-zA-Z]/',$this->f_data->fname)){$this->error->fname="Invalid first name";}
			if(!$this->f_data->lname){$this->error->lname="Can't left empty";}
			elseif(preg_match('/[^a-zA-Z]/',$this->f_data->lname)){$this->error->lname="Invalid last name";}
			if(!$this->f_data->email){$this->error->email="Can't left empty";}
			elseif(!filter_var($this->f_data->email,FILTER_VALIDATE_EMAIL)){$this->error->email="Invalid email";}
			if(!$this->f_data->password){$this->error->password="Can't left empty";}
			elseif(strlen($this->f_data->password)<5){$this->error->password="Minimum 5 characters required";}
			elseif(strlen($this->f_data->password)>16){$this->error->password="Maximum 16 characters allowed";}
			if(!$this->f_data->cpassword){$this->error->cpassword="Can't left empty";}
			elseif($this->f_data->password && $this->f_data->cpassword && !isset($this->error->password) && $this->f_data->password!== $this->f_data->cpassword){$this->error->cpassword="Password not matched";}
		endif;
		
	}
	private function insert_to_database(){
		if(empty(implode("",(array)$this->error))){
			/* --- Insert data to database by help of ( $this->f_data ) ----*/
			echo "No error Found";
		}
	}
	public function get_error(){
		return (array)$this->error;//Conver THIS CLASS error VARIABLE from object to array 
	}
	public function get_data(){
		return (array)$this->f_data;//Conver THIS CLASS f_data VARIABLE from object to array 
	}
}
$self_form_action_helper=new form_action_helper();
$error=$self_form_action_helper->get_error();
$data=$self_form_action_helper->get_data();
if(!empty(implode("",$error))){
	print_r($error);
	$_SESSION["form_error"]=$error;
	$_SESSION["form_data"]=$data;
	header("Location:index.php");
	exit();
}
