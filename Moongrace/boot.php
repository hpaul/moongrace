<?php

/**
* Create the exception handler function. All of the error handlers
* registered by the framework call this closure to avoid duplicate
* code. This Closure will pass the exception to the developer
* defined handler in the configuration file.
*/
$handler = function($exception)
{

	echo "<html><h2>Unhandled Exception</h2>
			<h3>Message:</h3>
			<pre>".$exception->getMessage()."</pre>
			<h3>Location:</h3>
			<pre>".$exception->getFile()." on line ".$exception->getLine()."</pre>
			<h3>Stack Trace:</h3>
			<pre>".$exception->getTraceAsString()."</pre></html>";

	exit(1);
};

/**
* Register the PHP exception handler. The framework throws exceptions
* on every error that cannot be handled. All of those exceptions will
* be sent through this closure for processing.
*/
set_exception_handler(function($exception) use ($handler)
{
	$handler($exception);
});


function load_core($class) {
    $file = SYS.DIRECTORY_SEPARATOR.'Bootcamp'.DIRECTORY_SEPARATOR.$class.EXT;
    require_once($file);
}

spl_autoload_register('load_core');

$config = array();

$config_dir = APP . DIRECTORY_SEPARATOR . 'Configs' . DIRECTORY_SEPARATOR;
foreach (glob(sprintf('%s*', $config_dir)) as $key) require_once($key);
unset($config_dir);

new Application($config);
