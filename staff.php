
<?php

class Staff{
	//database connection and table name

private $conn;
private $table_name="staff";

//object properties
public $staffcode;
public $name;
public $gender;
public $designation;
public $birthdate;
public $qualification;
public $experience;
public $expyears;
public $prevschool;
public $prevschoolcode;
public $prevschooladdress;
public $adhaarno;
public $bloodgroup;
public $address;
public $mobile;
public $fathername;
public $mothername;
public $fatheradhaar;
public $motheradhaar;
public $leavingdate;


public function __construct($db){
	$this->conn=$db;
}

//create user
function create(){
	//write query

	try{

	$this->autogen();	
	$query="INSERT INTO ".$this->table_name. "(staffcode,name,gender,designation,birth_date,address,mobileno,aadhaar_number,qualification,previous_experiences,experienceyears,previous_schoolname,previous_schoolcode,previous_schooladdress,bloodgroup,father_name,mother_name,father_aadhaar_number,mother_aadhaar_number) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$stmt=$this->conn->prepare($query);

	//bind values
	$stmt->bindParam(1,$this->staffcode);
	$stmt->bindParam(2,$this->name);
	$stmt->bindParam(3,$this->gender);
	$stmt->bindParam(4,$this->designation);
	$stmt->bindParam(5,$this->birthdate);
	$stmt->bindParam(6,$this->address);
	$stmt->bindParam(7,$this->mobile);
	$stmt->bindParam(8,$this->adhaarno);
	$stmt->bindParam(9,$this->qualification);
	$stmt->bindParam(10,$this->experience);
	$stmt->bindParam(11,$this->expyears);
	$stmt->bindParam(12,$this->prevschool);
	$stmt->bindParam(13,$this->prevschoolcode);
	$stmt->bindParam(14,$this->prevschooladdress);
	$stmt->bindParam(15,$this->bloodgroup);
	$stmt->bindParam(16,$this->fathername);
	$stmt->bindParam(17,$this->mothername);
	$stmt->bindParam(18,$this->fatheradhaar);
	$stmt->bindParam(19,$this->motheradhaar);

	   
 	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}
	
}
catch(Exception $ex){
	return $ex.errorMessage();
}
}


//autogeneration
function autogen(){
	$query="select count(staffcode) as c, max(staffcode) as m from ".$this->table_name;
	$stmt=$this->conn->prepare($query);
	$stmt->execute();

	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$this->countrows=$row['c'];
	if($this->countrows==0)
		$this->staffcode=1;
	else{
		$this->staffcode=$row['m'];
		$this->staffcode++;
	}
}


//select all data
function readAll(){
	$query="SELECT * FROM ". $this->table_name;
	
	$stmt=$this->conn->query($query);
	$output=array();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;
}

//fetch staffcode, name from staff table where username and pwd is not yet assigned to the staff
function fetchUniqueStaffCode()
{
	$query="select staffcode, name , designation from staff where staffcode in (select staffcode from staff left join users using(staffcode) where users.staffcode is null)";	
	$stmt=$this->conn->query($query);
	$output=array();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;

}

function fetchSingleStaff(){

	$query="select * from ".$this->table_name." where name=?";
	$stmt=$this->conn->prepare($query);

	//bind values
	
	$stmt->bindParam(1,$this->name);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row;
}

function updateStaff(){
		
		$query="update ".$this->table_name." set name=?,gender=?,designation=?,birth_date=?,address=?,mobileno=?,aadhaar_number=?,qualification=?,previous_experiences=?,experienceyears=?,previous_schoolname=?,previous_schoolcode=?,previous_schooladdress=?,bloodgroup=?,father_name=?,mother_name=?,father_aadhaar_number=?,mother_aadhaar_number=? where staffcode=?";

		$stmt=$this->conn->prepare($query);

	//bind values
	
	$stmt->bindParam(1,$this->name);
	$stmt->bindParam(2,$this->gender);
	$stmt->bindParam(3,$this->designation);
	$stmt->bindParam(4,$this->birthdate);
	$stmt->bindParam(5,$this->address);
	$stmt->bindParam(6,$this->mobile);
	$stmt->bindParam(7,$this->adhaarno);
	$stmt->bindParam(8,$this->qualification);
	$stmt->bindParam(9,$this->experience);
	$stmt->bindParam(10,$this->expyears);
	$stmt->bindParam(11,$this->prevschool);
	$stmt->bindParam(12,$this->prevschoolcode);
	$stmt->bindParam(13,$this->prevschooladdress);
	$stmt->bindParam(14,$this->bloodgroup);
	$stmt->bindParam(15,$this->fathername);
	$stmt->bindParam(16,$this->mothername);
	$stmt->bindParam(17,$this->fatheradhaar);
	$stmt->bindParam(18,$this->motheradhaar);
	$stmt->bindParam(19,$this->staffcode);
	   
 	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}

}

function updateStaffLeavingDate(){

	$query="UPDATE ".$this->table_name." set leaving_date=? where staffcode=?";
	$stmt=$this->conn->prepare($query);

	//bind values
	
	$stmt->bindParam(1,$this->leavingdate);
	$stmt->bindParam(2,$this->staffcode);

	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}
	
}
}
?>