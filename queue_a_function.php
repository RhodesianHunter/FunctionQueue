<?php
require_once('function_queue.php');

new Queued_Function('test_function', array('Hello' => ' World! ', 'Queue' => ' completed')); //could also include a third variable, the date/time to run the function such as date('Y-m-d H:i:s', strtotime($_POST['date'] . " + 20 hours"));
?>