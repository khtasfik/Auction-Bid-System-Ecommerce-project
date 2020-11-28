<?php 
class ourModel
{
	private $db;
	public $Id;
	function __construct()
	{
		// $host = "localhost";
		// $user = "coderasa_auction";
		// $pass = "VeryE@syP@ssword$";
		// $database = "coderasa_auction";
		$host = "tasfik.com";
		$user = "tasfikco";
		$pass = "Tasfik islam7778";
		$database = "tasfikco_auction_ecommerce";
		$this->db = new mysqli($host, $user, $pass, $database);	
	}
	private function MH($data){		
		return $this->db->real_escape_string($data);
	}
	public function insert($table, $data){
		$sql = "";
		foreach ($data as $key => $value) {
			if ($sql != "") {
				$sql .= ", ";
			}
			$sql .= "{$key}='".$this->MH($value)."'";
		}
		$sql = "insert into {$table} set {$sql}";
		// echo $sql;
		if ($this->db->query($sql)) {
			$this->Id = $this->db->insert_id;
			return true;
		}
		else{
			return false;
		}
	}

	public function View($table, $select, $order = "", $where="", $rel= "",$limit=""){
		$sqlOrder = "";
		$sqllimit = "";
		$sqlWhere = "";
		$sqlRel = "";

		$sql = "select {$select} from $table";
		
		if ($order) {
			$sqlOrder =" order by {$order[0]} {$order[1]}";
		}
		if ($limit) {
			$sqllimit =" limit {$limit}";
		} 
		if ($where) {
			foreach ($where as $key => $value) {
				if ($sqlWhere != "") {
					$sqlWhere .= " and ";
				}
				else{
					$sqlWhere = " where ";
				}
				$sqlWhere .="{$key}='".$value."'";
			}
		} 
		if ($rel) {
			foreach ($rel as $key => $value) {
				if ($sqlRel) {
					$sqlRel .= " and ";
				}
				else if(!$sqlWhere){
					$sqlRel = " where ";
				}
				else if (!$sqlRel && $sqlWhere) {
					$sqlRel .= " and ";
				}
				$sqlRel .="{$key}={$value}";
			}
		} 

		$sql = $sql .$sqlWhere .$sqlRel .$sqlOrder .$sqllimit;
		// echo $sql;
		// echo die();
		$results = $this->db->query($sql);
		return $results;
	}

	public function update($table, $data, $where){
		$sql = "";
		$sqlWhere = "";
		foreach ($data as $key => $value) {
			if ($sql != "") {
				$sql .= ", ";
			}
			$sql .= "{$key}='".$this->MH($value)."'";
		}
		if ($where) {
			foreach ($where as $key => $value) {
				if ($sqlWhere != "") {
					$sqlWhere .= " and ";
				}
				else{
					$sqlWhere = " where ";
				}
				$sqlWhere .="{$key}='".$value."'";
			}
		} 

		$sql = "update {$table} set {$sql} {$sqlWhere}";
		// echo $sql;
		$this->db->query($sql);
		if($this->db->affected_rows>-1){
			return true;
		}
		
		else{
			return false;
		}
	}

	public function delete($table, $where){
		$sql = "";
		$sqlWhere = "";
		if ($where) {
			foreach ($where as $key => $value) {
				if ($sqlWhere != "") {
					$sqlWhere .= " and ";
				}
				else{
					$sqlWhere = " where ";
				}
				$sqlWhere .="{$key}='".$value."'";
			}
		} 

		$sql = "delete from {$table} {$sqlWhere}";
		// echo $sql;
		$this->db->query($sql);
		if($this->db->affected_rows){
			return true;
		}
		
		else{
			return false;
		}
	}

	public function dbRaw($sql)
	{
		// echo $sql;
		return $this->db->query($sql);
	}
}




/*
==2table unique way

alter table sub_category add(
unique key (name, category_id)
);

==sub-query way

$results = $om->dbRaw("SELECT category.*, (SELECT COUNT(product.id) from product, sub_category WHERE product.sub_category_id = 			sub_category.id AND sub_category.category_id = category.id) as total  
	from category");									
while($d = $results->fetch_object()){									
echo "<li><a href='index.php?v=category/product_category&catId=$d->id'> $d->name <span>({$d->total})</span></a></li>";			
}			


*/