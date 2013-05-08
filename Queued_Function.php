<?php
require_once('Queue_Data.php');

class Queued_Function{
	private $data; //Object handling your data storage

	
	function __construct($fn_name, $args, $run_at = false){ //Initialize with the name of the function to run, the arguments for it, and a date to run it
		$this->data = new Queue_Data();

		if($run_at){
			$this->data->queue_later($fn_name, serialize($args), date('Y-m-d G:i:s', strtotime($run_at)));
		}else{
			$this->data->queue_now($fn_name, serialize($args));
		}
	}
}
?>