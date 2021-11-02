<?php

if (false === function_exists('xpc_status')) {
	function xpc_status ($type, $msg)
	{
		switch ($type) {
			default:
			case XPC_OK:
				$prefix = xpc_out('[ OK ] ', 't-bold:f-green');
				break;
			case XPC_FAIL:
				$prefix = xpc_out('[FAIL] ', 't-bold:f-red');
				break;
			case XPC_INFO:
				$prefix = xpc_out('[INFO] ', 't-bold:f-blue');
				break;
			case XPC_WARN:
				$prefix = xpc_out('[WARN] ', 't-bold:f-yellow');
				break;
		}

		$msg = xpc_inline($msg, 7, false);
		$msg = $prefix . $msg;

		xpc_outln($msg);
	}
}
