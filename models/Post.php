<?php 
	class Post{
		//DB stuff
		private $conn;
		private $table = 'posts';

		//post properties
		public $id;
		public $category_id;
		public $category_name;
		public $title;
		public $author;
		public $created_at;

		// Constructor

		public function __construct($db){
			$this->conn = $db;

		}
		// GET posts
		public function read(){
			// Create our query
			$query = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM $this->table p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC";

			//Prepare statement 
			$stmt = $this->conn->prepare($query);

			//Execute statement
			$stmt->execute();

			return $stmt;
		}

		//GET Single Post

		public function read_single(){
			$query = "SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at FROM $this->table p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id= :postID LIMIT 0,1";

			$stmt = $this->conn->prepare($query);

			$this->id = htmlspecialchars(strip_tags($this->id));

			//BindID
			// $stmt->bindParam(1, $this->id);
			//$stmt->bindParam(':postID', $this->id);

			$stmt->execute(['postID'=>$this->id]);

			// 

			//set properties
			// $this->title = $row['title'];
			// $this->body = $row['body'];
		 // 	$this->author = $row['author'];
		 // 	$this->created_at = $row['created_at'];
		 // 	$this->category_name = $row['category_name'];
		 // 	$this->category_id = $row['category_id'];

		 	return $stmt ;
		}


		//create a post

		public function create(){
			$query = "INSERT INTO $this->table (title, body, author, category_id) VALUES (:title, :body, :author, :category_id)";

			$stmt = $this->conn->prepare($query);

			//Clean data
			$this->title = htmlspecialchars(strip_tags($this->title));
			$this->body = htmlspecialchars(strip_tags($this->body));
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->category_id = htmlspecialchars(strip_tags($this->category_id));


			$stmt->bindParam(':title', $this->title);
			$stmt->bindParam(':body', $this->body);
			$stmt->bindParam(':author', $this->author);
			$stmt->bindParam(':category_id', $this->category_id);

			if($stmt->execute()){

				return true;
			}

				//using setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)  errors

				echo(json_encode($stmt->error));
				return false;

		}


		//Update post
		
		public function update(){
			$query = "UPDATE $this->table p SET title =:title, body=:body, author=:author, category_id=:category_id WHERE id =:id";

			$stmt = $this->conn->prepare($query);

			//Clean data
			$this->title = htmlspecialchars(strip_tags($this->title));
			$this->body = htmlspecialchars(strip_tags($this->body));
			$this->author = htmlspecialchars(strip_tags($this->author));
			$this->category_id = htmlspecialchars(strip_tags($this->category_id));
			$this->id = htmlspecialchars(strip_tags($this->id));

			// bind parameters
			$stmt->bindParam(':title', $this->title);
			$stmt->bindParam(':body', $this->body);
			$stmt->bindParam(':author', $this->author);
			$stmt->bindParam(':category_id', $this->category_id);
			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()){

				return true;
			}

				//using setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)  errors

				echo(json_encode($stmt->error));
				return false;

		}


		//Delete post

		public function delete(){
			$query = "DELETE FROM $this->table WHERE id =:id";

			$stmt= $this->conn->prepare($query);
			
			// clean id
			$this->id = htmlspecialchars(strip_tags($this->id));

			//bind id
			$stmt->bindParam(':id', $this->id);

			if($stmt-> execute()){

			 	return true;
			 }
				echo(json_encode($stmt->error));
				return false;
		}			
	}
?>