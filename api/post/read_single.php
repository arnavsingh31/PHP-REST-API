<?php 
	//Headers
	header('Access-Control-Allow-Origin: *');  //Enables CORS
	header('Content-type: application/json');  //SET the content-type

	include('../../common/autoloader.php');

	//Instantiate our db and connect
	$database = new Database();
	$db = $database->connect();

	$post = new Post($db);
	$post->id = isset($_GET['postID']) ? $_GET['postID'] : die(); 
	$res = $post->read_single();
	$num_rows = $res->rowCount();

	if($num_rows>0){

		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$post_arr = array(
			'id'=> $id,
			'title'=> $title,
			'body'=> $body,
			'author'=> $author,
			'category_id'=> $category_id,
			'categort_name'=> $category_name,
			'created_at'=> $created_at,
		);

	}	
	print_r(json_encode($post_arr));

}else {
	echo json_encode(array('Message'=>'No Post found'));
}

	//Create post array
	// $post_arr = array(
	// 	'id'=> $post->id,
	// 	'title'=> $post->title,
	// 	'body'=> $post->body,
	// 	'author'=> $post->author,
	// 	'category_id'=> $post->category_id,
	// 	'categort_name'=> $post->category_name,
	// 	'created_at'=> $post->created_at,
	// );

	// Make json
	// print_r(json_encode($post_arr));
?>