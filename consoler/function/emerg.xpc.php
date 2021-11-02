<?php

if (false === function_exists('xpc_emerg')) {
    /**
     * @param string $msg
     * @param int $code
     * @return void
     */
	function xpc_emerg($msg = '', $code = 1)
	{
		$code = (int) $code;
		xpc_outln('Exit (' . $code . '): ' . $msg, 'f-red');

		exit($code);
	}
}
