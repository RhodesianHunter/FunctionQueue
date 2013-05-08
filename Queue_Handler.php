<?php
require_once('Queue_Data.php');

class Queue_Handler{
	private $remaining = 660000; //Length of time to run the queue. Should be shorter than the length of time between calling the Queue Handler - currently 11 minutes
	private $data; //Object handling your data storage
	
	function __construct(){ //Initialize with the name of the function to run and the arguments for it
		$this->data = new Queue_Data();

		while($this->remaining > 0){
			$started = microtime(true);
			//Get the next function in the queue
			$found = $this->data->get_next_function();
			if($found){
				//extract the arguments and excecute the function
				try{
					$this->$found['fn_name'](unserialize($found['fn_args']));
					$success = true;
				}catch(Exception $e){
					//Handle errors
					$this->data->error_update($found['id']);
/*
 * Handle errors here or with your own error handler
 */
				}
				//remove the function from the queue
				if($success){
					$this->data->remove_function($found['id']);
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