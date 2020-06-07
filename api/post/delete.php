<?php 
	
	header('Access-Control-Allow-Origin');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
	header('Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Authorization, X-Requested-With');


	include('../../models/Post.php');
	include('../../config/Database.php');

	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);

	$post->id = isset($_GET['postID'])? $_GET['postID'] : die(); 


	if($post->delete()){
		echo json_encode(
			array('Message'=> 'Post Deleted'));
	}else {
		echo json_encode(
			array('Message'=> 'Post Not Deleted'));
	}

?>
