<?php
  
  class MySQLiCon {
  	
  	private $user;
  	private $password;
  	private $database;
  	private $host;
  	
  	public function __construct($_user, $_password, $_database, $_host = "localhost") {
  			
  		$this->user = $_user;
  		$this->password = $_password;
  		$this->database = $_database;
  		$this->host = $_host;
  			
  	}
  	
  	protected function connect() {return new mysqli($this->host, $this->user, $this->password, $this->database);}
  	
  	public function query($_type, $_request, $_format, $_values) {
  		
  		$db = $this->connect();
  		
  		if($db->connect_errno > 0) {die("Failed to connect: (".$db->connect_errno.") ".$db->connect_error);}
  		
  		if(!($stmt = $db->prepare($_request))) {die("Prepare failed: (".$db->errno.") ".$db->error);}
  		
  		$values = array();
  		$values[] = & $_format;
  
  		for($i = 0; $i < count($_values); $i++) {$values[] = & $_values[$i];}
  
  		call_user_func_array(array($stmt, 'bind_param'), $values);
  		
  		if(!$stmt->execute()) {die("Execute failed: (".$stmt->errno.") ".$stmt->error);}
  		
  		if($_type == "SELECT") {
  			
  			$result = $stmt->get_result();
  			
  			if(empty($result)) {return false;}
  			else {
  				
  				while($row = $result->fetch_object()) {$results[] = $row;}
  				
  				$result->close();
  				$db->close();
  				
  				return $results;
  				
  			}
  			
  		}
  		else return $_type == "INSERT" ? $db->insert_id : $db->affected_rows;
  		
  	}
  	
  }
