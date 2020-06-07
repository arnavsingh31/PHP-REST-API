<?php 
	
	class Category{

		private $conn ;
		private $table = 'categories';

		public $category_id;
		public $category_name;
		public $created_at;

		public function __construct($db){
			$this->conn =$db;
		}

		// Get All category

		public function getAllCategories(){
			$query = "SELECT c.id as category_id, c.name as category_name FROM $this->table c";

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		}

		// GEt single category
		public function getCategory(){
			$query = "SELECT c.id as category_id, c.name as category_name, c.created_at FROM $this->table c WHERE c.id =:categoryID";

			$stmt =$this->conn->prepare($query);
			
			// clean id
			$this->category_id = htmlspecialchars(strip_tags($this->category_id));

			// bind id
			$stmt->bindParam('categoryID', $this->category_id);
			
			
			$stmt->execute();

			return $stmt;
		}	


		
		//Create a category
		public function createCategory(){
	
			//clean name
			$this->category_name = htmlspecialchars(strip_tags($this->category_name));

			//check for category name
			$queryCheck= "SELECT * FROM $this->table c WHERE c.name = :checkCategory ";
			$stmtCheck = $this->conn->prepare($queryCheck);
			$stmtCheck->bindParam('checkCategory', $this->category_name);
			$stmtCheck->execute();
			$row = $stmtCheck->fetch();
			
			if($row){
				echo(json_encode(array('Error'=>'Category already exists')));
				return false;
			}else {
				$query = "INSERT INTO $this->table (name) VALUES (:cname)";

				$stmt = $this->conn->prepare($query);

				//bind name
				$stmt->bindParam(':cname', $this->category_name);

				if($stmt->execute()){

					return true;
				}
				//using setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)  errors

				echo(json_encode($stmt->error));
				return false;
				}
		}


		//Update Category

		public function updateCategory(){
			$query = "UPDATE $this->table SET name= :category_name WHERE id=:category_id ";

			$stmt = $this->conn->prepare($query);

			$this->category_id = htmlspecialchars(strip_tags($this->category_id));
			$this->category_name = htmlspecialchars(strip_tags($this->category_name));

			$stmt->bindParam(':category_id', $this->category_id);
			$stmt->bindParam(':category_name', $this->category_name);

			if($stmt->execute()){
				return true;
			}

			echo(json_encode($stmt->error));
			return false;

		}

		//Delete a category

		public function deleteCategory(){
			$query = "DELETE FROM $this->table WHERE id=:category_id";

			$stmt = $this->conn->prepare($query);

			$this->category_id = htmlspecialchars(strip_tags($this->category_id));

			$stmt->bindParam(':category_id', $this->category_id);
			
			if($stmt->execute()){
				return true;
			}

			echo(json_encode($stmt->error));
				return false;			
		}
}
?>