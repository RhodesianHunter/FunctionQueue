FunctionQueue
=============

A PHP Library to handle queuing functions to be run later.

Steps to use:

1. Queue_Data.php contains the class that needs to be edited for your storage. MySQL code provided in the comments assumes a table exists like this:

```sql
    CREATE TABLE function_queue (
      id                  BIGINT            NOT NULL        AUTO_INCREMENT,
      created             TIMESTAMP         NOT NULL        DEFAULT CURRENT_TIMESTAMP,
      locked              TIMESTAMP         NULL            DEFAULT NULL,
      run_at              TIMESTAMP         NULL,
      fn_name             VARCHAR(255)      NOT NULL,
      fn_args             TEXT              NULL,
      error               INT(1)            NOT NULL        DEFAULT 0,
      INDEX(locked),
      INDEX(created),
      PRIMARY KEY(id)
    ) Engine=InnoDB;
```

2. You will need to set a cron to run `run_the_queue.php` every x minutes where x is how often you want to queue checked. Update line 17 in `function_queue_classes.php` to less time than the check if you don't want queue's running at the same time.

3. `run_the_queue.php` checks the queue for functions and runs them, `queue_a_function.php` will add a function to the queue. The function must have a corresponding handler in the Queue_Handler class.

4. Constructive criticism please!
