<?php

class Query
{
	
	private $connection;
	public $records;
	
	public function __construct($_server, $_user, $_password, $_database) {
		
		$this->connection = new mysqli($_server, $_user, $_password, $_database);
		
	}
	
	public function execute_query($_request) {
		
		$request = $this->connection->query($this->sanitizer($_request));
		
		if(stristr($_request, 'SELECT') && !stristr($_request, 'UPDATE ') && !stristr($_request, 'DELETE')) {
			if(empty($request)) {$this->records = false;}
			else {
				$this->records = Array();
				$counter = 0;
				while($data = $request->fetch_assoc()){
					foreach($data as $key => $value){$this->records[$counter][$key] = str_replace('\\"', '"', $value);}
					$counter++;
				}
				$request->close();
			}
		}
		else {
			if(stristr($_request, 'INSERT')) {$this->records = $this->connection->insert_id;}
			else {$this->records = $this->connection->affected_rows;}
		}
		
	}
	
	private function sanitizer($_val) {
		
		return $this->connection->real_escape_string(trim($_val));
		
	}
	
}