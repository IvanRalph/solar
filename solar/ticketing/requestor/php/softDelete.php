<?php 
	include "../../php/sql-statements.php";

	$db = new DB();

	$id = $_POST['id'];

	$update = $db->update('request_details', array('status'=>'deleted'), array('request_no'=>$id));

	if(!$update){
		echo json_encode($update);
	}else{
		echo "success";
	}
?>