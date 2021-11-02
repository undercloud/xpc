<?php

if (false === function_exists('xpc_spinner')) {
	function xpc_spinner ($msg)
	{
		static $spinner = array('/','-','\\','|');
		
		$symbol = array_shift($spinner);
		$spinner[] = $symbol;

		$msg = xpc_trim($msg, XPC_TERM_SIZE - 3);
		$msg = str_pad($msg, XPC_TERM_SIZE);

		$symbol = xpc_out($symbol, 'f-green', true);

		xpc_out(' ' . $symbol . ' ' . $msg);
	}
}
