<?php 
	//headers
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');

	include('../../config/Database.php');
	include('../../models/Category.php');


	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);
	$res = $category->getAllCategories();
	$num = $res->rowCount();

	if($num>0){
		$category_arr = array();

		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$arr_fields = array(
				'id'=> $category_id,
				'category_name'=> $category_name
					
			);

			array_push($category_arr, $arr_fields);
		}
		echo json_encode($category_arr);
	}else {
		echo json_encode(array('Mesage'=>'No category found'));		
	}


?>