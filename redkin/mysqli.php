<?php
	$conn = FALSE;	
	
	function db_connect() {
		global $conn;
		$err = false;
		
		$conn = @mysqli_connect("localhost", "root", "", "DungeonMaster");
		if($conn) 
			return $err;
		else {
			return $err = true;
		}
	}
	function db_close()
	{
		@mysqli_close($GLOBALS["conn"]);
	}
?>