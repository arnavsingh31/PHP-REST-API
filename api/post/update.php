<?php 
	//headers
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested_With');

	include('../../models/Post.php');
	include('../../config/Database.php');

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);
	$post->id = isset($_GET['postID'])? $_GET['postID'] : die();

	

	$data = json_decode(file_get_contents('php://input'));

	$post->title = $data->title;
	$post->body = $data->body;
	$post->author = $data->author;
	$post->category_id = $data->category_id;

	if($post->update()){
		echo json_encode(
			array('Message'=> 'Post Updated'));
	}else {
		echo json_encode(
			array('Message'=> 'Post Not Updated'));
	}


 ?>