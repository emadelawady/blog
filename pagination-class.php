<?php
class Pagination{
		private $db, $table, $total_records;
		public $start=0,$limit = 6;
		//PDO connection
		public function __construct($table){
				$this->table = $table;
				$this->db = new PDO("mysql:host=localhost; dbname=blog", "ragnar", "");
				$this->set_total_records();
		}

			public function set_total_records(){
			$stmt   = $this->db->prepare("SELECT id FROM $this->table");
			$stmt->execute();
			$this->total_records = $stmt->rowCount();
		}
		public function current_page(){
		  return isset($_GET['page']) ? (int)$_GET['page'] :1;
		}

		public function get_data($data){
      $start = 1;
      if($this->current_page() > 1){
          $start = ($this->current_page() * $this->limit) - $this->limit;
      }

      $stmt = $this->db->prepare("SELECT categories.ID as cat_id,categories.Name as cat_name, posts.*
																	FROM $this->table
																	INNER JOIN categories
																	ON posts.Cat_ID = categories.ID
																	WHERE Cat_ID = $data
																	order by Post_ID DESC
																	LIMIT $start, $this->limit
																	");
      $stmt->execute(array($data));
      return $stmt->fetchAll(PDO::FETCH_OBJ);
			}

		public function get_pagination_number($data){
			if($this->current_page() > 1){
					$start = ($this->current_page() * $this->limit) - $this->limit;
			}
			$stmt = $this->db->prepare("SELECT count(*) as count FROM $this->table WHERE Cat_ID = $data order by Post_ID DESC LIMIT  $this->start, $this->limit");
			$stmt->execute();

			$the_stmt = $stmt->fetchAll(PDO::FETCH_OBJ);

			return json_decode(json_encode($the_stmt), true);

			}
}
?>
