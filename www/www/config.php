<?php

	spl_autoload_register(function ($class) {
		$file = '../lib/' . strtr($class, '\\', '/') . '.php';
		require $file;
		return true;
	});
	
	use Monolog\Logger;
	use Monolog\Handler\StreamHandler;
	
	$database = array(
						'bookings' => '../database/booking.json',
						'customers' => '../database/customers.json',
						'employees' => '../database/employees.json',
						'empWorkTimes' => '../database/employeeWorkTime.json',
						'owners' => '../database/owners.json'					
	);
	
	$log = new Logger('logger');
	$log->pushHandler(new StreamHandler('../log/debuglog.log', Logger::DEBUG));
?>