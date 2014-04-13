<?php
return array (
    'db' => array(
    		'driver' => 'Mysqli', //The database driver. Mysqli, Sqlsrv, Pdo_Sqlite, Pdo_Mysql, Pdo=OtherPdoDriver
    		'database' => 'sampleProject', // 	generally required 	the name of the database (schema)
    		'username' => 'root', // generally required 	the connection username
    		'password' => '', // 	generally required 	the connection password
    		'hostname' => 'localhost', // not generally required 	the IP address or hostname to connect to
    		// 'port' => 1234,  	// not generally required 	the port to connect to (if applicable)
    		 'charset' => 'utf8',  //	not generally required 	the character set to use
    		'options' => array (
    			'buffer_results' => 0
    		)
    )
);