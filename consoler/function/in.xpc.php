<?php

if (false === function_exists('xpc_in')) {
    /**
     * @param null|string $prompt
     * @return string
     */
	function xpc_in($prompt = null)
	{
		if (null !== $prompt) {
			xpc_out('>>> ', 'f-green');
			xpc_out($prompt . ': ');
		}

		return rtrim(fgets(STDIN));
	}
}

if (false === function_exists('xpc_hidden_in')) {
    /**
     * @param null|string $prompt
     * @return string
     */
	function xpc_hidden_in($prompt = null)
	{
		if (null !== $prompt) {
			xpc_out('>>> ', 'f-green');
			xpc_out($prompt . ': ');
		}

		if (XPC_OS === 'WIN') {
			$input = exec(__DIR__ . '\..\misc\win.hidden.bat');
		} elseif (XPC_OS === 'LINUX') {
			$input = exec("/usr/bin/env bash -c 'read -s PW; echo \$PW'");
		} else {
			$input = xpc_in();
		}

	    xpc_outln();
	    
		return $input;
	}
}
