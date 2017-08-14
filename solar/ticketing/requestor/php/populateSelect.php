<?php
	include "../../php/sql-statements.php";

	$db = new DB();

	if($_POST['a'] == 'type'){
		$type = $_POST['request-type'];
		$col = 'type';
	}else if($_POST['a'] == 'category'){
		$type = $_POST['request-type'];
		$col = 'category';
	}
	

	$conditions = array(
		'where'=>array(
			$col=>$type
		),
		'select'=>'type, category, subcategory'
	);

	$select = $db->getRows('request_type', $conditions);

	echo json_encode($select);
?>