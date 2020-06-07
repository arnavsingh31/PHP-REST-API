<?php 
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-type, Access-Control-Allow-Headers, X-Request-With, Authorization');

	include('../../config/Database.php');
	include('../../models/Category.php');

	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);

	$data = json_decode(file_get_contents('php://input'));

	$category->category_name = $data->category_name;

	if($category->createCategory()){
		echo json_encode(array('Message'=>'New Category created'));
	}else{
		echo json_encode(array('Message'=> 'Category not created'));
	}



?>