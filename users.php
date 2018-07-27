<?php

class Users{
	//database connection and table name

private $conn;
private $table_name="users";

//object properties

public $username;
public $password;
public $usertype;
 
public $status;
public $staffcode;

public function __construct($db){
	$this->conn=$db;
}

//create user
function create(){
	//write query

	try{
	$query="INSERT INTO ".$this->table_name. "(username,password,usertype, status,staffcode) values(?,?,?,?,?)";
	$stmt=$this->conn->prepare($query);

	//bind values
	$stmt->bindParam(1,$this->username);
	$stmt->bindParam(2,$this->password);
	$stmt->bindParam(3,$this->usertype);
 
	$stmt->bindParam(4,$this->status);
	$stmt->bindParam(5,$this->staffcode);
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

//select all data
function readAll(){
	$query="SELECT * FROM ". $this->table_name;
	$stmt=$this->conn->query($query);
	$output=array();
	$output=$stmt->fetchall(PDO::FETCH_ASSOC);
	return $output;
}

//update status of users
function updateStatus(){
	$query="UPDATE ". $this->table_name ." set status='D' where username=?";
	$stmt=$this->conn->prepare($query);

	//bind values
	$stmt->bindParam(1,$this->username);

	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}
}

function updatePassword(){
	$query="UPDATE ". $this->table_name ." set password=? where username=?";
	$stmt=$this->conn->prepare($query);

	//bind values
	$stmt->bindParam(1,$this->password);
	$stmt->bindParam(2,$this->username);

	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}
}
function checkUser()
{
	 
	$query="SELECT count(*) as count_admin FROM ". $this->table_name . " where username=? and password=?";
 

	  $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->username);
    $stmt->bindParam(2, $this->password);
    
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count_user'];
}

function updateUser(){
	$query="UPDATE ".$this->table_name." set status='D' where staffcode=?";
	$stmt=$this->conn->prepare($query);

	//bind values
	$stmt->bindParam(1,$this->staffcode);
	

	if($stmt->execute()){
		return true;
	}
	else{
		return false;
	}

}
}
?>