<?php
/*
 * Separating out the DB logic as suggested
 */

class Queue_Data{
	private $table = 'function_queue'; //The name of your table
	
	//Build your data login in here. MySQL has been provided in comments in case you used the provided table
	function __construct(){ 

	}

/*
 * Putting functions into the queue
 */
	//INSERT INTO {$this->table} (fn_name, fn_args) VALUES(%s, %s)
	public function queue_now($fn_name, $arguments){

	}

	//INSERT INTO {$this->table} (fn_name, fn_args, run_at) VALUES(%s, %s, %s)
	public function queue_later($fn_name, $arguments, $when){

	}
/*
 * Handling queued functions
 */
	//SELECT * FROM {$this->table} WHERE locked IS NULL AND error = 0 AND (run_at IS NULL OR NOW() > run_at) ORDER BY created DESC LIMIT 1 FOR UPDATE
	//UPDATE {$this->table} SET locked = NOW() WHERE id = %s
	public function get_next_function(){

	}

	//UPDATE {$this->table} SET error = 1 WHERE id = %s
	public function error_update($fn_id){

	}

	//DELETE FROM {$this->table} WHERE id = %s
	public function remove_function($fn_id){

	}
}
?>