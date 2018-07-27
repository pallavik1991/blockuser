<?php 
include_once '/config/database.php';
include_once '/objects/staff.php';
include_once '/objects/users.php';

		$database = new Database();
		$db = $database->getConnection();

		$staff = new Staff($db);
		$user=new User($db);

		$staff->staffcode=$_POST["param_staffcode"];
		$staff->leavingdate=date('Y-m-d');
		
		$user->staffcode=$staff->staffcode;
		if($staff->updateStaffLeavingDate()&&$user->updateUser()){
				$result="Success";
		}
		else{
			$result="Failed";
		}


 		echo json_encode($result);

	?>
	 