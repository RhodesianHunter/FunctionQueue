<?php
class Queue_Handler{
	private $remaining = 660000; //Length of time to run the queue. Should be shorter than the length of time between calling the Queue Handler - currently 11 minutes
	private $table = 'function_queue'; //The name of your SQL table
	
	function __construct(){ //Initialize with the name of the function to run and the arguments for it
		$this->database = MySQL::getInstance()->mysql;

		while($this->remaining > 0){
			$started = microtime(true);
			//Get the next function in the queue
MYSQL			$found = "SELECT * FROM {$this->table} WHERE locked IS NULL AND error = 0 AND (run_at IS NULL OR NOW() > run_at) ORDER BY created DESC LIMIT 1");
			if($found){
				//lock the function in the database
MYSQL				"UPDATE {$this->table} SET locked = NOW() WHERE id = %s"; ($found['id']);
				//extract the arguments and excecute the function
				try{
					$this->$found['fn_name'](unserialize($found['fn_args']));
					$success = true;
				}catch(Exception $e){
					//Handle errors
MYSQL					"UPDATE {$this->table} SET error = 1 WHERE id = %s"; ($found['id']);
/*
 * Handle errors here or with your own error handler
 */
				}
				//remove the function from the queue
				if($success){
MYSQL					"DELETE FROM {$this->table} WHERE id = %s"; ($found['id']);
				}
				//figure out how much time is left
				$used = round((microtime(true) - $started) * 1000);
				$this->remaining -= $used;
			}else{
				$this->remaining = 0;
			}
		}
	}

/*
 * Add your functions here.
 */
	private function test_function($args){
		var_dump($args);
	}
}
?>