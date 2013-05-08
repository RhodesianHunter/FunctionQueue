<?php
class Queued_Function{
	private $table = 'function_queue'; //The name of your SQL table
	
	function __construct($fn_name, $args, $run_at = false){ //Initialize with the name of the function to run, the arguments for it, and a date to run it
		$database = MySQL::getInstance()->mysql;

		if($run_at){
MYSQL			$sql = "INSERT INTO {$this->table} (fn_name, fn_args, run_at) VALUES(%s, %s, %s)"; ($fn_name, serialize($args), date('Y-m-d G:i:s', strtotime($run_at)));
		}else{
MYSQL			$sql = "INSERT INTO {$this->table} (fn_name, fn_args) VALUES(%s, %s)"; ($fn_name, serialize($args));
		}
	}
}
?>