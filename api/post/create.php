<?php 
	//Headers
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');


	include('../../common/autoloader.php');

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);

	//Get the raw posted data

	$data = json_decode(file_get_contents('php://input'));

	$post->title = $data->title;
	$post->body = $data->body;
	$post->author = $data->author;
	$post->category_id = $data->category_id;

	//create post

	if($post->create()){
		echo json_encode(
			array('Message'=> 'Post Created'));
	}else {
		echo json_encode(
			array('Message'=> 'Post Not Created'));
	}

 ?>