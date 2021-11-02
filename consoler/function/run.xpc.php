<?php

if (false === function_exists('xpc_run')) {
    /**
     * @return \XPC\XPCArguments
     */
	function xpc_run ()
	{
		if (!('cli' === PHP_SAPI)) {
			throw new RuntimeException('Available only in CLI mode');
		}

		list($options, $longoptions) = XPC\XPCOptionStack::exportOptions();
		if (false === ($arguments = getopt($options, $longoptions))) {
			throw new RuntimeException('Invalid parameter configuration');
		}

		return new XPC\XPCArguments($arguments);
	}
}
