<?php 
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Content-type, Access-Control-Allow-Headers, X-Request-With, Authorization');

	include('../../config/Database.php');
	include('../../models/Category.php');

	$database = new Database();
	$db = $database->connect();

	$category = new Category($db);

	$category->category_id = isset($_GET['categoryID'])? $_GET['categoryID'] : die();

	if($category->deleteCategory()){
		echo json_encode(array('Message'=>'Category Deleted'));
	}else{
		echo json_encode(array('Message'=> 'Category not Deleted'));
	}
 
?>