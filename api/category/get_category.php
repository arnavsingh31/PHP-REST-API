<?php 
	//headers
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: GET');

	include('../../config/Database.php');
	include('../../models/Category.php');

	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);

	$category->category_id = isset($_GET['categoryID'])? $_GET['categoryID'] : die(); 
	$res = $category->getCategory();
	$num_rows = $res->rowCount();

	if($num_rows>0){

		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$category_arr = array(
				'id'=>$category_id,
				'name'=>$category_name,
				'created_at'=>$created_at
			);
		}	
		echo json_encode($category_arr);
	}else {
		echo json_encode(array('Message'=>'No Such Category Found'));
	}

?>