<?php 
	//Headers
	header('Access-Control-Allow-Origin: *');  //Enables CORS
	header('Content-type: application/json');  //SET the content-type

	include('../../common/autoloader.php');

	//Instantiate our db and connect
	$database = new Database();
	$db = $database->connect();

	//Instantiate our Post object
	$post = new Post($db);
	$res = $post->read();
	$num = $res->rowCount();

	//check if any post
	if ($num>0){
		$posts_arr = array();
				
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$post_item = array(
				'id'=>$id,
				'title'=> $title,
				'body'=> html_entity_decode($body),
				'author'=>$author,
				'category_id'=>$category_id,
				'category_name'=>$category_name
			);


			//push to post_arr[]

			array_push($posts_arr, $post_item);
		}
		echo json_encode($posts_arr);
	}else{
		// No posts
		echo json_encode(array('message'=> 'No post found'));
	}


?>